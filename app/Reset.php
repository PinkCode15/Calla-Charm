<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','user_type','email','type','token',];

    public static function checkIfRecordExists($user_id, $user_type, $type)
    {
        return self::where([
            'user_id' => $user_id,
            'user_type' => $user_type,
            'type' => $type
        ])->exists();
    }

    public static function getRecord($user_id, $user_type, $type)
    {
        return self::where([
            'user_id' => $user_id,
            'user_type' => $user_type,
            'type' => $type
        ])->first();
    }
}
