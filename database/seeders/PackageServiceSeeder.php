<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PackageServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data yang ada untuk menghindari duplikasi saat seeder dijalankan lagi
        DB::table('package_service')->delete();
        $defaultPriceId = DB::table('meta_price_package_service')->first()->id;

        // Data untuk di-seed
        $services = [
            [
                'name' => 'Konsultasi Alur / Program',
                'description' => 'Konsultasi ini bersifat GRATIS, tentunya Syarat dan Ketentuan Berlaku',
                'price_id' => $defaultPriceId,
            ],
        ];

        // Masukkan data ke dalam database
        foreach ($services as $service) {
            DB::table('package_service')->insert([
                'name' => $service['name'],
                'description' => $service['description'],
                'meta_price_package_service_id' => $service['price_id'], // asumsi kolom ini ada jika perlu
                'meta_favorite_item_id' => null, // asumsi kolom ini ada jika perlu
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
