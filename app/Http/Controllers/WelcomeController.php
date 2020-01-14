<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuthSetting;

class WelcomeController extends Controller
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
        $this->guard = AuthSetting::getGuard();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('mywelcome',['guard' =>  $this->guard]);
    }
}
