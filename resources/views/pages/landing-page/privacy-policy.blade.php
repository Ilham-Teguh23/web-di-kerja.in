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
        <section class="legal-content container">
            <div class="row">
                <div class="col-lg-9 mx-auto">

                <header class="legal-page-title">
                    <h1>Kebijakan Privasi</h1>
                    <p>Bagaimana {{ $setting['site_name'] }} menggunakan, menyimpan, dan menghapus data kamu.</p>
                </header>

                <section class="legal-section" id="use">
                    <h2>1. Penggunaan Data</h2>
                    <p>
                    Data seperti nama, kontak, dan detail pesanan hanya digunakan untuk komunikasi dan pengerjaan tugas.
                    Kami tidak menyimpan data untuk tujuan lain, dan tidak membagikannya ke siapa pun tanpa izinmu.
                    </p>
                </section>

                <section class="legal-section" id="store">
                    <h2>2. Penyimpanan Data</h2>
                    <p>
                    Selama pekerjaan berjalan, data kamu disimpan dengan aman dan hanya diakses oleh team (di-kerja.in) yang terlibat langsung dalam pengerjaan.
                    Setelah pekerjaan selesai, data tersebut bisa dihapus kapan saja kalau kamu mau.
                    </p>
                </section>

                <section class="legal-section" id="delete">
                    <h2>3. Penghapusan Data</h2>
                    <p>
                    Kamu bebas minta agar data kamu dihapus dari catatan saya.  
                    Cukup kirim pesan lewat:
                    </p>
                    @include('pages.landing-page.layouts.components.contact-info')
                    <p>
                    Biasanya saya hapus dalam waktu maksimal 7 hari, kecuali data pembayaran yang memang harus disimpan sebagai bukti transaksi.
                    </p>
                </section>

                <section class="legal-section" id="update">
                    <h2>4. Perubahan</h2>
                    <p>
                    Kebijakan ini bisa diperbarui sewaktu-waktu supaya tetap sesuai dengan cara kerja saya.  
                    Versi terbaru selalu bisa kamu lihat di halaman ini.
                    </p>
                </section>

                <section class="legal-section" id="contact">
                    <h2>5. Kontak</h2>
                    <p>
                    Kalau ada pertanyaan soal privasi, kamu bisa langsung hubungi saya di:
                    </p>
                    @include('pages.landing-page.layouts.components.contact-info')
                </section>

                </div>
            </div>
        </section>


    </main>

    @include('pages.landing-page.layouts.components.footer.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <div id="preloader"></div>

    @include('pages.landing-page.layouts.js.style')

</body>

</html>
