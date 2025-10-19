<?php

namespace Database\Seeders;

use App\Models\AboutListSuperiority;
use App\Models\ListSuperiority;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\MetaFavoriteItemSeeder;
use Database\Seeders\MetaConsultationServiceItemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
        public function run(): void
        {
            // User::factory(10)->create();

            $this->call([
                UserSeeder::class,
                MetaConsultationServiceItemSeeder::class,
                MetaFavoriteItemSeeder::class,
                MetaPricePackageServiceSeeder::class,
                PackageServiceSeeder::class,
                PackageServiceConsultationSeeder::class,
                // AboutSeeder::class,
                ListSuperioritySeeder::class,
                // AboutListSuperioritySeeder::class,
                ContactSeeder::class,
                TestimonialProductSeeder::class,
            ]);
        }
}
