<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuthSetting;
use App\Transaction;
use App\ClosedTrade;
use Auth;
use App\Cart;

class HomeController extends Controller
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
        $this->middleware('assign.guard:'. $this->guard );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // dd(Transaction::where('user_id',$user->id)->where('user_type',$this->guard)->get() );
        $user = Auth::guard($this->guard)->user();
        $cartCount = Cart::where('customer_id',$user->id)->count();
        // $closedTrade= ClosedTrade::where('id',1)->first();
        // dd($closedTrade->customer());
        // $transact = Transaction::where('id',1)->first();
        // $closed = ClosedTrade::where('id',1)->first();
        // dd($closed->product()->get());
        // $log =$user->walletHistory()->first();
        // dd($log->transaction()->first()->closedTrade()->first()->product()->first()->description);
        // ->product()->description());
        return view('home',
        ['guard' =>  $this->guard,
        'cartCount' => $cartCount,
        'user' => $user,
        'logs' => $user->walletHistory()->get(),
        'transaction' => Transaction::where('user_id',$user->id)->where('user_type',$this->guard)->get(),
        ]
    );
    }
}
