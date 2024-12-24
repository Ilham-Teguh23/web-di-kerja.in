<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {!! config('seo.meta') !!}

    <title>
        .: di.kerja.in :.
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
                    <h1 data-aos="fade-up">Selamat Datang <span>di.kerja.in</span></h1>
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
                            di.kerja.in merupakan sebuah penyedia Jasa Pembuatan Aplikasi atau Website yang memiliki
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

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            <i class="bi bi-activity icon"></i>
                            <div>
                                <h3>Fast Respon</h3>
                                <p>
                                    Kami mempunyai admin yang cukup Fast Respon dalam menjawab keluhan-keluhan / orderan
                                    dari anda.
                                </p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item item-orange position-relative">
                            <i class="bi bi-broadcast icon"></i>
                            <div>
                                <h3>Terjangkau</h3>
                                <p>
                                    Kami juga mempunyai harga yang cukup terjangkau khususnya untuk kalangan Mahasiswa /
                                    Pelajar.
                                </p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item item-teal position-relative">
                            <i class="bi bi-easel icon"></i>
                            <div>
                                <h3>Terpercaya</h3>
                                <p>
                                    Tidak sedikit customer kami yang sudah order menjadi lulusan terbaik di Kampus nya
                                    masing - masing.
                                </p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item item-red position-relative">
                            <i class="bi bi-bounding-box-circles icon"></i>
                            <div>
                                <h3>Berkualitas</h3>
                                <p>
                                    Dengan harga yang cukup murah, anda bisa mendapatkan kualitas website / aplikasi
                                    dengan nuansa Premium. Karena kami tentu saja mengedepankan kualitas dan kepercayaan
                                    Customer.
                                </p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

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
                            <a href="#" class="cta-btn">Hubungi Admin</a>
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
                            <a href="#" class="cta-btn">Hubungi Admin</a>
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
                            <a href="#" class="cta-btn">Hubungi Admin</a>
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

                            <div class="faq-item faq-active">
                                <h3>Kaaaa, apa bisa ngerjain laporan juga?</h3>
                                <div class="faq-content">
                                    <p>
                                        Tentu nya bisa dong, selain pembuatan aplikasi / web, kami juga bisa mengerjakan
                                        laporan juga yaa gaes, mau Skripsi / Tugas Akhir / Magang, kami kerjakan dengan
                                        cepat dan teliti.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Berapa tarif nya min, kalo mau order?</h3>
                                <div class="faq-content">
                                    <p>
                                        Terkait harga tidak usah khawatir mahal, kami juga ramah harga terutama untuk
                                        kalangan Mahasiswa / Anak Sekolahan. Tentu nya, harga bisa disesuaikan sesuai
                                        kompleks dari fitur yang diinginkan.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Min hanya buat web ajakah atau gimana?</h3>
                                <div class="faq-content">
                                    <p>
                                        Wahh tentu nya ngga dong, kami juga melayani pembuatan Aplikasi / Website, tentu
                                        nya kami juga melayani terkait jasa pembuatan Alur Flow yaaa kawan", baik itu
                                        UML, Flowchart, Use Case, Database, dll.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Kalau saya mau beresin error atau nambah fitur bisa min?</h3>
                                <div class="faq-content">
                                    <p>
                                        Sangat bisa dong ka!, kami selain membuat dari 0, kami juga siap membantu
                                        apabila ada error atau ada penambahan fitur.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Min, bahasa atau framework nya bisa request ngga ya?</h3>
                                <div class="faq-content">
                                    <p>
                                        Tentu bisa dong yaa gaes, kami juga mempunyai beberapa anggota tim yang sudah
                                        teruji, dengan kemampuan yang cukup dibilang mempunyai value. Alhasil jangan
                                        perlu khawatir terkait bahasa / framework yang akan digunakan.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Kalau udah jadi program nya, apakah ada diajarin buat instalasi hingga running nya
                                    min?</h3>
                                <div class="faq-content">
                                    <p>
                                        Jelas dong gaes, kami akan pandu dari awal hingga running project. Bahkan kami
                                        juga akan menjelaskan terkait fitur" atau alur nya seperti apa, jadi jangan ragu
                                        untuk order ke kami ya.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Kalau mau konsultasi terkait alur atau program bisa ngga ya ka?</h3>
                                <div class="faq-content">
                                    <p>
                                        Kami juga melayani terkait konsultasi alur atau program juga yaa gaes, untuk ini
                                        kami khususkan harga nya, <strong>"GRATIS"</strong>. Kapan lagi dan dimana lagi
                                        yang bisa dapet keuntungan ini, jadi jangan ragu ya untuk konsultasi ke kami!.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

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
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="400">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Your Email" required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="text-center col-md-12">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    @include('pages.landing-page.layouts.components.footer.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <div id="preloader"></div>

    @include('pages.landing-page.layouts.js.style')

</body>

</html>
