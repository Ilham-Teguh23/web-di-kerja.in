<?php

namespace Tests\Feature\WhatsApp;

use App\Models\User;
use App\Models\WhatsAppOnboarding;
use App\Models\WhatsAppWebhookEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WhatsAppAdminTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.whatsapp' => [
            'graph_version' => 'v27.0',
            'access_token' => 'system-user-token',
            'business_id' => '1697301891305855',
            'waba_id' => '1421928646462133',
            'phone_number_id' => '1248772374987899',
            'app_id' => '2488946551530995',
            'app_secret' => 'app-secret',
            'es_config_id' => '1165390409339510',
            'webhook_verify_token' => 'verify-me',
        ]]);
        Http::preventStrayRequests();

        $this->admin = User::factory()->create(['username' => 'admin']);
    }

    public function test_guests_are_sent_to_login(): void
    {
        $this->get('/master/whatsapp')->assertRedirect(route('login'));
        $this->postJson('/master/whatsapp/messages', ['to' => '0812'])->assertUnauthorized();
    }

    public function test_the_page_shows_the_ids_and_webhook_but_no_secrets(): void
    {
        $this->actingAs($this->admin)->get('/master/whatsapp')
            ->assertOk()
            ->assertSee('1421928646462133')
            ->assertSee('1165390409339510')
            ->assertSee(route('whatsapp.webhook.receive'))
            ->assertDontSee('system-user-token')
            ->assertDontSee('app-secret');
    }

    public function test_send_message_posts_a_text_from_the_business_number(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['messages' => [['id' => 'wamid.1']]])]);

        $this->actingAs($this->admin)->postJson('/master/whatsapp/messages', [
            'to' => '0812-3456-789', 'type' => 'text', 'text' => 'Halo',
        ])->assertOk()
            ->assertJsonPath('body.messages.0.id', 'wamid.1')
            ->assertJsonPath('request.url', 'https://graph.facebook.com/v27.0/1248772374987899/messages');

        Http::assertSent(fn (Request $request) => $request->method() === 'POST'
            && $request->hasHeader('Authorization', 'Bearer system-user-token')
            && $request['to'] === '628123456789'
            && $request['text'] === ['body' => 'Halo']);
    }

    public function test_send_message_needs_a_number_and_a_token(): void
    {
        $this->actingAs($this->admin)->postJson('/master/whatsapp/messages', ['to' => '', 'text' => 'Halo'])
            ->assertStatus(422)->assertJsonPath('error.message', 'Recipient number is required.');

        config(['services.whatsapp.access_token' => '']);
        $this->actingAs($this->admin)->getJson('/master/whatsapp/templates')
            ->assertStatus(400)->assertJsonPath('error.message', 'WA_ACCESS_TOKEN is empty. Put a token in .env first.');
    }

    public function test_templates_are_read_with_their_text(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['data' => []])]);

        $this->actingAs($this->admin)->getJson('/master/whatsapp/templates')->assertOk();

        Http::assertSent(fn (Request $request) => str_contains(urldecode($request->url()), 'fields=id,name,status,category,language,parameter_format,components'));
    }

    public function test_send_template_fills_numbered_named_and_header_variables(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['messages' => [['id' => 'wamid.2']]])]);

        $this->actingAs($this->admin)->postJson('/master/whatsapp/messages', [
            'to' => '083123555526',
            'type' => 'template',
            'template' => 'task_completed_notice',
            'language' => 'id',
            'header_params' => [['key' => '1', 'value' => 'Tugas #12']],
            'body_params' => [
                ['key' => '2', 'value' => 'Senin'],
                ['key' => '1', 'value' => 'Budi'],
                ['key' => '10', 'value' => 'ke-10'],
            ],
        ])->assertOk()->assertJsonPath('body.messages.0.id', 'wamid.2');

        Http::assertSent(fn (Request $request) => $request['to'] === '6283123555526'
            && $request['type'] === 'template'
            && $request['template']['name'] === 'task_completed_notice'
            && $request['template']['language'] === ['code' => 'id']
            && $request['template']['components'] === [
                ['type' => 'header', 'parameters' => [['type' => 'text', 'text' => 'Tugas #12']]],
                ['type' => 'body', 'parameters' => [
                    ['type' => 'text', 'text' => 'Budi'],
                    ['type' => 'text', 'text' => 'Senin'],
                    ['type' => 'text', 'text' => 'ke-10'],
                ]],
            ]);

        $this->actingAs($this->admin)->postJson('/master/whatsapp/messages', [
            'to' => '083123555526', 'type' => 'template', 'template' => 'order_update', 'language' => 'en_US',
            'body_params' => [['key' => 'customer_name', 'value' => 'Budi']],
        ])->assertOk();

        Http::assertSent(fn (Request $request) => $request['template']['name'] === 'order_update'
            && $request['template']['components'] === [
                ['type' => 'body', 'parameters' => [['type' => 'text', 'parameter_name' => 'customer_name', 'text' => 'Budi']]],
            ]);
    }

    public function test_send_template_needs_a_name_and_every_variable(): void
    {
        $this->actingAs($this->admin)->postJson('/master/whatsapp/messages', ['to' => '0812', 'type' => 'template'])
            ->assertStatus(422)->assertJsonPath('error.message', 'Choose a template.');

        $this->actingAs($this->admin)->postJson('/master/whatsapp/messages', [
            'to' => '0812', 'type' => 'template', 'template' => 'task_completed_notice',
            'body_params' => [['key' => '1', 'value' => '  ']],
        ])->assertStatus(422)->assertJsonPath('error.message', 'Fill in every template variable.');

        Http::assertNothingSent();
    }

    public function test_send_template_without_variables_has_no_components(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['messages' => [['id' => 'wamid.3']]])]);

        $this->actingAs($this->admin)->postJson('/master/whatsapp/messages', [
            'to' => '0812', 'type' => 'template', 'template' => 'hello_world', 'language' => 'en_US',
        ])->assertOk();

        Http::assertSent(fn (Request $request) => $request['template'] === ['name' => 'hello_world', 'language' => ['code' => 'en_US']]);
    }

    public function test_create_template_submits_a_utility_template(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['id' => '99', 'status' => 'PENDING', 'category' => 'UTILITY'])]);

        $this->actingAs($this->admin)->postJson('/master/whatsapp/templates', [
            'name' => 'Task Done!', 'language' => 'id', 'body' => 'Halo {{1}}', 'example' => 'Budi',
        ])->assertOk()->assertJsonPath('body.status', 'PENDING');

        Http::assertSent(fn (Request $request) => $request['name'] === 'task_done_'
            && $request['category'] === 'UTILITY'
            && $request['components'][0]['example']['body_text'] === [['Budi']]);
    }

    public function test_embedded_signup_keeps_the_business_token_encrypted(): void
    {
        Http::fake([
            'graph.facebook.com/v27.0/oauth/access_token*' => Http::response(['access_token' => 'business-token']),
            'graph.facebook.com/v27.0/1091974713442894/subscribed_apps' => Http::response(['success' => true]),
            'graph.facebook.com/v27.0/1091974713442894/phone_numbers*' => Http::response(['data' => [
                ['id' => '777000', 'display_phone_number' => '+62 812-0000-8566', 'is_on_biz_app' => true],
            ]]),
        ]);

        $response = $this->actingAs($this->admin)->postJson('/master/whatsapp/embedded-signup', [
            'code' => 'signup-code', 'waba_id' => '1091974713442894',
        ]);

        $response->assertOk()
            ->assertJsonPath('onboarding.phone_number_id', '777000')
            ->assertJsonPath('onboarding.waba_id', '1091974713442894')
            ->assertJsonCount(3, 'steps')
            ->assertJsonMissingPath('onboarding.access_token');
        $this->assertStringNotContainsString('business-token', $response->getContent());
        $this->assertStringNotContainsString('signup-code', $response->getContent());

        $this->assertSame('business-token', WhatsAppOnboarding::sole()->access_token);
        $this->assertNotSame('business-token', DB::table('whatsapp_onboardings')->value('access_token'));
        Http::assertSent(fn (Request $request) => str_contains($request->url(), '/subscribed_apps')
            && $request->hasHeader('Authorization', 'Bearer business-token'));
        Http::assertSent(fn (Request $request) => str_contains($request->url(), 'oauth/access_token')
            && ! $request->hasHeader('Authorization'));
    }

    public function test_embedded_signup_reports_a_failed_code_exchange(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['error' => ['message' => 'Invalid verification code']], 400)]);

        $this->actingAs($this->admin)->postJson('/master/whatsapp/embedded-signup', ['code' => 'bad'])
            ->assertStatus(502)
            ->assertJsonPath('error.message', 'Invalid verification code')
            ->assertJsonPath('steps.0.status', 400);

        $this->assertSame(0, WhatsAppOnboarding::count());
    }

    public function test_each_sync_runs_only_once(): void
    {
        WhatsAppOnboarding::create([
            'waba_id' => '1091974713442894', 'phone_number_id' => '777000',
            'access_token' => 'business-token', 'onboarded_at' => now(),
        ]);
        Http::fake(['graph.facebook.com/v27.0/777000/smb_app_data' => Http::response(['success' => true, 'request_id' => 'r-1'])]);

        $this->actingAs($this->admin)->postJson('/master/whatsapp/embedded-signup/sync', ['type' => 'smb_app_state_sync'])
            ->assertOk()
            ->assertJsonPath('request_id', 'r-1')
            ->assertJsonPath('onboarding.synced.history', null);
        $this->assertNotNull(WhatsAppOnboarding::sole()->contacts_synced_at);

        $this->actingAs($this->admin)->postJson('/master/whatsapp/embedded-signup/sync', ['type' => 'smb_app_state_sync'])
            ->assertStatus(409);
        $this->actingAs($this->admin)->postJson('/master/whatsapp/embedded-signup/sync', ['type' => 'contacts'])
            ->assertStatus(422);

        Http::assertSentCount(1);
        Http::assertSent(fn (Request $request) => $request['sync_type'] === 'smb_app_state_sync'
            && $request->hasHeader('Authorization', 'Bearer business-token'));
    }

    public function test_status_and_webhook_log(): void
    {
        $this->actingAs($this->admin)->getJson('/master/whatsapp/embedded-signup')->assertOk()->assertJsonPath('onboarding', null);

        WhatsAppWebhookEvent::create(['fields' => 'history', 'payload' => ['entry' => [['id' => '1']]]]);
        $this->actingAs($this->admin)->getJson('/master/whatsapp/webhook-events')
            ->assertOk()
            ->assertJsonPath('entries.0.fields', 'history')
            ->assertJsonPath('entries.0.payload.entry.0.id', '1');
    }
}
