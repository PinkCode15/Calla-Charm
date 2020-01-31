<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClosedTrade extends Model
{
    protected $fillable = ['customer_id','product_id','price','quantity','size','other_details','has_customer_paid',
                            'are_goods_sent','are_goods_approved','status','rating'];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function transaction():HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
