<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageServiceConsultation extends Model
{
    protected $table = "package_service_consultations";

    protected $guarded = [''];

    public function detailConsultant()
    {
        return $this->belongsTo(MetaDataDetailConsultant::class, 'consultation_detail_id');
    }

}
