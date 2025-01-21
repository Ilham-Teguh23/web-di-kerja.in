<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\ContactMessages;
use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\FAQ;
use Artesaos\SEOTools\Facades\SEOTools;

class LandingPageController extends Controller
{
    protected $faq, $benefit;

    public function __construct()
    {
        $this->faq = new FAQ();
        $this->benefit = new Benefit();
    }

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

        $data = [
            "faq" => $this->faq->where("status", "1")->orderBy("created_at", "DESC")->get(),
            "benefit" => $this->benefit->where("status", "1")->orderBy("created_at", "ASC")->get()
        ];

        return view("pages.landing-page.index", $data);
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

    public function store(Request $request)
    {
        // dd($request);
        // Validasi data dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Simpan data ke tabel contact_messages
        ContactMessages::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
        ]);

        // Redirect dengan pesan sukses
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
