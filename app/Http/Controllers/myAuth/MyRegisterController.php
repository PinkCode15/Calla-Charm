<?php

namespace App\Http\Controllers\myAuth;

use App\Http\Controllers\Controller;
use App\Customer;
use App\Vendor;
use App\CustomerWallet;
use App\VendorWallet;
use Illuminate\Http\Request;
use App\Jobs\VerifyEmailJob;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Faker\Generator;
use App\Http\Requests\RegisterRequest;

class MyRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:vendor')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    public function create(RegisterRequest $request, Generator $generator)
    {
        DB::beginTransaction();
        try{
            if($request->type == 'customer'){
                if(Customer::checkIfEmailExists($request['email']))
                {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Email already exists'
                    ])->withInput();
                }

                if(Customer::checkIfPhoneNumberExists($request['phone_number']))
                {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Phone number already exists'
                    ])->withInput();
                }

                if(Customer::checkIfUsernameExists($request['uname']))
                {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Username already exists'
                    ])->withInput();
                }

                $user = Customer::create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    'phone_number' => $request['phone_number'],
                    'type' => $request['type'],
                    'username' => $request['uname'],
                    'password' => bcrypt($request['password'])
                ]);
                
                CustomerWallet::create([
                    'customer_id' => $user->id,
                ]);


                $user->email_token = "ccvfyc_{$generator->sha256}";
                $user->save();
                
            }

            else{
                if(Vendor::checkIfEmailExists($request['email']))
                {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Email already exists'
                    ])->withInput();
                }

                if(Vendor::checkIfPhoneNumberExists($request['phone_number'])) 
                {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Phone number already exists'
                    ])->withInput();
                }

                if(Vendor::checkIfCompanyNameExists($request['uname']))
                {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Company name already exists'
                    ])->withInput();
                }

                $user = Vendor::create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    'phone_number' => $request['phone_number'],
                    'type' => $request['type'],
                    'company_name' => $request['uname'],
                    'password' => bcrypt($request['password'])
                ]);

                VendorWallet::create([
                    'vendor_id' => $user->id,
                ]);

                $user->email_token = "ccvfyv_{$generator->sha256}";
                $user->save();
                
            }

            dispatch(new VerifyEmailJob([
                'user' => $user,
                'link' => route('email.token',['id'=>$user->id, 'token' => $user->email_token])
            ]));

            DB::commit();
 
            return back()->with([
                'type' => 'success',
                'message' => '<b>Account created successfully.<br>
                A link has been sent to your mail, kindly verify your email address.</b>'
            ])->withInput();

        }
        catch(\Exception $exception){
            DB::rollback();

            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to create account. Reason: ' . $exception->getMessage()
            ])->withInput();
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('myregister');
    }
}
