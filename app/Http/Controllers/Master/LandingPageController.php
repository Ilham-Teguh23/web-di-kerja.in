<?php

namespace App\Http\Controllers\Master;

use App\Models\FAQ;
use App\Support\Seo;
use App\Support\Html;
use App\Models\About;
use App\Models\Benefit;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\HeroImage;
use App\Models\PackageItem;
use Illuminate\Http\Request;
use App\Models\ContactMessages;
use App\Models\TestimonialProduct;
use App\Http\Controllers\Controller;
use App\Models\TestimonialCustomer;
use Illuminate\Support\Collection;

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
        $setting = Setting::allValues();
        $heroImage = $this->activeHeroImage();

        // Gambar share: OG image dari pengaturan, kalau belum ada pakai gambar hero aktif
        Seo::apply($setting['seo_title'], $setting['seo_description'], $setting['seo_og_image'] ? null : $heroImage);

        $faq = $this->faq->where("status", "1")->orderBy("created_at", "DESC")->get();
        $packages = PackageItem::with(['price', 'FavoriteItem', 'packageConsultation.detailConsultant'])->orderBy('id')->get();
        $contact = Contact::latest('id')->first();

        $data = [
            "faq" => $faq,
            "benefit" => $this->benefit->where("status", "1")->orderBy("created_at", "ASC")->get(),
            "heroImage" => $heroImage ?: url('/landing-page/assets/img/hero-services-img.png'),
            "about" => About::with(['imageAbout', 'AboutListSuperiority.listSuperiority'])->latest('id')->first(),
            "packages" => $packages,
            "products" => TestimonialProduct::with('imageProduct')->where('status', '1')->latest('id')->get(),
            "testimonials" => TestimonialCustomer::where('status', '1')->latest('id')->get(),
            "contact" => $contact,
            "structuredData" => Seo::schema($this->structuredData($faq, $packages, $contact)),
        ];

        return view("pages.landing-page.index", $data);
    }

    /**
     * Gambar hero terbaru yang berstatus aktif di menu Hero Image.
     */
    protected function activeHeroImage(): ?string
    {
        $image = HeroImage::where('status', '1')->latest('id')->value('image_path');

        return $image ? asset('storage/hero-image/' . $image) : null;
    }

    protected function structuredData(Collection $faq, Collection $packages, ?Contact $contact): array
    {
        $organization = Seo::organization($contact);

        if ($packages->isNotEmpty()) {
            $organization['hasOfferCatalog'] = [
                '@type' => 'OfferCatalog',
                'name' => 'Paket Layanan',
                'itemListElement' => $packages->map(fn ($package) => array_filter([
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name' => $package->name,
                        'description' => Html::text($package->description) ?: null,
                    ],
                    'price' => $package->price?->price,
                    'priceCurrency' => $package->price ? 'IDR' : null,
                ], fn ($value) => ! is_null($value)))->values()->all(),
            ];
        }

        $graph = [$organization, Seo::website()];

        if ($faq->isNotEmpty()) {
            $graph[] = [
                '@type' => 'FAQPage',
                '@id' => url('/') . '#faq',
                'mainEntity' => $faq->map(fn ($item) => [
                    '@type' => 'Question',
                    'name' => $item->pertanyaan,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $item->jawaban,
                    ],
                ])->values()->all(),
            ];
        }

        return $graph;
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
