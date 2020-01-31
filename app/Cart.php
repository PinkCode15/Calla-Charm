<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = ['closed_trade_id','customer_id'];

    public function closedTrade():BelongsTo
    {
        return $this->belongsTo(ClosedTrade::class);
    }

}
