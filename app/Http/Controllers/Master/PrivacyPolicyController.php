<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use App\Support\Seo;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $siteName = Setting::get('site_name');

        Seo::apply(
            'Kebijakan Privasi | ' . $siteName,
            'Kebijakan privasi ' . $siteName . ': bagaimana data pribadi Anda digunakan, disimpan, dan dihapus saat memakai layanan pembuatan website dan aplikasi kami.'
        );

        return view('pages.landing-page.privacy-policy', [
            'contact' => Contact::latest('id')->first(),
        ]);
    }
}
