<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductPicture extends Model
{
    protected $fillable = ['product_id','photo'];


    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    /**
     * Create a new accessor for user photo
     *
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        if ($this->photo == '') {
            return asset('assets/images/default-avatar.png');
        }

        return asset("storage/product_pictures/{$this->photo}");
    }
}
