<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('testimonial_product', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->unique()->after('nama');
        });

        // Isi slug untuk data yang sudah ada agar halaman /produk/{slug} langsung bisa diakses
        $used = [];

        foreach (DB::table('testimonial_product')->orderBy('id')->get(['id', 'nama']) as $product) {
            $base = Str::slug($product->nama) ?: 'produk';
            $slug = $base;
            $counter = 2;

            while (in_array($slug, $used, true)) {
                $slug = $base . '-' . $counter++;
            }

            $used[] = $slug;

            DB::table('testimonial_product')->where('id', $product->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonial_product', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
