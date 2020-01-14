<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public static function generateOTP(){
        return (string) random_int(111111, 999999);
    }
}
