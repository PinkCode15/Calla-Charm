<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpenTrade extends Model
{
    protected $fillable = ['customer_id','product_id'];


    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
