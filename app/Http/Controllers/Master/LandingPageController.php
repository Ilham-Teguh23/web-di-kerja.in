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

    public function getLocation(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        // Cek apakah latitude dan longitude valid
        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            return response()->json(['error' => 'Invalid coordinates']);
        }

        // URL Nominatim API dengan User-Agent
        $url = "https://nominatim.openstreetmap.org/reverse?lat={$latitude}&lon={$longitude}&format=json";

        // Inisialisasi cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout
        curl_setopt($ch, CURLOPT_USERAGENT, 'YourAppName/1.0 (your-email@example.com)'); // Set User-Agent

        // Eksekusi cURL
        $response = curl_exec($ch);

        // Cek jika cURL gagal
        if (curl_errno($ch)) {
            $error_message = curl_error($ch);
            curl_close($ch);
            return response()->json(['error' => "Unable to fetch location data: " . $error_message]);
        }

        curl_close($ch);

        // Decode response JSON
        $locationData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Error decoding JSON response']);
        }
        // Jika ada data lokasi, kembalikan ke client
        if (isset($locationData['address'])) {
            return response()->json([
                'address' => $locationData['address']['road'] ?? 'N/A' . ', ' .
                    $locationData['address']['city'] ?? 'N/A' . ', ' .
                    $locationData['address']['country'] ?? 'N/A',
                'detail' => [
                    'place_id' => $locationData['place_id'] ?? 'N/A',
                    'osm_type' => $locationData['osm_type'] ?? 'N/A',
                    'osm_id' => $locationData['osm_id'] ?? 'N/A',
                    'lat' => $locationData['lat'] ?? 'N/A',
                    'lon' => $locationData['lon'] ?? 'N/A',
                    'class' => $locationData['class'] ?? 'N/A',
                    'type' => $locationData['type'] ?? 'N/A',
                    'place_rank' => $locationData['place_rank'] ?? 'N/A',
                    'importance' => $locationData['importance'] ?? 'N/A',
                    'addresstype' => $locationData['addresstype'] ?? 'N/A',
                    'name' => $locationData['name'] ?? 'N/A',
                    'display_name' => $locationData['display_name'] ?? 'N/A',
                    'boundingbox' => $locationData['boundingbox'] ?? 'N/A',
                ]
            ]);
        } else {
            return response()->json(['error' => 'Location not found']);
        }
    }
}
