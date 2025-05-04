<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutListSuperioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming there is already a package_service entry in the database
        $About = DB::table('about')->pluck('id')->first();

        // Fetch all consultation detail IDs
        $listSuperiority = DB::table('list_superiority')->pluck('id');

        // Shuffle the IDs and pick the first six
        $selectedListSuperiority = $listSuperiority->shuffle()->take(3);

        // Ensure existing associations are cleared to avoid duplicates
        DB::table('about_list_superiority')->where('about_id', $About)->delete();

        // Create new associations in package_service_consultations
        foreach ($selectedListSuperiority as $consultationId) {
            DB::table('about_list_superiority')->insert([
                'about_id' => $About,
                'list_superiority_id' => $consultationId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
    
}
