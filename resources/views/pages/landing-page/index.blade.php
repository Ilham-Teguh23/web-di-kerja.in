<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('pages.landing-page.layouts.seo.seo')

    <link rel="preload" as="image" href="{{ $heroImage }}">

    @include('pages.landing-page.layouts.favico.favico')

    @include('pages.landing-page.layouts.fonts.font')

    @include('pages.landing-page.layouts.css.style')

</head>

<body class="index-page">

    @include('pages.landing-page.layouts.components.header.header')

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container">
                <div class="row align-items-center gy-5">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1 data-aos="fade-up">
                            {{ $setting['hero_title'] }}
                            @if (filled($setting['hero_highlight']))
                                <span>{{ $setting['hero_highlight'] }}</span>
                            @endif
                        </h1>
                        @if (filled($setting['hero_subtitle']))
                            <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                                {{ $setting['hero_subtitle'] }}
                            </p>
                        @endif
                        <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start" data-aos="fade-up" data-aos-delay="150">
                            <a href="{{ \App\Support\WhatsApp::link(trim($setting['whatsapp_message'] . ' layanan ' . $setting['site_name'])) }}"
                                class="btn-site" target="_blank" rel="noopener">
                                <i class="bi bi-whatsapp"></i> Konsultasi via WhatsApp
                            </a>
                            @if ($packages->isNotEmpty())
                                <a href="#pricing" class="btn-site-outline">Lihat Paket Harga</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="{{ $heroImage }}" class="img-fluid hero-img" fetchpriority="high"
                            alt="{{ $setting['site_name'] }} - {{ $setting['hero_subtitle'] ?: $setting['seo_title'] }}"
                            data-aos="zoom-out" data-aos-delay="200">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        @if ($about)
        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    @php
                        $aboutImages = $about->imageAbout->pluck('gambar')->filter()->values();
                        $superiorities = $about->AboutListSuperiority->pluck('listSuperiority')->filter();
                    @endphp

                    <div class="{{ $aboutImages->isEmpty() ? 'col-lg-12' : 'col-lg-6' }} content" data-aos="fade-up" data-aos-delay="100">
                        <p class="who-we-are">{{ $about->keunggulan }}</p>
                        @if (filled($about->title_keunggulan))
                            <h3>{{ $about->title_keunggulan }}</h3>
                        @endif
                        @if (filled(\App\Support\Html::text($about->description)))
                            <div class="about-description">
                                {!! \App\Support\Html::clean($about->description) !!}
                            </div>
                        @endif
                        @if ($superiorities->isNotEmpty())
                            <ul>
                                @foreach ($superiorities as $superiority)
                                    <li>
                                        <i class="bi bi-check-circle"></i>
                                        <span>{{ $superiority->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    @if ($aboutImages->isNotEmpty())
                    <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">
                            @if ($aboutImages->count() === 1)
                                <div class="col-lg-12">
                                    <img src="{{ asset('storage/about/' . $aboutImages->first()) }}" class="img-fluid"
                                        alt="Tentang {{ $setting['site_name'] }}" loading="lazy">
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <img src="{{ asset('storage/about/' . $aboutImages->first()) }}" class="img-fluid"
                                        alt="Tentang {{ $setting['site_name'] }} 1" loading="lazy">
                                </div>
                                <div class="col-lg-6">
                                    <div class="row gy-4">
                                        @foreach ($aboutImages->slice(1) as $image)
                                            <div class="col-lg-12">
                                                <img src="{{ asset('storage/about/' . $image) }}" class="img-fluid"
                                                    alt="Tentang {{ $setting['site_name'] }} {{ $loop->iteration + 1 }}" loading="lazy">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                    @endif

                </div>

            </div>
        </section><!-- /About Section -->
        @endif

        @if ($benefit->isNotEmpty())
        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $setting['services_title'] }}</h2>
                @if (filled($setting['services_subtitle']))
                    <p>{{ $setting['services_subtitle'] }}</p>
                @endif
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    @foreach ($benefit as $item)
                    @php
                        // Ikon diisi dari dashboard, terima "bi bi-activity" maupun "bi-activity"
                        $icon = trim((string) $item->icon) ?: 'bi bi-activity';
                        $icon = str_starts_with($icon, 'bi-') ? 'bi ' . $icon : $icon;
                    @endphp
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <i class="{{ $icon }} icon"></i>
                            <div>
                                <h3>{{ $item["judul"] }}</h3>
                                <p>
                                    {{ $item["deskripsi"] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>

        </section><!-- /Services Section -->
        @endif

        @if ($packages->isNotEmpty())
        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $setting['pricing_title'] }}</h2>
                @if (filled($setting['pricing_subtitle']))
                    <p>{{ $setting['pricing_subtitle'] }}</p>
                @endif
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    @foreach ($packages as $package)
                    @php
                        $price = $package->price?->price;
                        $packageImage = $package->image_path ? asset('storage/image_item_package/' . $package->image_path) : null;
                        $features = $package->packageConsultation->pluck('detailConsultant')->filter();
                    @endphp
                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 3 + 1) * 100 }}">
                        <div class="pricing-item {{ $package->FavoriteItem ? 'featured' : '' }} {{ $packageImage ? 'promo-bg' : '' }}"
                            @if ($packageImage) style="background-image: url('{{ $packageImage }}')" @endif>
                            @if ($package->FavoriteItem)
                                <p class="popular">{{ $package->FavoriteItem->name }}</p>
                            @endif
                            <h3>{{ $package->name }}</h3>
                            @if (filled(\App\Support\Html::text($package->description)))
                                <div class="description">
                                    {!! \App\Support\Html::clean($package->description) !!}
                                </div>
                            @endif
                            @if (! is_null($price))
                                <div class="price">
                                    @if ($price > 0)
                                        <span class="price-label">Mulai dari</span>
                                        <h4><sup>Rp</sup>{{ number_format($price, 0, ',', '.') }}</h4>
                                    @else
                                        <span class="price-label">Biaya</span>
                                        <h4>Gratis</h4>
                                    @endif
                                </div>
                            @endif
                            <a target="_blank" rel="noopener"
                                href="{{ \App\Support\WhatsApp::link(trim($setting['whatsapp_message'] . ' ' . $package->name)) }}"
                                class="cta-btn">Hubungi Admin</a>
                            @if ($features->isNotEmpty())
                                <ul>
                                    @foreach ($features as $feature)
                                        <li><i class="bi bi-check"></i> <span>{{ $feature->name }}</span></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div><!-- End Pricing Item -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Pricing Section -->
        @endif

        @if ($products->isNotEmpty())
        <section id="produk" class="produk section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $setting['produk_title'] }}</h2>
                @if (filled($setting['produk_subtitle']))
                    <p>{{ $setting['produk_subtitle'] }}</p>
                @endif
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    @foreach ($products as $product)
                    @php
                        $productImages = $product->imageProduct->pluck('gambar')->filter()->values();
                    @endphp
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3 + 1) * 100 }}">
                        <article class="product-card d-flex flex-column h-100">
                            @if ($productImages->count() > 1)
                                <div id="carouselProduk{{ $product->id }}" class="carousel slide product-card-media" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        @foreach ($productImages as $image)
                                            <button type="button" data-bs-target="#carouselProduk{{ $product->id }}"
                                                data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"
                                                @if ($loop->first) aria-current="true" @endif
                                                aria-label="Slide {{ $loop->iteration }}"></button>
                                        @endforeach
                                    </div>
                                    <div class="carousel-inner">
                                        @foreach ($productImages as $image)
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                <img src="{{ asset('storage/testimonial-product/' . $image) }}" class="d-block"
                                                    alt="{{ $product->nama }} - gambar {{ $loop->iteration }}" loading="lazy">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselProduk{{ $product->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselProduk{{ $product->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @elseif ($productImages->isNotEmpty())
                                <a href="{{ route('produk.detail', $product->slug) }}" class="product-card-media" tabindex="-1" aria-hidden="true">
                                    <img src="{{ asset('storage/testimonial-product/' . $productImages->first()) }}"
                                        alt="{{ $product->nama }}" loading="lazy">
                                </a>
                            @endif

                            <div class="product-card-body d-flex flex-column flex-grow-1">
                                <h3><a href="{{ route('produk.detail', $product->slug) }}">{{ $product->nama }}</a></h3>
                                <p>{{ \App\Support\Html::text($product->deskripsi, 120) }}</p>
                                <a href="{{ route('produk.detail', $product->slug) }}" class="product-card-link mt-auto">
                                    Lihat detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div><!-- End Pricing Item -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Produk Section -->
        @endif

        @if ($faq->isNotEmpty())
        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $setting['faq_title'] }}</h2>
                @if (filled($setting['faq_subtitle']))
                    <p>{{ $setting['faq_subtitle'] }}</p>
                @endif
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                            @foreach ($faq as $item)
                            <div class="faq-item {{ $loop->first ? 'faq-active' : '' }} ">
                                <h3>{{ $item["pertanyaan"] }}</h3>
                                <div class="faq-content">
                                    <p>
                                        {{ $item["jawaban"] }}
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>
                            @endforeach

                        </div>

                    </div><!-- End Faq Column-->

                </div>

            </div>

        </section><!-- /Faq Section -->
        @endif

        @if ($testimonials->isNotEmpty())
        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $setting['testimonials_title'] }}</h2>
                @if (filled($setting['testimonials_subtitle']))
                    <p>{{ $setting['testimonials_subtitle'] }}</p>
                @endif
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
              "loop": {{ $testimonials->count() > 3 ? 'true' : 'false' }},
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
                    </script>
                    <div class="swiper-wrapper">

                        @foreach ($testimonials as $testimonial)
                        @php
                            $testimonialImage = $testimonial->gambar ? asset('storage/testimonial-costumer/' . $testimonial->gambar) : null;
                            $testimonialName = $testimonial->nama ?: 'Pelanggan ' . $setting['site_name'];
                        @endphp
                        <div class="swiper-slide">
                            @if (filled($testimonial->deskripsi))
                                <div class="testimonial-item">
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        {{ $testimonial->deskripsi }}
                                    </p>
                                    <div class="mt-auto profile">
                                        @if ($testimonialImage)
                                            <img src="{{ $testimonialImage }}" class="testimonial-img"
                                                alt="Foto {{ $testimonialName }}" loading="lazy">
                                        @else
                                            <span class="testimonial-img testimonial-initial" aria-hidden="true">
                                                {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($testimonialName, 0, 1)) }}
                                            </span>
                                        @endif
                                        <h3>{{ $testimonialName }}</h3>
                                        @if (filled($testimonial->keterangan))
                                            <h4>{{ $testimonial->keterangan }}</h4>
                                        @endif
                                    </div>
                                </div>
                            @else
                                {{-- Testimoni berupa screenshot / gambar saja --}}
                                <div class="testimonial-item testimonial-screenshot">
                                    <a href="{{ $testimonialImage }}" class="glightbox" data-gallery="testimoni">
                                        <img src="{{ $testimonialImage }}" alt="Testimoni {{ $testimonialName }}" loading="lazy">
                                    </a>
                                    @if ($testimonial->nama || $testimonial->keterangan)
                                        <div class="mt-3 profile">
                                            <h3>{{ $testimonialName }}</h3>
                                            @if (filled($testimonial->keterangan))
                                                <h4>{{ $testimonial->keterangan }}</h4>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div><!-- End testimonial item -->
                        @endforeach

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->
        @endif

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $setting['contact_title'] }}</h2>
                @if (filled($setting['contact_subtitle']))
                    <p>{{ $setting['contact_subtitle'] }}</p>
                @endif
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                @if ($contact)
                @php
                    $socials = collect([
                        ['url' => $contact->link_fb, 'icon' => 'bi-facebook', 'label' => 'Facebook'],
                        ['url' => $contact->link_ig, 'icon' => 'bi-instagram', 'label' => 'Instagram'],
                        ['url' => $contact->link_twitter, 'icon' => 'bi-twitter-x', 'label' => 'X (Twitter)'],
                        ['url' => $contact->link_tiktok, 'icon' => 'bi-tiktok', 'label' => 'TikTok'],
                    ])->filter(fn ($social) => filled($social['url']) && str_starts_with($social['url'], 'http'));
                @endphp
                <div class="row gy-4 justify-content-center">
                    @if (filled($contact->address))
                    <div class="col-lg-3 col-md-6">
                        <div class="info-item">
                            <span class="info-icon"><i class="bi bi-geo-alt"></i></span>
                            <h3>Alamat</h3>
                            <p>{{ $contact->address }}</p>
                        </div>
                    </div>
                    @endif

                    @if (filled($contact->phone))
                    <div class="col-lg-3 col-md-6">
                        <div class="info-item">
                            <span class="info-icon"><i class="bi bi-telephone"></i></span>
                            <h3>Narahubung</h3>
                            <p><a href="tel:{{ preg_replace('/[^0-9+]/', '', $contact->phone) }}">{{ $contact->phone }}</a></p>
                        </div>
                    </div>
                    @endif

                    @if (filled($contact->email))
                    <div class="col-lg-3 col-md-6">
                        <div class="info-item">
                            <span class="info-icon"><i class="bi bi-envelope"></i></span>
                            <h3>Email</h3>
                            <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                        </div>
                    </div>
                    @endif

                    @if ($socials->isNotEmpty())
                    <div class="col-lg-3 col-md-6">
                        <div class="info-item">
                            <span class="info-icon"><i class="bi bi-share"></i></span>
                            <h3>Media Sosial</h3>
                            <div class="social-links justify-content-center mt-2">
                                @foreach ($socials as $social)
                                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }} {{ $setting['site_name'] }}">
                                        <i class="bi {{ $social['icon'] }}"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <div class="mt-1 row gy-4">

                    <div class="col-lg-12">
                        <form id="contact-form" action="{{ route('contact-message-store') }}" method="POST"
                            class="php-email-form" data-aos="fade-up" data-aos-delay="400">
                            @csrf
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Nama"
                                        aria-label="Nama" required>
                                </div>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        aria-label="Email" required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subjek"
                                        aria-label="Subjek" required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Pesan"
                                        aria-label="Pesan" required></textarea>
                                </div>

                                <div class="text-center col-md-12">
                                    <button type="submit">Kirim Pesan</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    @include('pages.landing-page.layouts.components.footer.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center" aria-label="Kembali ke atas"><i
            class="bi bi-arrow-up-short"></i></a>


    <div id="preloader"></div>

    @include('pages.landing-page.layouts.js.style')

    <script>
        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success'))
            });
        @elseif (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: @json(session('error'))
            });
        @endif

        document.getElementById("contact-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah submit form langsung

            // Ambil data dari input form
            let name = document.querySelector("input[name='name']").value;
            let email = document.querySelector("input[name='email']").value;
            let subject = document.querySelector("input[name='subject']").value;
            let message = document.querySelector("textarea[name='message']").value;

            // Nomor WhatsApp tujuan diatur dari menu Pengaturan & SEO di dashboard
            let phone = @json(\App\Support\WhatsApp::number());

            // Format pesan WhatsApp
            let text = [
                `Halo Admin ${@json($setting['site_name'])}, ada pesan baru dari website:`,
                `Nama: ${name}`,
                `Email: ${email}`,
                `Subjek: ${subject}`,
                `Pesan: ${message}`
            ].join("\n");

            // Redirect ke WhatsApp
            if (phone) {
                window.open(`https://wa.me/${phone}?text=${encodeURIComponent(text)}`, "_blank");
            }

            // Submit form ke Laravel setelah 3 detik (agar user sempat kirim WhatsApp)
            setTimeout(() => {
                event.target.submit();
            }, 3000);
        });
    </script>

</body>

</html>
