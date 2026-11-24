<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pengaturan website (SEO, teks hero, judul section, WhatsApp) tersedia di semua halaman publik
        View::composer('pages.landing-page.*', function ($view) {
            $view->with('setting', Setting::allValues());
        });

        View::composer('pages.landing-page.layouts.components.footer.footer', function ($view) {
            $view->with('footerContact', Contact::latest('id')->first());
        });
    }
}
