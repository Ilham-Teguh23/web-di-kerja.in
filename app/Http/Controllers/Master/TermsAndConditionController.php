<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        // Title & meta
        SEOTools::setTitle('Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya');
        SEOTools::setDescription('Kami menawarkan jasa pembuatan aplikasi dan website untuk kebutuhan bisnis Anda.');
        SEOTools::setCanonical(url()->current());

        // OpenGraph
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addProperty('site_name', config('app.name', 'di-kerja.in'));
        // SEOTools::opengraph()->addImage(asset('images/og-image.jpg')); // opsional

        // Twitter Card
        SEOTools::twitter()->setType('summary_large_image'); // lebih menarik saat dibagikan
        SEOTools::twitter()->setSite('@HameTR29');
        SEOTools::twitter()->setTitle('Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya');
        SEOTools::twitter()->setDescription('Kami menawarkan jasa pembuatan aplikasi dan website untuk kebutuhan bisnis Anda.');
        // SEOTools::twitter()->setImage(asset('images/og-image.jpg')); // opsional

        // JSON-LD
        SEOTools::jsonLd()->setType('PrivacyPolicy');
        SEOTools::jsonLd()->setTitle('Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya');
        SEOTools::jsonLd()->setDescription('Kami menawarkan jasa pembuatan aplikasi dan website untuk kebutuhan bisnis Anda.');
        SEOTools::jsonLd()->setUrl(url()->current());
        // SEOTools::jsonLd()->addImage(asset('images/og-image.jpg')); // opsional

        config([
            'seo.meta' => SEOTools::generate()
        ]);
        
        return view("pages.landing-page.terms-condition");
    }
}
