<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\Request\Paystack;

class Bank extends Model
{
    protected $fillable = ['name','code'];


    

     /**
     * get the bank Code of the Bank
     */
    public static function getBankCode($bankName)
    {
        return (new self())
        ->where('name', $bankName)
        ->pluck('code')
        ->first();
    }
}
