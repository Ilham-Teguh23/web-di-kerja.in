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
        // Form kontak di dashboard mengizinkan link sosial media kosong
        Schema::table('contact', function (Blueprint $table) {
            $table->string('link_fb')->nullable()->change();
            $table->string('link_ig')->nullable()->change();
            $table->string('link_twitter')->nullable()->change();
            $table->string('link_tiktok')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->string('link_fb')->nullable(false)->change();
            $table->string('link_ig')->nullable(false)->change();
            $table->string('link_twitter')->nullable(false)->change();
            $table->string('link_tiktok')->nullable(false)->change();
        });
    }
};
