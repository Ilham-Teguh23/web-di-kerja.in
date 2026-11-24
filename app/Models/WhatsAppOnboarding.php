<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A WhatsApp Business app number connected through Embedded Signup
 * (Coexistence). The business token is stored encrypted and never leaves the
 * server.
 */
class WhatsAppOnboarding extends Model
{
    /** Sync type for POST /{phone-number-id}/smb_app_data => column. */
    public const SYNC_COLUMNS = [
        'smb_app_state_sync' => 'contacts_synced_at',
        'history' => 'history_synced_at',
    ];

    protected $table = 'whatsapp_onboardings';

    protected $fillable = [
        'waba_id',
        'phone_number_id',
        'phone',
        'access_token',
        'onboarded_at',
        'contacts_synced_at',
        'history_synced_at',
    ];

    protected $hidden = ['access_token'];

    protected function casts(): array
    {
        return [
            'phone' => 'array',
            'access_token' => 'encrypted',
            'onboarded_at' => 'datetime',
            'contacts_synced_at' => 'datetime',
            'history_synced_at' => 'datetime',
        ];
    }

    /** What the admin page shows (no token). Times in WIB. */
    public function summary(): array
    {
        $time = fn ($value) => $value?->timezone('Asia/Jakarta')->format('d M Y H:i').' WIB';

        return [
            'waba_id' => $this->waba_id,
            'phone_number_id' => $this->phone_number_id,
            'phone' => $this->phone,
            'onboarded_at' => $time($this->onboarded_at),
            'sync_deadline' => $time($this->onboarded_at?->copy()->addDay()),
            'synced' => [
                'smb_app_state_sync' => $this->contacts_synced_at ? $time($this->contacts_synced_at) : null,
                'history' => $this->history_synced_at ? $time($this->history_synced_at) : null,
            ],
        ];
    }
}
