<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** One POST from Meta to /webhooks/whatsapp. */
class WhatsAppWebhookEvent extends Model
{
    protected $table = 'whatsapp_webhook_events';

    protected $fillable = ['fields', 'payload'];

    protected function casts(): array
    {
        return ['payload' => 'array'];
    }
}
