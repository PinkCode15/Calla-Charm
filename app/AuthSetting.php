<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthSetting extends Model
{
    protected $hidden = [
        'password' ,'remember_token',
    ];

    public static function editGuard($guard)
    {
        $setting = self::whereId(1)->first();
        $setting->guard = $guard;
        $setting->save();
    }

    public static function getGuard()
    {
        $setting = self::whereId(1)->first();
        return $setting->guard;
    }
}
