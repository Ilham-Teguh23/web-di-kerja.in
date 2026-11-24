<?php

namespace App\Http\Controllers\WhatsApp;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppOnboarding;
use App\Models\WhatsAppWebhookEvent;
use App\Services\WhatsApp\GraphClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Admin > WhatsApp. Each JSON action is one WhatsApp Cloud API call, grouped
 * by the permission it uses:
 *
 *   business_management           businessAssets
 *   whatsapp_business_management  phoneNumbers, templates, createTemplate
 *   whatsapp_business_messaging   sendMessage
 *
 * Embedded Signup, Coexistence (number 8566 on the WhatsApp Business app):
 * exchange, status, sync, webhookEvents.
 */
class WhatsAppController extends Controller
{
    private const PHONE_FIELDS = 'id,display_phone_number,verified_name,platform_type,is_on_biz_app,status';

    public function __construct(private readonly GraphClient $graph) {}

    public function index(): View
    {
        $config = config('services.whatsapp');

        return view('dashboard.whatsapp.index', [
            'config' => $config,
            'ready' => filled($config['access_token']),
            'signupReady' => filled($config['app_id']) && filled($config['app_secret']) && filled($config['es_config_id']),
        ]);
    }

    public function businessAssets(): JsonResponse
    {
        return $this->withToken(fn () => $this->graph->call('GET', config('services.whatsapp.business_id').'/owned_whatsapp_business_accounts', [
            'fields' => 'id,name,currency,timezone_id,message_template_namespace',
        ]));
    }

    public function phoneNumbers(): JsonResponse
    {
        return $this->withToken(fn () => $this->graph->call('GET', config('services.whatsapp.waba_id').'/phone_numbers', [
            'fields' => 'id,display_phone_number,verified_name,quality_rating,platform_type,status',
        ]));
    }

    public function templates(): JsonResponse
    {
        return $this->withToken(fn () => $this->graph->call('GET', config('services.whatsapp.waba_id').'/message_templates', [
            'fields' => 'id,name,status,category,language',
            'limit' => 50,
        ]));
    }

    public function createTemplate(Request $request): JsonResponse
    {
        $name = strtolower(preg_replace('/[^a-z0-9_]/i', '_', trim((string) $request->input('name'))));
        $text = trim((string) $request->input('body'));
        if ($name === '' || $text === '') {
            return $this->fail('Template name and body are required.', 422);
        }

        $component = ['type' => 'BODY', 'text' => $text];
        if (str_contains($text, '{{1}}')) {
            $component['example'] = ['body_text' => [[trim((string) $request->input('example')) ?: 'Budi']]];
        }

        return $this->withToken(fn () => $this->graph->call('POST', config('services.whatsapp.waba_id').'/message_templates', [], [
            'name' => $name,
            'language' => in_array($request->input('language'), ['id', 'en_US'], true) ? $request->input('language') : 'id',
            'category' => 'UTILITY',
            'components' => [$component],
        ]));
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $to = preg_replace('/\D/', '', (string) $request->input('to'));
        if (str_starts_with($to, '0')) {
            $to = '62'.substr($to, 1);
        }
        if ($to === '') {
            return $this->fail('Recipient number is required.', 422);
        }

        $message = ['messaging_product' => 'whatsapp', 'recipient_type' => 'individual', 'to' => $to];
        if ($request->input('type') === 'template') {
            $template = [
                'name' => trim((string) $request->input('template')) ?: 'hello_world',
                'language' => ['code' => trim((string) $request->input('language')) ?: 'en_US'],
            ];
            $param = trim((string) $request->input('param'));
            if ($param !== '') {
                $template['components'] = [['type' => 'body', 'parameters' => [['type' => 'text', 'text' => $param]]]];
            }
            $message += ['type' => 'template', 'template' => $template];
        } else {
            $text = trim((string) $request->input('text'));
            if ($text === '') {
                return $this->fail('Message text is required.', 422);
            }
            $message += ['type' => 'text', 'text' => ['body' => $text]];
        }

        return $this->withToken(fn () => $this->graph->call('POST', config('services.whatsapp.phone_number_id').'/messages', [], $message));
    }

    /**
     * Embedded Signup finished: trade the code for the business token, find
     * the WABA and number, subscribe our app to the WABA's webhooks. The
     * number is already registered (WhatsApp Business app), so no /register.
     */
    public function exchange(Request $request): JsonResponse
    {
        $config = config('services.whatsapp');
        if (blank($config['app_id']) || blank($config['app_secret'])) {
            return $this->fail('META_APP_ID and META_APP_SECRET must be set in .env.', 400);
        }
        $code = trim((string) $request->input('code'));
        if ($code === '') {
            return $this->fail('No code from Embedded Signup.', 422);
        }

        $steps = [];
        $step = function (string $label, array $response) use (&$steps): array {
            $steps[] = ['step' => $label, 'status' => $response['status'], 'error' => GraphClient::error($response)];

            return $response;
        };

        $tokenResponse = $step('Exchange code for business token', $this->graph->call('GET', 'oauth/access_token', [
            'client_id' => $config['app_id'],
            'client_secret' => $config['app_secret'],
            'code' => $code,
        ], null, ''));
        $token = (string) ($tokenResponse['body']['access_token'] ?? '');
        if ($token === '') {
            return $this->fail(GraphClient::error($tokenResponse) ?? 'No access token returned.', 502, ['steps' => $steps]);
        }

        // From the signup session event; else the WABA this token was granted.
        $wabaId = preg_replace('/\D/', '', (string) $request->input('waba_id'));
        if ($wabaId === '') {
            $debug = $step('Find the WhatsApp account of the token', $this->graph->call('GET', 'debug_token', [
                'input_token' => $token,
            ], null, $config['app_id'].'|'.$config['app_secret']));
            foreach ($debug['body']['data']['granular_scopes'] ?? [] as $scope) {
                if (($scope['scope'] ?? '') === 'whatsapp_business_management' && ! empty($scope['target_ids'][0])) {
                    $wabaId = preg_replace('/\D/', '', (string) $scope['target_ids'][0]);
                }
            }
        }
        if ($wabaId === '') {
            return $this->fail('Could not tell which WhatsApp account was connected.', 502, ['steps' => $steps]);
        }

        $step('Subscribe app to the WABA webhooks', $this->graph->call('POST', $wabaId.'/subscribed_apps', [], null, $token));

        $numbers = $step('Read the phone numbers of the WABA', $this->graph->call('GET', $wabaId.'/phone_numbers', [
            'fields' => self::PHONE_FIELDS,
        ], null, $token));
        $phoneId = preg_replace('/\D/', '', (string) $request->input('phone_number_id'));
        $phone = collect($numbers['body']['data'] ?? [])
            ->first(fn ($candidate) => $phoneId === '' || (string) ($candidate['id'] ?? '') === $phoneId);
        $phoneId = preg_replace('/\D/', '', (string) ($phone['id'] ?? $phoneId));
        if ($phoneId === '') {
            return $this->fail('Could not find the connected phone number.', 502, ['steps' => $steps]);
        }

        $onboarding = WhatsAppOnboarding::updateOrCreate(['phone_number_id' => $phoneId], [
            'waba_id' => $wabaId,
            'phone' => $phone,
            'access_token' => $token,
            'onboarded_at' => now(),
            'contacts_synced_at' => null,
            'history_synced_at' => null,
        ]);

        return response()->json(['onboarding' => $onboarding->summary(), 'steps' => $steps]);
    }

    public function status(): JsonResponse
    {
        $onboarding = WhatsAppOnboarding::latest('onboarded_at')->first();
        if (! $onboarding) {
            return response()->json(['onboarding' => null]);
        }

        $live = $this->graph->call('GET', $onboarding->phone_number_id, ['fields' => self::PHONE_FIELDS], null, $onboarding->access_token);
        $error = GraphClient::error($live);
        if (! $error) {
            $onboarding->update(['phone' => $live['body']]);
        }

        return response()->json(['onboarding' => $onboarding->summary(), 'error' => $error]);
    }

    /**
     * Coexistence: contacts first, then the chat history. Each runs once,
     * within 24 hours of connecting; the data arrives at the webhook.
     */
    public function sync(Request $request): JsonResponse
    {
        $type = (string) $request->input('type');
        $column = WhatsAppOnboarding::SYNC_COLUMNS[$type] ?? null;
        if (! $column) {
            return $this->fail('Unknown sync type.', 422);
        }
        $onboarding = WhatsAppOnboarding::latest('onboarded_at')->first();
        if (! $onboarding) {
            return $this->fail('Connect a WhatsApp Business app number first.', 409);
        }
        if ($onboarding->{$column}) {
            return $this->fail('Already synced. It can be done only once.', 409);
        }

        $sync = $this->graph->call('POST', $onboarding->phone_number_id.'/smb_app_data', [], [
            'messaging_product' => 'whatsapp',
            'sync_type' => $type,
        ], $onboarding->access_token);
        if ($error = GraphClient::error($sync)) {
            return $this->fail($error, 502);
        }

        $onboarding->update([$column => now()]);

        return response()->json(['request_id' => $sync['body']['request_id'] ?? null, 'onboarding' => $onboarding->summary()]);
    }

    public function webhookEvents(): JsonResponse
    {
        $events = WhatsAppWebhookEvent::latest('id')->limit(30)->get()->map(fn (WhatsAppWebhookEvent $event) => [
            'received_at' => $event->created_at->timezone('Asia/Jakarta')->format('d M Y H:i:s'),
            'fields' => $event->fields,
            'payload' => $event->payload,
        ]);

        return response()->json(['entries' => $events]);
    }

    private function withToken(callable $call): JsonResponse
    {
        if (blank(config('services.whatsapp.access_token'))) {
            return $this->fail('WA_ACCESS_TOKEN is empty. Put a token in .env first.', 400);
        }

        return response()->json($call());
    }

    private function fail(string $message, int $status, array $extra = []): JsonResponse
    {
        return response()->json(['error' => ['message' => $message]] + $extra, $status);
    }
}
