<?php

namespace Tests\Feature\WhatsApp;

use App\Models\WhatsAppWebhookEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhatsAppWebhookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.whatsapp.webhook_verify_token' => 'verify-me',
            'services.whatsapp.app_secret' => 'app-secret',
        ]);
    }

    public function test_meta_verification_returns_the_challenge(): void
    {
        $this->get('/webhooks/whatsapp?hub.mode=subscribe&hub.verify_token=verify-me&hub.challenge=12345')
            ->assertOk()
            ->assertSeeText('12345');
    }

    public function test_verification_with_a_wrong_token_is_refused(): void
    {
        $this->get('/webhooks/whatsapp?hub.mode=subscribe&hub.verify_token=nope&hub.challenge=12345')
            ->assertForbidden();

        config(['services.whatsapp.webhook_verify_token' => '']);
        $this->get('/webhooks/whatsapp?hub.mode=subscribe&hub.verify_token=&hub.challenge=12345')
            ->assertForbidden();
    }

    public function test_a_signed_event_is_kept_without_csrf_or_session(): void
    {
        $raw = json_encode(['object' => 'whatsapp_business_account', 'entry' => [[
            'id' => '1091974713442894',
            'changes' => [
                ['field' => 'history', 'value' => ['messaging_product' => 'whatsapp']],
                ['field' => 'smb_app_state_sync', 'value' => []],
                ['field' => 'history', 'value' => []],
            ],
        ]]]);

        $response = $this->call('POST', '/webhooks/whatsapp', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X_HUB_SIGNATURE_256' => 'sha256='.hash_hmac('sha256', $raw, 'app-secret'),
        ], $raw);

        $response->assertOk()->assertSeeText('EVENT_RECEIVED')->assertCookieMissing(config('session.cookie'));
        $event = WhatsAppWebhookEvent::sole();
        $this->assertSame('history, smb_app_state_sync', $event->fields);
        $this->assertSame('1091974713442894', $event->payload['entry'][0]['id']);
    }

    public function test_an_event_with_a_bad_signature_is_refused(): void
    {
        $raw = json_encode(['entry' => []]);

        $this->call('POST', '/webhooks/whatsapp', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X_HUB_SIGNATURE_256' => 'sha256='.hash_hmac('sha256', $raw, 'other-secret'),
        ], $raw)->assertStatus(401);

        $this->call('POST', '/webhooks/whatsapp', [], [], [], ['CONTENT_TYPE' => 'application/json'], $raw)
            ->assertStatus(401);

        $this->assertSame(0, WhatsAppWebhookEvent::count());
    }

    public function test_events_are_refused_until_the_app_secret_is_set(): void
    {
        config(['services.whatsapp.app_secret' => '']);
        $raw = json_encode(['entry' => []]);

        $this->call('POST', '/webhooks/whatsapp', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X_HUB_SIGNATURE_256' => 'sha256='.hash_hmac('sha256', $raw, ''),
        ], $raw)->assertStatus(503);

        $this->assertSame(0, WhatsAppWebhookEvent::count());
    }
}
