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

            <!-- 1. Pendahuluan -->
            <section class="legal-section" id="intro">
                <h2>1. Pendahuluan</h2>
                <p>
                <strong>di-kerja.in</strong> adalah platform digital yang menyediakan berbagai layanan jasa seperti desain, penulisan, administrasi, 
                pengembangan web, dan jasa profesional lainnya. Kami berkomitmen membantu pengguna menyelesaikan pekerjaan dengan cepat, efisien, dan sesuai kebutuhan.
                </p>
                <p>
                Dengan menggunakan layanan kami, Anda menyetujui untuk mematuhi seluruh ketentuan dalam dokumen ini serta kebijakan lain yang berlaku, 
                termasuk <a href="/privacy-policy" class="text-primary">Kebijakan Privasi</a>.
                </p>
            </section>

            <!-- 2. Layanan yang Disediakan -->
            <section class="legal-section" id="services">
                <h2>2. Layanan yang Disediakan</h2>
                <p>
                Kami menyediakan layanan konsultatif dan profesional yang mencakup berbagai bidang kerja kreatif dan administratif. 
                Semua layanan disediakan oleh tim <strong>di-kerja.in</strong> atau mitra yang telah bekerja sama secara resmi.
                </p>
                <ul>
                <li>Layanan bersifat bantuan profesional dan berbasis hasil (project-based).</li>
                <li>Pengguna bertanggung jawab atas tujuan dan pemanfaatan hasil pekerjaan yang diterima.</li>
                </ul>
            </section>

            <!-- 3. Kewajiban Pengguna -->
            <section class="legal-section" id="user-obligations">
                <h2>3. Kewajiban Pengguna</h2>
                <p>Dengan menggunakan layanan kami, pengguna wajib untuk:</p>
                <ul>
                <li>Memberikan informasi, instruksi, dan data yang akurat, lengkap, dan jelas.</li>
                <li>Menjaga komunikasi yang sopan, profesional, dan menghormati tim <strong>di-kerja.in</strong>.</li>
                </ul>
            </section>

            <!-- 4. Pembayaran dan Pengembalian Dana -->
            <section class="legal-section" id="payment">
                <h2>4. Pembayaran dan Pengembalian Dana</h2>
                <p>
                Semua transaksi dilakukan melalui metode pembayaran resmi yang tersedia di platform kami. 
                Untuk memulai pengerjaan tugas, pengguna wajib melakukan <strong>pembayaran uang muka (DP) sebesar 50%</strong> dari total biaya yang telah disepakati.
                </p>
                <ul>
                <li>Sisa pembayaran 50% dibayarkan setelah hasil pekerjaan selesai dan disetujui oleh pengguna.</li>
                <li>Apabila pengguna membatalkan pesanan <strong>sebelum pengerjaan dimulai</strong>, maka akan dilakukan <strong>pengembalian dana sebesar 50% dari total DP</strong>.</li>
                <li>Apabila pembatalan dilakukan <strong>setelah pengerjaan dimulai</strong>, maka DP dianggap <strong>hangus</strong> sebagai kompensasi atas waktu dan sumber daya yang telah digunakan.</li>
                <li>Jika terjadi kesalahan dari pihak kami (misalnya pengerjaan tugas tidak diselesaikan atau hasil tidak sesuai perjanjian), pengguna berhak atas <strong>pengembalian penuh dari DP</strong>.</li>
                <li>Harga layanan dapat berubah sewaktu-waktu, namun tidak akan memengaruhi pengerjaan tugas yang sudah berjalan.</li>
                </ul>
            </section>

            <section class="legal-section" id="privacy">
                <h2>5. Perlindungan Data dan Privasi</h2>
                <p>
                    <strong>di-kerja.in</strong> menghormati privasi setiap pengguna. Semua data atau informasi yang kamu berikan — 
                    seperti nama, kontak, dan detail tugas — hanya digunakan untuk keperluan komunikasi dan pengerjaan pesanan.
                </p>

                <p>
                    Kami tidak akan membagikan data kamu ke pihak lain tanpa izin.
                </p>

                <p>
                    Data kamu disimpan dengan aman dan hanya diakses oleh tim <strong>di-kerja.in</strong> yang terlibat langsung dalam pengerjaan tugas.
                </p>

                <p>
                    Dengan menggunakan layanan ini, kamu menyetujui bahwa kami bisa menghubungimu lewat WhatsApp, email, atau platform lain 
                    untuk kebutuhan pengerjaan dan konfirmasi pesanan.
                </p>

                <p>
                    Detail lengkap tentang cara kami menjaga data bisa dibaca di 
                    <a href="/privacy-policy" class="text-primary">Kebijakan Privasi</a>.
                </p>
            </section>

            <section class="legal-section" id="liability">
                <h2>6. Tanggung Jawab</h2>
                <p>
                Kami akan kerjakan setiap tugas sebaik mungkin, tapi kami nggak bisa tanggung jawab atas:
                </p>
                <ul>
                <li>Penyalahgunaan hasil kerja setelah diserahkan.</li>
                <li>Keterlambatan yang disebabkan hal di luar kendali kami ( revisi mendadak ).</li>
                </ul>
            </section>


            <!-- 5. Etika dan Perilaku Pengguna -->

            <!-- 11. Kontak Kami -->
            <section class="legal-section" id="contact">
                <h2>7. Kontak Kami</h2>
                <p>
                Jika Anda memiliki pertanyaan, masukan, atau keluhan terkait ketentuan ini, silakan hubungi kami melalui:
                </p>
                <p>
                Email: <a href="mailto:mimin.dikerjain@gmail.com">mimin.dikerjain@gmail.com</a><br>
                WhatsApp: <a href="https://wa.me/628121470" target="_blank">0812-1470</a><br>
                Alamat: Jl. Darma Putra Raya No.6, Kebayoran Lama, Jakarta Selatan
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
