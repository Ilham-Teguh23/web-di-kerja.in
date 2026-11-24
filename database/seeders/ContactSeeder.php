<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact')->insert([
            'address' => 'Jl. Darma Putra Raya No.6, Kby. Lama Sel., Kec. Kby. Lama, Kota Jakarta Selatan.',
            'phone' => '0812-1470-7143',
            'email' => 'mimin.dikerjain@gmail.com',
            // Isi link sosial media dari menu Master > Kontak, yang kosong tidak ditampilkan
            'link_fb' => null,
            'link_ig' => null,
            'link_twitter' => null,
            'link_tiktok' => null,
        ]);
    }
}
