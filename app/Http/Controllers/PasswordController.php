<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Vendor;
Use App\Customer; 
Use App\Reset;
use Illuminate\Support\Facades\DB;
use Faker\Generator;
use App\Jobs\ResetPasswordJob;

class PasswordController extends Controller
{
    
    protected $guard;
    /**
     * Create a new controller instance.
     *
     * @return void
     * 
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:vendor')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function forgotPassword()
    {
        return view('forgotPassword');
    }

    public function sendReset(ForgotPasswordRequest $request, Generator $generator)
    {   
        DB::beginTransaction();
        try{
            if ($request->type == 'vendor')
            {
                if(!Vendor::checkIfEmailExists($request['email']))
                {
                    return back()->with([
                        'type' => 'danger',
                        'message' => "No Vendor account registered with this email. "
                    ])->withInput();
                }
                $user = Vendor::where('email', $request->email)->first();
            }
            else if($request->type == 'customer')
            {
                if(!Customer::checkIfEmailExists($request['email']))
                {
                    return back()->with([
                        'type' => 'danger',
                        'message' => "No Customer account registered with this email. "
                    ])->withInput();
                }
                $user = Customer::where('email', $request->email)->first();
            }

            if (Reset::checkIfRecordExists($user->id, $request['type'],'password'))
            {
                $reset = Reset::getRecord($user->id, $request['type'],'password');
                $reset->token = "ccrstpa{$request['type'][0]}_{$generator->sha256}";
                $reset->save();
            }
            else
            {
                $reset = Reset::create([
                    'user_id' => $user->id,
                    'user_type' => $request['type'],
                    'email' => $request['email'],
                    'type' => 'password',
                    'token' => "ccrstpa{$request['type'][0]}_{$generator->sha256}"
                ]);
            }

            dispatch(new ResetPasswordJob([
                'user' => $user,
                'link' => route('receivereset',['id'=>$user->id, 'token' => $reset->token])
            ]));

            DB::commit();
    
            return back()->with([
                'type' => 'success',
                'message' => '<b>Request sent successfully.<br>
                A link has been sent to your mail, kindly verify to reset password.</b>'
            ])->withInput();

        }
        catch(\Exception $exception){
            DB::rollback();

            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to reset password. Reason: ' . $exception->getMessage()
            ])->withInput();
        }
    
    }

    public function receiveReset($id, $token)
    {
        $type = '';
        DB::beginTransaction();

        try{
            if ($token[7] == 'c') 
            {
                $type = "customer";
            }
            elseif ($token[7] == 'v') 
            {
                $type = "vendor";
            }

            $reset = Reset::getRecord($id, $type,'password');
            if ($reset->token != $token){
                abort(404);
            }
            
            return redirect()->route('resetpassword', ['id' => $id, 'type' => $type]);
        }

        catch(\Exception $exception){
            DB::rollback();

            abort(404);
        }

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function resetPassword($id,$type)
    {
        return view('resetPassword')->with([
            'id' => $id,
            'type' => $type
        ]);
    }

    public function updatePassword(ResetPasswordRequest $request)
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

            $user->password = bcrypt($request['password']);
            $user->save();

            $reset = Reset::getRecord($request->id, $request->type,'password');
            $reset->token = '';
            $reset->save();


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
