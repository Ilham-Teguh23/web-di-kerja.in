<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialProduct extends Model
{
    protected $table = "testimonial_product";

    protected $keyType = 'string';

    protected $guarded = [''];

    public function imageProduct()
    {
        return $this->hasMany(ImageTestimonialProduct::class, 'testimonial_product_id');
    }
}
