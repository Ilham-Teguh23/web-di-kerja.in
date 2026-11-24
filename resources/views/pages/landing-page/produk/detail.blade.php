<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('pages.landing-page.layouts.seo.seo')

    @include('pages.landing-page.layouts.favico.favico')

    @include('pages.landing-page.layouts.fonts.font')

    @include('pages.landing-page.layouts.css.style')


</head>

<body class="index-page">

    @include('pages.landing-page.layouts.components.header.header')

    <main class="main">

        <section class="section product-detail">
            <div class="container">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/') }}#produk">Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->nama }}</li>
                    </ol>
                </nav>

                <div class="row gy-4">
                    <div class="col-lg-8">
                        <h1>{{ $product->nama }}</h1>

                        @if ($images->isNotEmpty())
                            <div class="row gy-3 mb-4 product-gallery">
                                @foreach ($images as $image)
                                    <div class="{{ $loop->first ? 'col-12 main-image' : 'col-md-4 col-6' }}">
                                        <a href="{{ $image }}" class="glightbox" data-gallery="produk-{{ $product->id }}">
                                            <img src="{{ $image }}" alt="{{ $product->nama }} - gambar {{ $loop->iteration }}"
                                                @if (! $loop->first) loading="lazy" @endif>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="product-description">
                            {!! \App\Support\Html::clean($product->deskripsi) !!}
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cta-box">
                            <h2 class="h5 fw-bold">Butuh project serupa?</h2>
                            <p>
                                Konsultasikan kebutuhan website atau aplikasi Anda bersama tim {{ $setting['site_name'] }}.
                            </p>
                            <a target="_blank" rel="noopener" class="btn-site w-100"
                                href="{{ \App\Support\WhatsApp::link(trim($setting['whatsapp_message'] . ' pembuatan project seperti ' . $product->nama)) }}">
                                <i class="bi bi-whatsapp"></i> Hubungi Admin
                            </a>
                            <div class="mt-3">
                                <a href="{{ url('/') }}#pricing">Lihat paket harga &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($otherProducts->isNotEmpty())
                    <div class="mt-5 other-products">
                        <h2 class="h4 fw-bold mb-4">Produk Lainnya</h2>
                        <div class="row gy-4">
                            @foreach ($otherProducts as $other)
                                @php
                                    $otherImage = $other->imageProduct->pluck('gambar')->filter()->first();
                                @endphp
                                <div class="col-md-4">
                                    <a href="{{ route('produk.detail', $other->slug) }}" class="d-block text-reset">
                                        @if ($otherImage)
                                            <img src="{{ asset('storage/testimonial-product/' . $otherImage) }}"
                                                alt="{{ $other->nama }}" loading="lazy">
                                        @endif
                                        <h3 class="h6 fw-bold mt-3">{{ $other->nama }}</h3>
                                        <p class="small text-muted mb-0">
                                            {{ \App\Support\Html::text($other->deskripsi, 100) }}
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </section>

    </main>

    @include('pages.landing-page.layouts.components.footer.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center" aria-label="Kembali ke atas"><i
            class="bi bi-arrow-up-short"></i></a>


    <div id="preloader"></div>

    @include('pages.landing-page.layouts.js.style')

</body>

</html>
