<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";

    protected $guarded = [''];

    /**
     * Nilai bawaan yang dipakai selama belum diubah lewat menu Pengaturan & SEO.
     */
    public const DEFAULTS = [
        // SEO
        'site_name' => 'di-kerja.in',
        'seo_title' => 'Jasa Pembuatan Website & Aplikasi Terjangkau | di-kerja.in',
        'seo_description' => 'Jasa pembuatan website dan aplikasi profesional dengan harga terjangkau: company profile, skripsi/tugas akhir, pengembangan website, dan konsultasi gratis.',
        'seo_keywords' => 'jasa pembuatan website, jasa pembuatan aplikasi, jasa company profile, joki skripsi, joki tugas akhir, joki tugas magang, joki program murah, joki murah laravel, joki murah php',
        'seo_og_image' => null,
        'twitter_site' => '@HameTR29',
        'google_site_verification' => null,
        'google_analytics_id' => null,

        // Hero
        'hero_title' => 'Selamat Datang',
        'hero_highlight' => 'di-kerja.in',
        'hero_subtitle' => 'Jasa Pembuatan Website dan Aplikasi Termurah dan Terpercaya.',

        // Judul section
        'services_title' => 'Keunggulan Kami',
        'services_subtitle' => 'Kami juga mempunyai beberapa keunggulan yang cukup bisa bersaing dengan yang lain.',
        'pricing_title' => 'Harga',
        'pricing_subtitle' => 'Kami menawarkan beberapa harga yang cukup ramah di kantong khusus nya Mahasiswa dan Pelajar.',
        'produk_title' => 'Produk Yang Pernah Dikerjakan',
        'produk_subtitle' => 'Beberapa Dokumentasi Produk Website / Aplikasi Yang Pernah Kami Buat dan Kembangkan',
        'faq_title' => 'Beberapa pertanyaan yang sering diajukan',
        'faq_subtitle' => null,
        'testimonials_title' => 'Apa Kata Mereka?',
        'testimonials_subtitle' => 'Kami juga sudah mendapatkan cukup banyak review dari pelanggan kami',
        'contact_title' => 'Kontak',
        'contact_subtitle' => 'Silahkan hubungi kontak dibawah ini untuk info lebih lanjut.',

        // WhatsApp & footer
        'whatsapp_number' => '6281214707143',
        'whatsapp_message' => 'Hallo Admin, Saya ingin bertanya mengenai',
        'footer_text' => 'All Rights Reserved',
    ];

    protected static ?array $values = null;

    /**
     * Semua pengaturan website, nilai di database menimpa nilai bawaan.
     */
    public static function allValues(): array
    {
        return static::$values ??= array_merge(
            self::DEFAULTS,
            static::query()->pluck('value', 'key')->all()
        );
    }

    public static function get(string $key, $default = null)
    {
        return static::allValues()[$key] ?? $default;
    }

    public static function setMany(array $values): void
    {
        foreach ($values as $key => $value) {
            static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        static::$values = null;
    }
}
