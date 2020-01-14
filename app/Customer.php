<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','email','username','email_token','phone_number',
                            'otp','account_number','account_name','photo','password'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password' ,'remember_token',
    ];

    protected $guard = 'customer';


    /**
     * Customer's wallet
     *
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(CustomerWallet::class);
    } 

    public function walletHistory(): HasMany
    {
        return $this->hasMany(CustomerWalletHistory::class);
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

    public static function checkIfUsernameExists($name)
    {
        return self::where('username', $name)->exists();
    }
    
}
