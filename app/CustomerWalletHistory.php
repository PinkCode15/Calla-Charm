<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerWalletHistory extends Model
{
    protected $fillable = ['customer_id','previous_balance','current_balance','transaction_id','transaction_type'];

    public function transaction(): BelongsTo
    {
        return $this->BelongsTo(Transaction::class);
    }
}
