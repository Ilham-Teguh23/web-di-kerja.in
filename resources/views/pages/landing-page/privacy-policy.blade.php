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
        <section class="legal-content container">
            <div class="row">
                <div class="col-lg-9 mx-auto">

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
                    <p>
                    Email: <a href="mailto:mimin.dikerjain@gmail.com">mimin.dikerjain@gmail.com</a><br>
                    WhatsApp: <a href="https://wa.me/628121470" target="_blank">0812-1470</a>
                    </p>
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
                    <p>
                    Email: <a href="mailto:mimin.dikerjain@gmail.com">mimin.dikerjain@gmail.com</a><br>
                    WhatsApp: <a href="https://wa.me/628121470" target="_blank">0812-1470</a>
                    </p>
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
