<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestimonialProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimonial_product')->insert([
            [
                'nama' => 'John Doe',
                'deskripsi' => 'Produk ini sangat membantu saya dalam pekerjaan sehari-hari. Kualitasnya luar biasa!',
                'status' => '1', // 1 untuk aktif, 0 untuk tidak aktif
            ],
            [
                'nama' => 'Jane Smith',
                'deskripsi' => 'Saya sangat puas dengan produk ini. Harganya juga terjangkau dengan kualitas yang diberikan.',
                'status' => '1', // 1 untuk aktif, 0 untuk tidak aktif
            ],
            [
                'nama' => 'Ali Rachman',
                'deskripsi' => 'Produk ini memiliki manfaat yang luar biasa dan sangat membantu saya dalam aktivitas sehari-hari.',
                'status' => '0', // 1 untuk aktif, 0 untuk tidak aktif
            ],
        ]);
    }
}
