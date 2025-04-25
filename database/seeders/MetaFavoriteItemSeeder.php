<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaFavoriteItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            "Paling Populer",
            "Paling Diminati",
            "Paling Dicari",
            "Paling Berguna",
            "Paling Efektif",
            "Paling Menguntungkan",
            "Diminati Banyak Orang",
            "Diminati Pengusaha",
            "Diminati Pelajar",
            "Diminati Profesional"
        ];

        foreach ($items as $item) {
            DB::table('meta_favorite_item')->insert([
                'name' => $item,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
