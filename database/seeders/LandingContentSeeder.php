<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutListSuperiority;
use App\Models\ImageAbout;
use App\Models\ImageTestimonialProduct;
use App\Models\ListSuperiority;
use App\Models\MetaDataDetailConsultant;
use App\Models\MetaDataFavoriteItem;
use App\Models\MetaDataPriceItem;
use App\Models\PackageItem;
use App\Models\PackageServiceConsultation;
use App\Models\TestimonialCustomer;
use App\Models\TestimonialProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Memindahkan konten landing page yang sebelumnya ditulis langsung di HTML ke database,
 * supaya bisa dikelola dari dashboard. Aman dijalankan ulang: data yang sudah ada tidak diduplikasi.
 *
 * php artisan db:seed --class=LandingContentSeeder
 */
class LandingContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedAbout();
        $this->seedPackages();
        $this->seedProducts();
        $this->seedTestimonials();
    }

    protected function seedAbout(): void
    {
        if (About::exists()) {
            return;
        }

        $about = About::create([
            'keunggulan' => 'Kenapa Harus Kami?',
            'title_keunggulan' => 'Kami lebih mengedepankan kualitas dibandingkan kuantitas',
            'description' => '<p>di-kerja.in merupakan sebuah penyedia Jasa Pembuatan Aplikasi atau Website yang memiliki harga terjangkau, pengerjaan cepat dan berkualitas.</p>',
        ]);

        $superiorities = [
            'Dikerjakan oleh orang berprofresional dalam bidang nya.',
            'Jaminan refund biaya apabila tidak sesuai dengan kesepakatan.',
            'Terbuka untuk konsultasi terlebih dahulu.',
        ];

        foreach ($superiorities as $name) {
            AboutListSuperiority::create([
                'about_id' => $about->id,
                'list_superiority_id' => ListSuperiority::firstOrCreate(['name' => $name])->id,
            ]);
        }

        foreach (['about-company-1.jpg', 'about-company-2.jpg', 'about-company-3.jpg'] as $image) {
            if ($this->copyImage(public_path('landing-page/assets/img/' . $image), 'about', $image)) {
                ImageAbout::create(['about_id' => $about->id, 'gambar' => $image]);
            }
        }
    }

    protected function seedPackages(): void
    {
        $packages = [
            [
                'name' => 'Konsultasi Alur / Program',
                'description' => '<p>Konsultasi ini bersifat <strong>GRATIS</strong>, tentunya <strong>Syarat dan Ketentuan Berlaku</strong></p>',
                'price' => 0,
                'favorite' => null,
                'features' => ['Konsultasi Program', 'Konsultasi Alur', 'Konsultasi Flow Database', 'Konsultasi Error', 'Fast Respon'],
            ],
            [
                'name' => 'Company Profile',
                'description' => '<p>Pembuatan sejenis Company Profile / CRUD</p>',
                'price' => 199000,
                'favorite' => 'Paling Diminati',
                'features' => ['Free Konsultasi Flow Database', 'Free Konsultasi Alur Proses', 'Free Template', 'Free Pemasangan Program', 'Gratis Revisi Max: 3x (Tergantung Kompleksitas)', 'Fast Respon'],
            ],
            [
                'name' => 'Skripsi / Tugas Akhir / Magang',
                'description' => '<p>Menerima Jasa Pembuatan Website / Aplikasi baik dari awal ataupun melanjutkan</p>',
                'price' => 399000,
                'favorite' => null,
                'features' => ['Free Konsultasi Flow Database', 'Free Konsultasi Alur Proses', 'Free Template', 'Free Pemasangan Program', 'Free Penambahan Fitur (Syarat dan Ketentuan Berlaku)', 'Free Video Demo Program', 'Gratis Revisi Max: 5x (Tergantung Kompleksitas)', 'Fast Respon'],
            ],
            [
                'name' => 'Paket Mentoring',
                'description' => '<p>Dilakukan secara online (melalui Video), untuk tema bisa disesuaikan kebutuhan</p>',
                'price' => 299000,
                'favorite' => null,
                'features' => ['Konsultasi Program', 'Konsultasi Alur', 'Konsultasi Flow Database', 'Video Dilakukan Bertahap', 'Bisa dilakukan secara bersamaan / private', 'Fast Respon'],
            ],
            [
                'name' => 'Penulisan Laporan',
                'description' => '<p>Menerima jasa penulisan laporan, seperti : <strong>Tugas Akhir, Skripsi, Tugas Kuliah ataupun Proposal</strong></p>',
                'price' => 99000,
                'favorite' => 'Populer',
                'features' => ['Free Konsultasi Alur Proses', 'Free Konsultasi Jurnal / Artikel', 'Penulisan Sesuai Panduan Yang Dibutuhkan', 'Minim Plagiarisme', 'Fast Respon'],
            ],
            [
                'name' => 'Pengembangan Website',
                'description' => '<p>Kami menerima juga untuk melakukan <strong>Pengembangan Website</strong> yang sudah berjalan.</p>',
                'price' => 149000,
                'favorite' => null,
                'features' => ['Free Konsultasi Flow Database', 'Free Konsultasi Alur Proses', 'Free Penambahan Fitur (Syarat dan Ketentuan Berlaku)', 'Free Video Demo Program', 'Gratis Revisi Max: 5x (Tergantung Kompleksitas)', 'Fast Respon'],
            ],
        ];

        foreach ($packages as $data) {
            if (PackageItem::where('name', $data['name'])->exists()) {
                continue;
            }

            $package = PackageItem::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'meta_price_package_service_id' => MetaDataPriceItem::firstOrCreate(['price' => $data['price']])->id,
                'meta_favorite_item_id' => $data['favorite'] ? MetaDataFavoriteItem::firstOrCreate(['name' => $data['favorite']])->id : null,
            ]);

            foreach ($data['features'] as $feature) {
                PackageServiceConsultation::create([
                    'package_service_id' => $package->id,
                    'consultation_detail_id' => MetaDataDetailConsultant::firstOrCreate(['name' => $feature])->id,
                ]);
            }
        }
    }

    protected function seedProducts(): void
    {
        // Urutan dibalik karena landing page menampilkan produk terbaru lebih dulu
        $products = array_reverse([
            [
                'nama' => 'Website Program Iklim Kota Cirebon (Proklim)',
                'gambar' => 'Website-Proklim.jpg',
                'deskripsi' => '<p>Sebuah website yang diperuntukkan untuk <strong>Dinas Lingkungan Hidup (DLH) Kota Cirebon</strong>. Website ini mempunyai fitur yang cukup sederhana, seperti :</p><ol><li>Monitoring Data Curah Hujan Perbulan / Pertahun</li><li>Monitoring Data Tanah Perdesa</li><li>Monitoring Data Iklim pada Kota Cirebon</li><li>Dan Lain - Lain</li></ol>',
            ],
            [
                'nama' => 'Website Desa Merdeka',
                'gambar' => 'Website_Desa_Merdeka.jpg',
                'deskripsi' => '<p>Sebuah website yang memiliki kerjasama dengan <strong>Desa Merdeka</strong>. Website ini berfokus pada perkembangan di lingkup : <strong>UMKM, Industri, Komunitas, dll</strong>.</p><p>Selain itu Website ini mempunyai beberapa fitur, seperti :</p><ol><li>Informasi Artikel Seputar UMKM, Berita Terkini, Industri</li><li>Mengelola Data Desa, Komunitas, Industri, UMKM</li><li>Informasi Perkembangan Desa</li><li>Informasi Mengenai Perdagangan dan Pemasaran</li><li>Dan Lain - Lain</li></ol>',
            ],
            [
                'nama' => 'Website Inventaris Barang',
                'gambar' => 'Website_Inventaris_Barang.jpg',
                'deskripsi' => '<p>Website sederhana yang digunakan untuk disebuah Sekolah / Kampus untuk mengelola <strong>Data Barang / Inventaris yang didapat dari Pihak Luar</strong>.</p><p>Website ini sendiri mempunyai beberapa fitur, seperti :</p><ol><li>Mengelola Data Barang sesuai Kategori (Hilang, Rusak, dan Baik)</li><li>Mengelola Data Inventaris Barang untuk Perkelas</li><li>Mengelola Data Peminjaman / Pengembalian Barang</li><li>Mengelola Berita Acara Kehilangan / Kerusakan Barang</li><li>Dan Lain - Lain</li></ol>',
            ],
            [
                'nama' => 'Website RTQ Ulil Albab Indramayu',
                'gambar' => 'Website_RTQ.jpg',
                'deskripsi' => '<p>Sebuah website yang diperuntukkan untuk <strong>Rumah Tahfidz Quran (RTQ) Ulil Albab Indramayu</strong>. Website ini mempunyai fitur seperti :</p><ol><li>Mengelola Data Santri</li><li>Mengelola KAS Pembayaran</li><li>Absensi Asatidz (Guru)</li><li>Absensi Santri (Siswa)</li><li>Pencatatan Hafalan Doa / Surat Santri</li><li>Cetak Rapot Nilai Santri</li><li>Monitoring Nilai / Absensi oleh Wali</li><li>Dan Lain - Lain</li></ol>',
            ],
            [
                'nama' => 'Aplikasi Smart Health Mobile',
                'gambar' => 'Aplikasi_Berobat_Plus.png',
                'deskripsi' => '<p>Smart Health Mobile merupakan <strong>Aplikasi Pelayanan Kesehatan dan Konsultasi Masyarakat berbasis Mobile</strong> yang dimana bisa bekerja sama dengan Pihak Medis, seperti : Dokter, Apoteker, dan Perawat. Aplikasi ini juga tidak menutup kemungkinan untuk terhubung dengan Profesi Lainnya ataupun pihak Rumah Sakit.</p><p>Aplikasi ini sendiri mempunyai fitur seperti :</p><ol><li>Konsultasi Dokter / Perawat</li><li>Jadwal Temu Janji Dokter / Perawat</li><li>Rawat Jalan</li><li>Artikel Seputar Kesehatan</li><li>Transaksi Pembelian Obat</li><li>Dan Lain - Lain</li></ol>',
            ],
            [
                'nama' => 'Website Study Tracer',
                'gambar' => 'Website_Study_Tracer.jpg',
                'deskripsi' => '<p>Website yang berfokus pada bidang Akademik, <strong>Khususnya Informasi Seputar Tentang Alumni, seperti : Info mengenai Lowongan Pekerjaan dan Info mengenai Dunia Kerja / Perusahaan</strong></p><p>Website ini memiliki beberapa fitur yang cukup unik, diantaranya :</p><ol><li>Mengelola Data Alumni</li><li>Mengelola Data Kuisioner Seputar Dunia Kerja / Perusahaan</li><li>Rekomendasi Lowongan Kerja Alumni</li><li>Riwayat Pekerjaan / Perguruan Tinggi Selanjutnya</li><li>Dan Lain - Lain</li></ol>',
            ],
        ]);

        foreach ($products as $data) {
            if (TestimonialProduct::where('nama', $data['nama'])->exists()) {
                continue;
            }

            $product = TestimonialProduct::create([
                'nama' => $data['nama'],
                'deskripsi' => $data['deskripsi'],
                'status' => '1',
            ]);

            if ($this->copyImage(public_path('katalog/' . $data['gambar']), 'testimonial-product', $data['gambar'])) {
                ImageTestimonialProduct::create([
                    'testimonial_product_id' => $product->id,
                    'gambar' => $data['gambar'],
                ]);
            }
        }
    }

    protected function seedTestimonials(): void
    {
        // Urutan dibalik karena landing page menampilkan testimoni terbaru lebih dulu
        $testimonials = array_reverse([
            [
                'nama' => 'Me**y A** Fa****',
                'deskripsi' => 'Waktu itu aku nemu kontak nya di twitter, aku searching "joki murah", eh muncul kontak kaka nya. Yaudah aku kontak kaka nya buat ngerjain tugas magang aku. Enak banget kaka nya, bisa di ajak diskusi, bisa request revisi lagi wkwkwk, karena recommended di kantong. Akhirnya aku nyaranin temen" aku kalo mau order, kesini aja!.',
            ],
            [
                'nama' => 'Ri**',
                'deskripsi' => 'Pengerjaan nya sangat cepat, bisa request lagi mau terkait alur yang dibutuhin sama dosen nya. Huhu sempet pasrah sama keadaan waktu itu, untung temen aku nyaranin kesini, alhasil aku bisa lulus tepat waktu :).',
            ],
            [
                'nama' => 'Az****a',
                'deskripsi' => 'Waktu itu aku lagi butuh banget buat bantuin skripsi, aku nemu kontak ini di twitter dlu waktu itu, truss aku coba hubungin. Setelah deal harga, eh ternyata aku diluar expect ternyata secepat itu pengerjaan nya.',
            ],
            [
                'nama' => 'Firli Ardiansyah',
                'deskripsi' => 'Saya kenal semenjak sekolah SMK, bahkan hingga saya kuliah pun saya masih sering konsultasi, baik itu dari pembuatan aplikasi, terkait issue error program, atau alur flow dari perancangan Database / UML. Ngga salah sih asli kalau misal mau order ke sini.',
            ],
            [
                'nama' => 'I***l',
                'deskripsi' => 'Saya di rekomendasiin sama saudara saya untuk kesini. Waktu itu sangat buntu sekali karena waktu udah mepet tapi belum buat apa", alhasil ketemu lah sama kaka nya. Alhamdulillah skripsi saya bisa selesai dalam waktu 2 bulan kurang. Keren banget mas e, top lah.',
            ],
        ]);

        foreach ($testimonials as $data) {
            if (TestimonialCustomer::where('nama', $data['nama'])->exists()) {
                continue;
            }

            TestimonialCustomer::create([
                'nama' => $data['nama'],
                'keterangan' => 'Mahasiswa',
                'deskripsi' => $data['deskripsi'],
                'status' => '1',
            ]);
        }
    }

    /**
     * Menyalin gambar bawaan ke folder upload dashboard agar bisa diganti/dihapus dari dashboard.
     */
    protected function copyImage(string $source, string $folder, string $filename): bool
    {
        if (! File::exists($source)) {
            return false;
        }

        $dir = public_path('storage/' . $folder);
        File::ensureDirectoryExists($dir, 0755);

        if (! File::exists($dir . '/' . $filename)) {
            File::copy($source, $dir . '/' . $filename);
        }

        return true;
    }
}
