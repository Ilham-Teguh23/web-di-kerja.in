<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {!! config('seo.meta') !!}

    <title>
        .: di-kerja.in :.
    </title>

    @include('pages.landing-page.layouts.favico.favico')

    @include('pages.landing-page.layouts.fonts.font')

    @include('pages.landing-page.layouts.css.style')

</head>

<body class="index-page">

    @include('pages.landing-page.layouts.components.header.header')

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="{{ url('/landing-page') }}/assets/img/hero-bg-light.webp" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">Selamat Datang <span>di-kerja.in</span></h1>
                    <p data-aos="fade-up" data-aos-delay="100">
                        Jasa Pembuatan Website dan Aplikasi Termurah dan Terpercaya.
                    </p>
                    <img src="{{ url('/landing-page') }}/assets/img/hero-services-img.webp" class="img-fluid hero-img"
                        alt="" data-aos="zoom-out" data-aos-delay="300">
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <p class="who-we-are">Kenapa Harus Kami?</p>
                        <h3>
                            Kami lebih mengedepankan kualitas dibandingkan kuantitas
                        </h3>
                        <p class="fst-italic">
                            di-kerja.in merupakan sebuah penyedia Jasa Pembuatan Aplikasi atau Website yang memiliki
                            harga terjangkau, pengerjaan cepat dan berkualitas.
                        </p>
                        <ul>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                <span>
                                    Dikerjakan oleh orang berprofresional dalam bidang nya.
                                </span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                <span>
                                    Jaminan refund biaya apabila tidak sesuai dengan kesepakatan.
                                </span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                <span>
                                    Terbuka untuk konsultasi terlebih dahulu.
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <img src="{{ url('/landing-page') }}/assets/img/about-company-1.jpg" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="row gy-4">
                                    <div class="col-lg-12">
                                        <img src="{{ url('/landing-page') }}/assets/img/about-company-2.jpg"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="col-lg-12">
                                        <img src="{{ url('/landing-page') }}/assets/img/about-company-3.jpg"
                                            class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Keunggulan Kami</h2>
                <p>
                    Kami juga mempunyai beberapa keunggulan yang cukup bisa bersaing dengan yang lain.
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    @forelse ($benefit as $item)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            <i class="bi bi-activity icon"></i>
                            <div>
                                <h3>{{ $item["judul"] }}</h3>
                                <p>
                                    {{ $item["deskripsi"] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            <strong>Perhatian!</strong>.
                            <span>
                                Data Benefit Tidak Tersedia.
                            </span>
                        </div>
                    </div>
                    @endforelse

                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Harga</h2>
                <p>
                    Kami menawarkan beberapa harga yang cukup ramah di kantong khusus nya Mahasiswa dan Pelajar.
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item">
                            <h3>Konsultasi Alur / Program</h3>
                            <p class="description">
                                Konsultasi ini bersifat <strong>GRATIS</strong>, tentunya <strong>Syarat dan Ketentuan
                                    Berlaku</strong>
                            </p>
                            <h4>
                                <sup>Rp.</sup>0
                            </h4>
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone=081214707143&text=Hallo Admin, Saya ingin bertanya mengenai Konsultasi Alur / Program"
                                class="cta-btn">Hubungi Admin</a>
                            <ul>
                                <li><i class="bi bi-check"></i> <span>Konsultasi Program</span></li>
                                <li><i class="bi bi-check"></i> <span>Konsultasi Alur</span></li>
                                <li><i class="bi bi-check"></i> <span>Konsultasi Flow Database</span></li>
                                <li><i class="bi bi-check"></i> <span>Konsultasi Error</span></li>
                                <li>
                                    <i class="bi bi-check"></i>
                                    <span>Fast Respon</span>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="pricing-item featured">
                            <p class="popular">Paling Diminati</p>
                            <h3>Company Profile</h3>
                            <p class="description">
                                Pembuatan sejenis Company Profile / CRUD
                            </p>
                            <h4>
                                <sup>Rp.</sup>199.000<span> / Mulai dari</span>
                            </h4>
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone=081214707143&text=Hallo Admin, Saya ingin bertanya mengenai Pembuatan Company Profile / Pembuatan CRUD Sederhana"
                                class="cta-btn">Hubungi Admin</a>
                            <ul>
                                <li><i class="bi bi-check"></i> <span>Free Konsultasi Flow Database</span></li>
                                <li><i class="bi bi-check"></i> <span>Free Konsultasi Alur Proses</span></li>
                                <li><i class="bi bi-check"></i> <span>Free Template</span></li>
                                <li><i class="bi bi-check"></i> <span>Free Pemasangan Program</span></li>
                                <li>
                                    <i class="bi bi-check"></i>
                                    <span>Gratis Revisi Max: 3x (Tergantung Kompleksitas)</span>
                                </li>
                                <li>
                                    <i class="bi bi-check"></i>
                                    <span>Fast Respon</span>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="pricing-item">
                            <h3>
                                Skripsi / Tugas Akhir / Magang
                            </h3>
                            <p class="description">Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex
                                strater</p>
                            <h4>
                                <sup>Rp.</sup>399.000
                                <span> / Mulai Dari</span>
                            </h4>
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone=081214707143&text=Hallo Admin, Saya ingin bertanya tentang Pembuatan Program / Laporan Untuk Skripsi / Tugas Akhir."
                                class="cta-btn">Hubungi Admin</a>
                            <ul>
                                <li><i class="bi bi-check"></i> <span>Free Konsultasi Flow Database</span></li>
                                <li><i class="bi bi-check"></i> <span>Free Konsultasi Alur Proses</span></li>
                                <li><i class="bi bi-check"></i> <span>Free Template</span></li>
                                <li><i class="bi bi-check"></i> <span>Free Pemasangan Program</span></li>
                                <li><i class="bi bi-check"></i> <span>Free Penambahan Fitur (Syarat dan Ketentuan
                                        Berlaku)</span></li>
                                <li><i class="bi bi-check"></i> <span>Free Video Demo Program</span></li>
                                <li>
                                    <i class="bi bi-check"></i>
                                    <span>Gratis Revisi Max: 5x (Tergantung Kompleksitas) </span>
                                </li>
                                <li>
                                    <i class="bi bi-check"></i>
                                    <span>Fast Respon</span>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End Pricing Item -->

                </div>

            </div>

        </section><!-- /Pricing Section -->

        <section id="produk" class="pricing section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Produk Yang Pernah Dikerjakan</h2>
                <p>
                    Beberapa Dokumentasi Produk Website / Aplikasi Yang Pernah Kami Buat dan Kembangkan
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item">
                            <h3>
                                Website Program Iklim Kota Cirebon
                                <strong>
                                    (Proklim)
                                </strong>
                            </h3>
                            <p class="description">
                                Sebuah website yang diperuntukkan untuk
                                <strong>
                                    Dinas Lingkungan Hidup (DLH) Kota Cirebon
                                </strong> Website ini ...
                            </p>
                            <img src="{{ url('/katalog/Website-Proklim.jpg') }}" alt=""
                                style="width: 100%; height: 300px">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModalProklim" class="cta-btn">
                                Detail Produk
                            </a>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item">
                            <h3>
                                Website Desa Merdeka
                            </h3>
                            <p class="description">
                                Sebuah website yang memiliki kerjasama dengan Desa Merdeka . Website ini berfokus pada perkembangan di lingkup  ...
                            </p>
                            <img src="{{ url('/katalog/Website_Desa_Merdeka.jpg') }}" alt=""
                                style="width: 100%; height: 300px">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModalDesaMerdeka" class="cta-btn">
                                Detail Produk
                            </a>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item">
                            <h3>
                                Website Inventaris Barang
                            </h3>
                            <p class="description">
                                Website sederhana yang digunakan untuk disebuah Sekolah / Kampus untuk ...
                            </p>
                            <img src="{{ url('/katalog/Website_Inventaris_Barang.jpg') }}" alt=""
                                style="width: 100%; height: 300px">
                            <a class="cta-btn" data-bs-toggle="modal" data-bs-target="#exampleModalInventarisBarang">
                                Detail Produk
                            </a>
                        </div>
                    </div><!-- End Pricing Item -->

                </div>

                <div class="mt-4 row gy-4">

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item">
                            <h3>
                                Website RTQ Ulil Albab Indramayu
                            </h3>
                            <p class="description">
                                Sebuah website yang diperuntukkan untuk
                                <strong>
                                    Rumah Tahfidz Quran (RTQ) Ulil Albab Indramayu
                                </strong>. Website ini ...
                            </p>
                            <img src="{{ url('/katalog/Website_RTQ.jpg') }}" alt="" style="width: 100%; height: 300px">
                            <a class="cta-btn" data-bs-toggle="modal" data-bs-target="#exampleModalRTQ">
                                Detail Produk
                            </a>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item">
                            <h3>
                                Aplikasi Smart Health Mobile
                            </h3>
                            <p class="description">
                                Smart Health Mobile merupakan
                                <strong>
                                    Aplikasi Pelayanan Kesehatan dan Konsultasi Masyarakat berbasis Mobile
                                </strong> yang dimana bisa bekerja sama dengan ...
                            </p>
                            <img src="{{ url('/katalog/Aplikasi_Berobat_Plus.png') }}" alt=""
                                style="width: 100%; height: 600px">
                            <a class="cta-btn" data-bs-toggle="modal" data-bs-target="#exampleModalSmartHealth">
                                Detail Produk
                            </a>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item">
                            <h3>
                                Website Study Tracer
                            </h3>
                            <p class="description">
                                Website yang berfokus pada bidang Akademik,
                                <strong>
                                    Khususnya Informasi Seputar Tentang Alumni, seperti : ...
                                </strong>.
                            </p>
                            <img src="{{ url('/katalog/Website_Study_Tracer.jpg') }}" alt=""
                                style="width: 100%; height: 300px">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModalStudyTracer"
                                class="cta-btn">
                                Detail Produk
                            </a>
                        </div>
                    </div><!-- End Pricing Item -->

                </div>

            </div>

        </section><!-- /Pricing Section -->

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Beberapa pertanyaan yang sering diajukan</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                            @forelse ($faq as $item)
                            <div class="faq-item {{ $loop->first ? 'faq-active' : '' }} ">
                                <h3>{{ $item["pertanyaan"] }}</h3>
                                <div class="faq-content">
                                    <p>
                                        {{ $item["jawaban"] }}
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>
                            @empty
                            <div class="alert alert-danger">
                                <strong>
                                    Perhatian!
                                </strong>. Data FAQ Belum Tersedia
                            </div>
                            @endforelse

                        </div>

                    </div><!-- End Faq Column-->

                </div>

            </div>

        </section><!-- /Faq Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Apa Kata Mereka?</h2>
                <p>
                    Kami juga sudah mendapatkan cukup banyak review dari pelanggan kami
                </p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
              "loop": true,
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

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Waktu itu aku nemu kontak nya di twitter, aku searching "joki murah", eh muncul
                                    kontak kaka nya. Yaudah aku kontak kaka nya buat ngerjain tugas magang aku. Enak
                                    banget kaka nya, bisa di ajak diskusi, bisa request revisi lagi wkwkwk, karena
                                    recommended di kantong. Akhirnya aku nyaranin temen" aku kalo mau order, kesini
                                    aja!.
                                </p>
                                <div class="mt-auto profile">
                                    <img src="{{ url('/landing-page') }}/assets/img/testimonials/testimonials-1.jpg"
                                        class="testimonial-img" alt="">
                                    <h3>Me**y A** Fa****</h3>
                                    <h4>Mahasiswa</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Pengerjaan nya sangat cepat, bisa request lagi mau terkait alur yang dibutuhin sama
                                    dosen nya. Huhu sempet pasrah sama keadaan waktu itu, untung temen aku nyaranin
                                    kesini, alhasil aku bisa lulus tepat waktu :).
                                </p>
                                <div class="mt-auto profile">
                                    <img src="{{ url('/landing-page') }}/assets/img/testimonials/testimonials-2.jpg"
                                        class="testimonial-img" alt="">
                                    <h3>Ri**</h3>
                                    <h4>Mahasiswa</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Waktu itu aku lagi butuh banget buat bantuin skripsi, aku nemu kontak ini di twitter
                                    dlu waktu itu, truss aku coba hubungin. Setelah deal harga, eh ternyata aku diluar
                                    expect ternyata secepat itu pengerjaan nya.
                                </p>
                                <div class="mt-auto profile">
                                    <img src="{{ url('/landing-page') }}/assets/img/testimonials/testimonials-3.jpg"
                                        class="testimonial-img" alt="">
                                    <h3>Az****a</h3>
                                    <h4>Mahasiswa</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Saya kenal semenjak sekolah SMK, bahkan hingga saya kuliah pun saya masih sering
                                    konsultasi, baik itu dari pembuatan aplikasi, terkait issue error program, atau alur
                                    flow dari perancangan Database / UML. Ngga salah sih asli kalau misal mau order ke
                                    sini.
                                </p>
                                <div class="mt-auto profile">
                                    <img src="{{ url('/landing-page') }}/assets/img/testimonials/testimonials-4.jpg"
                                        class="testimonial-img" alt="">
                                    <h3>Firli Ardiansyah</h3>
                                    <h4>Mahasiswa</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Saya di rekomendasiin sama saudara saya untuk kesini. Waktu itu sangat buntu sekali
                                    karena waktu udah mepet tapi belum buat apa", alhasil ketemu lah sama kaka nya.
                                    Alhamdulillah skripsi saya bisa selesai dalam waktu 2 bulan kurang. Keren banget mas
                                    e, top lah.
                                </p>
                                <div class="mt-auto profile">
                                    <img src="{{ url('/landing-page') }}/assets/img/testimonials/testimonials-5.jpg"
                                        class="testimonial-img" alt="">
                                    <h3>I***l</h3>
                                    <h4>Mahasiswa</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>
                    Kontak
                </h2>
                <p>
                    Silahkan hubungi kontak dibawah ini untuk info lebih lanjut.
                </p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Alamat</h3>
                            <p style="text-align: center">
                                Jl. Darma Putra Raya No.6, Kby. Lama Sel., Kec. Kby. Lama, Kota Jakarta Selatan.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Narahubung</h3>
                            <p>
                                0812-1470-7143
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p>
                                mimin.dikerjain@gmail.com
                            </p>
                        </div>
                    </div>

                </div>

                <div class="mt-1 row gy-4">

                    <div class="col-lg-12">
                        <form action="{{ route('contact-message-store') }}" method="POST" class="php-email-form"
                            data-aos="fade-up" data-aos-delay="400">
                            @csrf
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message"
                                        required></textarea>
                                </div>

                                <div class="text-center col-md-12">
                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <!-- Website Proklim -->
    <div class="modal fade" id="exampleModalProklim" tabindex="-1" aria-labelledby="exampleModalLabelProklim" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabelProklim">
                        Website Program Iklim Kota Cirebon
                        <strong>
                            ( Proklim )
                        </strong>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sebuah website yang diperuntukkan untuk
                    <strong>
                        Dinas Lingkungan Hidup (DLH) Kota Cirebon
                    </strong>. Website ini mempunyai fitur yang cukup sederhana, seperti :
                    <ol>
                        <li>Monitoring Data Curah Hujan Perbulan / Pertahun</li>
                        <li>Monitoring Data Tanah Perdesa</li>
                        <li>Monitoring Data Iklim pada Kota Cirebon</li>
                        <li>Dan Lain - Lain</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Desa Merdeka -->
    <div class="modal fade" id="exampleModalDesaMerdeka" tabindex="-1" aria-labelledby="exampleModalLabelDesaMerdeka" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabelDesaMerdeka">
                        Website Desa Merdeka
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sebuah website yang memiliki kerjasama dengan
                    <strong>
                        Desa Merdeka
                    </strong>. Website ini berfokus pada perkembangan di lingkup : <strong>UMKM, Industri, Komunitas, dll</strong>.
                    <br> Selain itu Website ini mempunyai beberapa fitur, seperti :
                    <ol>
                        <li>Informasi Artikel Seputar UMKM, Berita Terkini, Industri</li>
                        <li>Mengelola Data Desa, Komunitas, Industri, UMKM</li>
                        <li>Informasi Perkembangan Desa</li>
                        <li>Informasi Mengenai Perdagangan dan Pemasaran</li>
                        <li>Dan Lain - Lain</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Inventaris Barang -->
    <div class="modal fade" id="exampleModalInventarisBarang" tabindex="-1" aria-labelledby="exampleModalLabelInventarisBarang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabelInventarisBarang">
                        Website Inventaris Barang
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Website sederhana yang digunakan untuk disebuah Sekolah / Kampus untuk mengelola
                    <strong>
                        Data Barang / Inventaris yang didapat dari Pihak Luar
                    </strong>.
                    <br> Website ini sendiri mempunyai beberapa fitur, seperti :
                    <ol>
                        <li>Mengelola Data Barang sesuai Kategori (Hilang, Rusak, dan Baik)</li>
                        <li>Mengelola Data Inventaris Barang untuk Perkelas </li>
                        <li>Mengelola Data Peminjaman / Pengembalian Barang</li>
                        <li>Mengelola Berita Acara Kehilangan / Kerusakan Barang</li>
                        <li>Dan Lain - Lain</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- RTQ -->
    <div class="modal fade" id="exampleModalRTQ" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Website RTQ Ulil Albab Indramayu
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sebuah website yang diperuntukkan untuk
                    <strong>
                        Rumah Tahfidz Quran (RTQ) Ulil Albab Indramayu
                    </strong>. Website ini mempunyai fitur seperti :
                    <ol>
                        <li>Mengelola Data Santri</li>
                        <li>Mengelola KAS Pembayaran</li>
                        <li>Absensi Asatidz (Guru)</li>
                        <li>Absensi Santri (Siswa)</li>
                        <li>Pencatatan Hafalan Doa / Surat Santri</li>
                        <li>Cetak Rapot Nilai Santri</li>
                        <li>Monitoring Nilai / Absensi oleh Wali</li>
                        <li>Dan Lain - Lain</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Aplikasi Smarth Health -->
    <div class="modal fade" id="exampleModalSmartHealth" tabindex="-1" aria-labelledby="exampleModalLabelSmartHealth" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabelSmartHealth">
                        Aplikasi Smart Health Mobile
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Smart Health Mobile merupakan
                    <strong>
                        Aplikasi Pelayanan Kesehatan dan Konsultasi Masyarakat berbasis Mobile
                    </strong> yang dimana bisa bekerja sama dengan Pihak Medis, seperti : Dokter, Apoteker, dan Perawat. Aplikasi ini juga tidak menutup kemungkinan untuk terhubung dengan Profesi Lainnya ataupun pihak Rumah Sakit.
                    <br>
                    Aplikasi ini sendiri mempunyai fitur seperti :
                    <ol>
                        <li>Konsultasi Dokter / Perawat</li>
                        <li>Jadwal Temu Janji Dokter / Perawat</li>
                        <li>Rawat Jalan</li>
                        <li>Artikel Seputar Kesehatan</li>
                        <li>Transaksi Pembelian Obat</li>
                        <li>Dan Lain - Lain</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Study Tracer -->
    <div class="modal fade" id="exampleModalStudyTracer" tabindex="-1" aria-labelledby="exampleModalLabelStudyTracer" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabelStudyTracer">
                        Website Study Tracer
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Website yang berfokus pada bidang Akademik,
                    <strong>
                        Khususnya Informasi Seputar Tentang Alumni, seperti : Info mengenai Lowongan Pekerjaan dan Info mengenai Dunia Kerja  / Perusahaan
                    </strong>
                    <br>
                    Website ini memiliki beberapa fitur yang cukup unik , diantaranya :
                    <ol>
                        <li>Mengelola Data Alumni</li>
                        <li>Mengelola Data Kuisioner Seputar Dunia Kerja / Perusahaan</li>
                        <li>Rekomendasi Lowongan Kerja Alumni </li>
                        <li>Riwayat Pekerjaan / Perguruan Tinggi Selanjutnya</li>
                        <li>Dan Lain - Lain</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @include('pages.landing-page.layouts.components.footer.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <div id="preloader"></div>

    @include('pages.landing-page.layouts.js.style')

    {{-- <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                fetch('/api/get-location', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            latitude: lat,
                            longitude: lon
                        })
                    })
                    .then(response => response.json())
                    .then(data => {

                        // const locationDiv = document.getElementById('location-info');

                        // if (data && data.address) {
                        //     locationDiv.innerHTML = `<strong>Lokasi Anda:</strong><br>
                        //                  ${data.address}<br>
                        //                  Latitude: ${lat}, Longitude: ${lon}`;
                        // } else if (data.error) {
                        //     locationDiv.innerHTML = `<strong>Error:</strong><br>${data.error}`;
                        // } else {
                        //     locationDiv.innerHTML = `<strong>Lokasi Anda:</strong><br>
                        //                  Tidak dapat mendeteksi alamat dari koordinat yang diberikan.`;
                        // }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }, function(error) {
                console.warn('Geolocation error:', error);
                const locationDiv = document.getElementById('location-info');
                locationDiv.innerHTML = 'Lokasi tidak dapat dideteksi.';
            });
        } else {
            alert('Geolocation is not supported by this browser.');
        }

        let type = false;

            if('{{session()->has("success")}}' == true) type = "success";
            if('{{session()->has("error")}}' == true) type = "error";

            if(type === "success"){
                Swal.fire({
                    icon: 'success',
                    title: 'success!',
                    text: '{{ session('success') }}'
                });

            }else if(type === "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}'
                });
            }

            function toast(message) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'ERROR !',
                    text: message,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
    </script> --}}

</body>

</html>
