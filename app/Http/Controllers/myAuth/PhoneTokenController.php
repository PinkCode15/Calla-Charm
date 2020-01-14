<?php

namespace App\Http\Controllers\myAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Services\SendSms\Ebulk;
use App\Customer;
use App\Vendor;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PhoneVerifyRequest;



class PhoneTokenController extends Controller
{
    public function index($id, $type)
    {
        return view('verifyPhone')->with([
            'id' => $id,
            'type' => $type
        ]);  

    

        // catch(\Exception $exception){
        //     DB::rollback();

        //     return redirect()->route('home')->with([
        //         'type' => 'danger',
        //         'message' => 'Failed to verify phone number. Reason: ' . $exception->getMessage()
        //     ])->withInput();
        // }

    }

    public function verify(PhoneVerifyRequest $request)
    {
        DB::beginTransaction();
        try{

            if ($request->type == 'customer')
            {
                $user =  Customer::findOrFail($request->id);
            }
            else if($request->type == 'vendor')
            {
                $user = Vendor::findOrFail($request->id);
            }
            else{
                abort(404);
            }

            if ($request->otp == $user->phone_token)
            {
                $user->is_phone_number_verified = true;
                $user->phone_number_verified_at = now();
                $user->email_token = '';
                $user->phone_token = '';
                $user->save();
            }

            else{
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Invalid OTP'
                ])->withInput();;
            }

            DB::commit();

            return redirect()->route('login');

        }

        catch(Exception $e)
        {
            DB::rollback();

            dd($e);

        }


    }
}
