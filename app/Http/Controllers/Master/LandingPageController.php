<?php

namespace App\Http\Controllers\Master;

use Artesaos\SEOTools\Facades\SEOTools;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Set SEO Meta
        SEOTools::setTitle('Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya');
        SEOTools::setDescription('Kami menawarkan jasa pembuatan aplikasi dan website untuk kebutuhan bisnis Anda.');
        SEOTools::setCanonical(url()->current());

        // OpenGraph
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        // SEOTools::opengraph()->addImage(asset('images/og-image.jpg'));

        // Twitter Card
        SEOTools::twitter()->setSite('@HameTR29');
        SEOTools::twitter()->setTitle('Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya');
        SEOTools::twitter()->setDescription('Kami menawarkan jasa pembuatan aplikasi dan website untuk kebutuhan bisnis Anda.');
        // SEOTools::twitter()->setImage(asset('images/og-image.jpg'));

        // JSON-LD
        SEOTools::jsonLd()->setType('WebPage');
        SEOTools::jsonLd()->setTitle('Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya');
        SEOTools::jsonLd()->setDescription('Kami menawarkan jasa pembuatan aplikasi dan website untuk kebutuhan bisnis Anda.');
        SEOTools::jsonLd()->setUrl(url()->current());

        config([
            'seo.meta' => SEOTools::generate()
        ]);

        return view("pages.landing-page.index");
    }
}
