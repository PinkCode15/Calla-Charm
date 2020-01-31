<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Message extends Model
{
    protected $fillable = ['open_trade_id','sender','receiver','body'];


    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function openTrade():BelongsTo
    {
        return $this->belongsTo(OpenTrade::class, 'open_trade_id');
    }

}
