<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','email','company_name','email_token','phone_number',
                            'otp','password','account_number','account_name','photo'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token',
    ];

    protected $guard = 'vendor';


    /**
     * Vendor's wallet
     *
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(VendorWallet::class);
    } 

    public function walletHistory(): HasOne
    {
        return $this->hasOne(VendorWalletHistory::class);
    }
    
    public function closedTrade(): HasMany
    {
        return $this->hasMany(ClosedTrade::class);
    }

    public static function checkIfEmailExists($email)
    {
        return self::where('email', $email)->exists();
    }

    public static function checkIfPhoneNumberExists($number)
    {
        return self::where('phone_number', $number)->exists();
    }

    public static function checkIfCompanyNameExists($name)
    {
        return self::where('company_name', $name)->exists();
    }
}
