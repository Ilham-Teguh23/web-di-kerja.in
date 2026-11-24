<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutListSuperiority extends Model
{
    protected $table = "about_list_superiority";

    protected $keyType = 'string';

    protected $guarded = [''];

    public function listSuperiority()
    {
        return $this->belongsTo(ListSuperiority::class, 'list_superiority_id');
    }
}
