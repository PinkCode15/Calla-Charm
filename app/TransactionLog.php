<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    protected $fillable = ['transaction_id','status'];
    

    public function transaction():BelongsTo
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }
}
