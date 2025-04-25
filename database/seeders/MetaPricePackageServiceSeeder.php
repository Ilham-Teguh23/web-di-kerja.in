<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MetaPricePackageServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        DB::table('meta_price_package_service')->delete();

        // Harga yang akan di-seed
        $prices = [
            50000,   // Harga dalam format number tanpa koma atau titik
            150000,
            250000,
            350000,
            450000
        ];

        // Masukkan harga ke dalam database
        foreach ($prices as $price) {
            DB::table('meta_price_package_service')->insert([
                'price' => $price,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
