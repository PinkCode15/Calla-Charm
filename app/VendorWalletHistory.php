<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorWalletHistory extends Model
{
    public function transaction(): BelongsTo
    {
        return $this->BelongsTo(Transaction::class);
    }
    
}
