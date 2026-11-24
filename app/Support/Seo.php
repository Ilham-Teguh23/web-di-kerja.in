<?php

namespace App\Support;

use App\Models\Contact;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\HtmlString;

class Seo
{
    /**
     * Mengisi meta tag, Open Graph, Twitter Card dan canonical untuk halaman publik.
     */
    public static function apply(string $title, ?string $description = null, ?string $image = null): void
    {
        $setting = Setting::allValues();
        $url = url()->current();

        SEOTools::setTitle($title, false);
        SEOTools::setDescription($description ?: $setting['seo_description']);
        SEOTools::setCanonical($url);
        SEOTools::addImages($image ?: static::defaultImage());

        $keywords = array_values(array_filter(array_map('trim', explode(',', (string) $setting['seo_keywords']))));

        SEOTools::metatags()->setKeywords($keywords);
        SEOTools::metatags()->setRobots('index, follow');

        if (filled($setting['google_site_verification'])) {
            SEOTools::metatags()->addMeta('google-site-verification', $setting['google_site_verification']);
        }

        SEOTools::opengraph()->setUrl($url);
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setSiteName($setting['site_name']);
        SEOTools::opengraph()->addProperty('locale', 'id_ID');

        SEOTools::twitter()->setType('summary_large_image');

        if (filled($setting['twitter_site'])) {
            SEOTools::twitter()->setSite($setting['twitter_site']);
        }

        SEOTools::jsonLd()->setType('WebPage');
        SEOTools::jsonLd()->setUrl($url);
    }

    public static function defaultImage(): string
    {
        $image = Setting::get('seo_og_image');

        return $image
            ? asset('storage/setting/' . $image)
            : asset('assets-images/logo_aplikasi.png');
    }

    /**
     * Data terstruktur (schema.org) untuk profil usaha, dipakai mesin pencari untuk knowledge panel.
     */
    public static function organization(?Contact $contact = null): array
    {
        $setting = Setting::allValues();

        $organization = [
            '@type' => 'ProfessionalService',
            '@id' => url('/') . '#organization',
            'name' => $setting['site_name'],
            'url' => url('/'),
            'logo' => asset('assets-images/logo_aplikasi.png'),
            'image' => static::defaultImage(),
            'description' => $setting['seo_description'],
        ];

        if ($contact) {
            $organization['email'] = $contact->email;
            $organization['telephone'] = $contact->phone;

            if (filled($contact->address)) {
                $organization['address'] = [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $contact->address,
                    'addressCountry' => 'ID',
                ];
            }

            $socials = collect([$contact->link_fb, $contact->link_ig, $contact->link_twitter, $contact->link_tiktok])
                ->filter(fn ($link) => filled($link) && str_starts_with($link, 'http'))
                ->values()
                ->all();

            if ($socials) {
                $organization['sameAs'] = $socials;
            }
        }

        return array_filter($organization, fn ($value) => filled($value));
    }

    public static function website(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'url' => url('/'),
            'name' => Setting::get('site_name'),
            'inLanguage' => 'id-ID',
            'publisher' => ['@id' => url('/') . '#organization'],
        ];
    }

    public static function schema(array $graph): HtmlString
    {
        $json = json_encode(
            ['@context' => 'https://schema.org', '@graph' => array_values($graph)],
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG
        );

        return new HtmlString('<script type="application/ld+json">' . $json . '</script>');
    }
}
