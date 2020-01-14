<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FailedTrade extends Model
{
    protected $fillable = ['customer_id','closed_trade_id','stage_failed','are_goods_returned'];


    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function closedTrade():BelongsTo
    {
        return $this->belongsTo(ClosedTrade::class, 'closed_trade_id');
    }
}
