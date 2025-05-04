<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data yang ada untuk menghindari duplikasi saat seeder dijalankan lagi
        DB::table('about')->delete();

        // Data untuk di-seed
        $services = [
            [
                'Keunggulan' => 'Kenapa Harus Kami?',
                'title_keunggulan' => 'Kami lebih mengedepankan kualitas dibandingkan kuantitas',
                'description' => 'di-kerja.in merupakan sebuah penyedia Jasa Pembuatan Aplikasi atau Website yang memiliki harga terjangkau, pengerjaan cepat dan berkualitas.',
            ],
        ];

        // Masukkan data ke dalam database
        foreach ($services as $service) {
            DB::table('about')->insert([
                'Keunggulan' => $service['title_keunggulan'],
                'title_keunggulan' => $service['title_keunggulan'], // asumsi kolom ini ada jika perlu
                'description' => $service['description'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
