<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaConsultationServiceItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            "Konsultasi Program",
            "Konsultasi Alur",
            "Konsultasi Flow Database",
            "Konsultasi Error",
            "Fast Respon",
            "Free Konsultasi Flow Database",
            "Free Konsultasi Alur Proses",
            "Free Template",
            "Free Pemasangan Program",
            "Gratis Revisi Max: 3x (Tergantung Kompleksitas)",
            "Free Penambahan Fitur (Syarat dan Ketentuan Berlaku)",
            "Free Video Demo Program",
            "Gratis Revisi Max: 5x (Tergantung Kompleksitas)",
            "Video Dilakukan Bertahap",
            "Bisa dilakukan secara bersamaan / private",
            "Free Konsultasi Jurnal / Artikel",
            "Penulisan Sesuai Panduan Yang Dibutuhkan",
            "Minim Plagiarisme"
        ];

        foreach ($items as $item) {
            DB::table('meta_consultation_details')->insert([
                'name' => $item,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
