<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ListSuperioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            "Dikerjakan oleh orang berprofresional dalam bidang nya.",
            "Jaminan refund biaya apabila tidak sesuai dengan kesepakatan.",
            "Terbuka untuk konsultasi terlebih dahulu.",
        ];

        foreach ($items as $item) {
            DB::table('list_superiority')->insert([
                'name' => $item,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
