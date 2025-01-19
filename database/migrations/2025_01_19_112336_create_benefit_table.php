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
        Schema::create('benefit', function (Blueprint $table) {
            $table->id();
            $table->string("judul", 100);
            $table->string("deskripsi", 250);
            $table->string("icon", 100);
            $table->enum("status", ["1", "0"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefit');
    }
};
