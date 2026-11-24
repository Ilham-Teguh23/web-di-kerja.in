<?php

namespace App\Http\Controllers;

use App\Models\TestimonialProduct;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = collect([
            ['loc' => url('/'), 'lastmod' => null],
            ['loc' => route('termsAndCondition'), 'lastmod' => null],
            ['loc' => route('privacyPolicy'), 'lastmod' => null],
        ]);

        $products = TestimonialProduct::where('status', '1')
            ->whereNotNull('slug')
            ->latest('id')
            ->get(['slug', 'updated_at']);

        foreach ($products as $product) {
            $urls->push([
                'loc' => route('produk.detail', $product->slug),
                'lastmod' => $product->updated_at,
            ]);
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots()
    {
        $lines = [
            'User-agent: *',
            'Disallow: /master/',
            'Disallow: /auth/',
            'Disallow: /api/',
            '',
            'Sitemap: ' . route('sitemap'),
        ];

        return response(implode(PHP_EOL, $lines) . PHP_EOL)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
