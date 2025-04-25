<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('package_service_consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_service_id')->constrained('package_service')->onDelete('cascade');
            $table->foreignId('consultation_detail_id')->constrained('meta_consultation_details')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_service_consultations');
    }
};
