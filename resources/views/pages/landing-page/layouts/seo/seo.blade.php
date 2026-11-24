{{-- Title, meta description, canonical, Open Graph, Twitter Card & JSON-LD dari App\Support\Seo --}}
{!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}

@isset($structuredData)
    {!! $structuredData !!}
@endisset

<meta name="theme-color" content="#ffffff">

@if (filled($setting['google_analytics_id'] ?? null))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting['google_analytics_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', @json($setting['google_analytics_id']));
    </script>
@endif
