<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use App\Models\TestimonialProduct;
use App\Support\Html;
use App\Support\Seo;

class ProductController extends Controller
{
    public function detail($slug)
    {
        $product = TestimonialProduct::with('imageProduct')
            ->where('slug', $slug)
            ->where('status', '1')
            ->firstOrFail();

        $siteName = Setting::get('site_name');
        $images = $product->imageProduct
            ->map(fn ($image) => asset('storage/testimonial-product/' . $image->gambar))
            ->values();

        Seo::apply(
            $product->nama . ' | ' . $siteName,
            Html::text($product->deskripsi, 160) ?: null,
            $images->first()
        );

        $url = route('produk.detail', $product->slug);

        $structuredData = Seo::schema([
            Seo::organization(Contact::latest('id')->first()),
            array_filter([
                '@type' => 'CreativeWork',
                '@id' => $url . '#produk',
                'name' => $product->nama,
                'description' => Html::text($product->deskripsi) ?: null,
                'url' => $url,
                'image' => $images->all() ?: null,
                'creator' => ['@id' => url('/') . '#organization'],
            ]),
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Produk', 'item' => url('/') . '#produk'],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $product->nama, 'item' => $url],
                ],
            ],
        ]);

        return view("pages.landing-page.produk.detail", [
            "product" => $product,
            "images" => $images,
            "otherProducts" => TestimonialProduct::with('imageProduct')
                ->where('status', '1')
                ->whereKeyNot($product->getKey())
                ->latest('id')
                ->take(3)
                ->get(),
            "structuredData" => $structuredData,
        ]);
    }
}
