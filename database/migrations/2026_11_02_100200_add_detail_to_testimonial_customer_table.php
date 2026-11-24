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
        Schema::table('testimonial_customer', function (Blueprint $table) {
            $table->string('nama', 100)->nullable()->after('id');
            $table->string('keterangan', 100)->nullable()->after('nama');
            $table->text('deskripsi')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonial_customer', function (Blueprint $table) {
            $table->dropColumn(['nama', 'keterangan', 'deskripsi']);
        });
    }
};
