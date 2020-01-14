<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = ['user_id','user_type','transaction_type','amount','charge','total_amount',
                            'reference','closed_trade_id','description'];
    

    public function closedTrade():BelongsTo
    {
        return $this->belongsTo(ClosedTrade::class,'closed_trade_id');
    }

}
