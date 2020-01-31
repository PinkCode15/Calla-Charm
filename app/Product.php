<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['vendor_id','name','type','description','price'];


    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function productPicture(): HasMany
    {
        return $this->hasMany(ProductPicture::class);
    }

    public static function getProducts($category)
    {
        return self::where('type', strtolower($category))->get();
    }
}
