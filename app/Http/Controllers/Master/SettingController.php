<?php

namespace App\Http\Controllers\Master;

use App\Models\Setting;
use App\Support\WhatsApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Section landing page yang judul & subjudulnya bisa diatur.
     */
    public const SECTIONS = [
        'services' => 'Keunggulan',
        'pricing' => 'Harga',
        'produk' => 'Produk',
        'faq' => 'FAQ',
        'testimonials' => 'Testimoni',
        'contact' => 'Kontak',
    ];

    public function index()
    {
        return view("dashboard.setting.index", [
            "setting" => Setting::allValues(),
            "sections" => self::SECTIONS,
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'site_name' => 'required|string|max:100',
            'seo_title' => 'required|string|max:120',
            'seo_description' => 'required|string|max:300',
            'seo_keywords' => 'nullable|string|max:500',
            'seo_og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'twitter_site' => 'nullable|string|max:50',
            'google_site_verification' => 'nullable|string|max:100',
            'google_analytics_id' => ['nullable', 'string', 'max:30', 'regex:/^G-[A-Z0-9]+$/'],
            'hero_title' => 'required|string|max:100',
            'hero_highlight' => 'nullable|string|max:100',
            'hero_subtitle' => 'nullable|string|max:255',
            'whatsapp_number' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'whatsapp_message' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string|max:255',
        ];

        foreach (array_keys(self::SECTIONS) as $section) {
            $rules[$section . '_title'] = 'required|string|max:150';
            $rules[$section . '_subtitle'] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules, [
            'google_analytics_id.regex' => 'Format Measurement ID harus seperti G-XXXXXXXXXX.',
            'whatsapp_number.regex' => 'Nomor WhatsApp hanya boleh berisi angka.',
        ]);

        $validated['whatsapp_number'] = WhatsApp::normalize($validated['whatsapp_number']);
        unset($validated['seo_og_image']);

        if ($request->hasFile('seo_og_image')) {
            $validated['seo_og_image'] = $this->storeOgImage($request->file('seo_og_image'));
        }

        Setting::setMany($validated);

        return redirect()->route('setting.index')->with('success', 'Pengaturan website berhasil disimpan.');
    }

    protected function storeOgImage($file): string
    {
        $dir = public_path('storage/setting');
        File::ensureDirectoryExists($dir, 0755);

        // Nama & ekstensi ditentukan server, bukan dari nama file yang diunggah
        $filename = 'og-image-' . time() . '.' . $file->extension();
        $file->move($dir, $filename);

        $oldImage = Setting::get('seo_og_image');

        if ($oldImage && File::exists($dir . '/' . basename($oldImage))) {
            File::delete($dir . '/' . basename($oldImage));
        }

        return $filename;
    }
}
