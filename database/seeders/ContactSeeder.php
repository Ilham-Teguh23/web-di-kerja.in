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
            'link_fb' => 'https://facebook.com/yourprofile',
            'link_ig' => 'https://instagram.com/yourprofile',
            'link_twitter' => 'https://twitter.com/yourprofile',
            'link_tiktok' => 'https://tiktok.com/@yourprofile',
        ]);
    }
}
