<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    protected $fillable = ['user_id','user_type','transaction_id','transaction_type',
                            'previous_balance','current_balance'];
    
                            
    public function transaction():BelongsTo
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }
}
