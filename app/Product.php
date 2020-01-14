<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['vendor_id','type','description','price'];
    

    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
