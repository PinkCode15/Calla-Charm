<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPicture extends Model
{
    protected $fillable = ['product_id','photo'];


    public function product():BelongsTo
    {
    return $this->belongsTo(Product::class,'product_id');
    }
}
