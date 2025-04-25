<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    protected $table = "package_service";

    protected $guarded = [''];

    public function packageConsultation()
    {
        return $this->hasMany(PackageServiceConsultation::class, 'package_service_id');
    }

    public function price()
    {
        return $this->belongsTo(MetaDataPriceItem::class, 'meta_price_package_service_id');
    }

    public function FavoriteItem()
    {
        return $this->belongsTo(MetaDataFavoriteItem::class, 'meta_favorite_item_id');
    }
    
}
