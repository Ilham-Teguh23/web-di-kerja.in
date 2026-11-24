<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use App\Support\Seo;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        $siteName = Setting::get('site_name');

        Seo::apply(
            'Syarat & Ketentuan | ' . $siteName,
            'Syarat dan ketentuan layanan ' . $siteName . ': layanan yang disediakan, kewajiban pengguna, pembayaran, pengembalian dana, dan tanggung jawab.'
        );

        return view("pages.landing-page.terms-condition", [
            "contact" => Contact::latest('id')->first(),
        ]);
    }
}
