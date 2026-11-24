<?php

namespace App\Http\Controllers\WhatsApp;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppWebhookEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * https://di-kerja.in/webhooks/whatsapp (Meta App Dashboard > WhatsApp >
 * Configuration). GET answers Meta's verification with WA_WEBHOOK_VERIFY_TOKEN;
 * POST keeps an event when its X-Hub-Signature-256 matches META_APP_SECRET.
 */
class WhatsAppWebhookController extends Controller
{
    public function verify(Request $request): Response
    {
        $expected = (string) config('services.whatsapp.webhook_verify_token');
        $given = (string) $request->query('hub_verify_token', '');

        if ($request->query('hub_mode') === 'subscribe' && $expected !== '' && hash_equals($expected, $given)) {
            return response((string) $request->query('hub_challenge', ''), 200, ['Content-Type' => 'text/plain']);
        }

        return response('Forbidden', 403);
    }

    public function receive(Request $request): Response
    {
        $secret = (string) config('services.whatsapp.app_secret');
        if ($secret === '') {
            return response('Webhook not configured', 503);
        }

        $raw = $request->getContent();
        $expected = 'sha256='.hash_hmac('sha256', $raw, $secret);
        if (! hash_equals($expected, (string) $request->header('X-Hub-Signature-256', ''))) {
            return response('Bad signature', 401);
        }

        $payload = json_decode($raw, true);
        $fields = [];
        foreach ((is_array($payload) ? $payload['entry'] ?? [] : []) as $entry) {
            foreach ((is_array($entry) ? $entry['changes'] ?? [] : []) as $change) {
                $field = is_array($change) ? ($change['field'] ?? null) : null;
                if (is_string($field) && $field !== '') {
                    $fields[$field] = $field;
                }
            }
        }

        WhatsAppWebhookEvent::create([
            'fields' => mb_substr(implode(', ', $fields) ?: '-', 0, 255),
            'payload' => is_array($payload) ? $payload : ['raw' => $raw],
        ]);

        return response('EVENT_RECEIVED', 200);
    }
}
