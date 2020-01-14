<?php

namespace App\Http\Controllers\myAuth;

use App\Jobs\VerifyPhoneNumberJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Vendor;
use App\Token;


class EmailTokenController extends Controller
{
    public function index($id, $token)
    {
        $type = '';
        DB::beginTransaction();

        try{
            if ($token[5] == 'c'){
                $user = Customer::findOrFail($id);
                if($user->email_token != $token)
                {
                    abort(404);
                }
                $user->is_email_verified = true;
                $user->email_verified_at = now();
                $user->phone_token = Token::generateOTP();
                $user->save();
                $type = 'customer';
            }
            elseif($token[5] == 'v'){
                $user = Vendor::findOrFail($id);
                if($user->email_token != $token)
                {
                    abort(404);
                }
                $user->is_email_verified = true;
                $user->email_verified_at = now();
                $user->phone_token = Token::generateOTP();
                $user->save();
                $type = 'vendor';
    
            }
            // elseif($token[5] == 'a'){
            //     $admin = Vendor::findById($id);
            //     $admin->is_email_verified = true;
            //     $admin->email_verified_at = now();
            //     $admin->save();
            // }
            else{
                abort(404);
            }

            dispatch(new VerifyPhoneNumberJob([
                'user' => $user,
            ]));

            DB::commit();


            return redirect()->route('phone.token', ['id' => $user->id, 'type' => $type]);
        }

        catch(\Exception $exception){
            DB::rollback();

            dd($exception);
        }

    }

}
