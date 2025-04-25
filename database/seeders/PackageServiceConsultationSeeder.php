<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PackageServiceConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming there is already a package_service entry in the database
        $packageServiceId = DB::table('package_service')->pluck('id')->first();

        // Fetch all consultation detail IDs
        $consultationIds = DB::table('meta_consultation_details')->pluck('id');

        // Shuffle the IDs and pick the first six
        $selectedConsultations = $consultationIds->shuffle()->take(6);

        // Ensure existing associations are cleared to avoid duplicates
        DB::table('package_service_consultations')->where('package_service_id', $packageServiceId)->delete();

        // Create new associations in package_service_consultations
        foreach ($selectedConsultations as $consultationId) {
            DB::table('package_service_consultations')->insert([
                'package_service_id' => $packageServiceId,
                'consultation_detail_id' => $consultationId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
