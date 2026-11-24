<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TestimonialProduct extends Model
{
    protected $table = "testimonial_product";

    protected $keyType = 'string';

    protected $guarded = [''];

    protected static function booted(): void
    {
        // Slug dipakai untuk URL halaman detail produk (/produk/{slug})
        static::saving(function (TestimonialProduct $product) {
            if (blank($product->slug) || $product->isDirty('nama')) {
                $product->slug = static::uniqueSlug($product->nama, $product->getKey());
            }
        });
    }

    public static function uniqueSlug(?string $nama, $ignoreId = null): string
    {
        $base = Str::slug((string) $nama) ?: 'produk';
        $slug = $base;
        $counter = 2;

        while (static::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists()) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    public function imageProduct()
    {
        return $this->hasMany(ImageTestimonialProduct::class, 'testimonial_product_id');
    }
}
