<?php

namespace App\Support;

use App\Models\Contact;
use App\Models\Setting;

class WhatsApp
{
    protected static ?string $number = null;

    /**
     * Nomor tujuan dalam format internasional (62...), diambil dari Pengaturan & SEO
     * atau nomor di menu Kontak bila pengaturan dikosongkan.
     */
    public static function number(): ?string
    {
        return static::$number ??= static::normalize(
            Setting::get('whatsapp_number') ?: Contact::query()->latest('id')->value('phone')
        );
    }

    public static function normalize(?string $number): ?string
    {
        $digits = preg_replace('/\D/', '', (string) $number);

        if ($digits === '') {
            return null;
        }

        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        if (str_starts_with($digits, '8')) {
            return '62' . $digits;
        }

        return $digits;
    }

    public static function link(?string $message = null): string
    {
        $number = static::number();

        if (! $number) {
            return url('/') . '#contact';
        }

        $url = 'https://wa.me/' . $number;

        return filled($message) ? $url . '?text=' . rawurlencode($message) : $url;
    }
}
