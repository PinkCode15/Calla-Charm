<?php

namespace App\Http\Controllers\myAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Customer;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Auth;

class MyLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('mylogin');
    }

    public function logout(Request $request)
    {
        $authUser = Auth::guard($request->type)->user();
        $authUser->remember_token = '';
        $authUser->save();
        Auth::guard($request->type)->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    public function begin(LoginRequest $request)
    {
        if (Auth::guard($request->type)->attempt(['email' => $request->email, 'password' => $request->password,
        'is_email_verified'=> 1,'is_phone_number_verified'=> 1], $request->get('remember'))) {


            $photo  = '#'.substr(md5(time()), 0, 6);
            $user = Auth::guard($request->type)->user();
            $user->photo = $photo;
            $user->save();

            return redirect()->intended('/home');
        }
        return back()->with([
            'type' => 'danger',
            'message' => 'Cannot Login.<br> Check login details and ensure that email and phone number have been verified'
        ])->withInput($request->only('email', 'remember'));
        
        // try{
        //     if($request->type == 'customer')
        //     {
        //         $pass = Customer::ValidateLoginDetails($request->email,$request->password);
        //     }
        //     else if($request->type == 'vendor')
        //     {
        //         $pass = Vendor::ValidateLoginDetails($request->email,$request->password);
        //     }

        //     if ($pass)
        //     {
        //         return redirect()->route('dashboard');
        //     }
        //     else{
        //         return back()->with([
        //             'type' => 'danger',
        //             'message' => 'Invalid Login Details'
        //         ])->withInput();;
        //     }

        // }
        // catch(Exception $e)
        // {
        //     dd($e);
        // }

    }
}
