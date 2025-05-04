<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = "about";

    protected $keyType = 'string';

    protected $guarded = [''];

    public function AboutListSuperiority()
    {
        return $this->hasMany(AboutListSuperiority::class, 'about_id');
    }
}
