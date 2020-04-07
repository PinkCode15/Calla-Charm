<?php

namespace App\Http\Controllers\MenuItems;

use App\Http\Controllers\Controller;
use App\AuthSetting;
use Illuminate\Http\Request;
use App\Services\Request\Paystack;
use App\Http\Requests\WalletRequest;
use App\Customer;
use App\Vendor;
use Illuminate\Support\Str;
use App\Transaction;
use App\TransactionLog;
use Illuminate\Support\Facades\DB;
use App\CustomerWallet;
use App\CustomerWalletHistory;
use Auth;
use App\Cart;

class WalletController extends Controller
{
    protected $guard;
    protected $cartCount;
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
        $user = Auth::guard($this->guard)->user();
        $cartCount = Cart::where('customer_id',$user->id)->count();
        return view('menuItems.wallet',
        ['guard' =>  $this->guard,
        'cartCount' => $cartCount,
        'user' => $user,
        'logs' => $user->walletHistory()->get(),
        'transaction' => Transaction::where('user_id',$user->id)->where('user_type',$this->guard)->get(),
        ]);

    }

    public function fund(WalletRequest $request)
    {
        // $user = Customer::first();
        // $paystack = new Paystack();
        // $response = $paystack->transferRecipient($user,'customer');
        // dd("hi");

        DB::beginTransaction();
        try{
            $user = Customer::where('id',$request->userId)->first();
            $charge = config('calla.charge.deposit');
            if($request['amount'] <= $charge ){
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Fund amount is too small',
                ]);
            }
            $reference = $this->getReference($user, 'DEYU');

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'user_type' => 'customer',
                'transaction_type' => 'credit',
                'amount' => $request['amount'],
                'description' => 'Calla Charm: Wallet Deposit From You',
                'charge' => $charge,
                'total_amount' => $request['amount'] - $charge ,
                'reference' => $reference
            ]);

            $transactionLog = TransactionLog::create([
                'transaction_id' => $transaction->id,
                'status' => 'processing'
            ]);

            $amount =  $request['amount'] * 100;
            $paystack = new Paystack();
            $response = $paystack->pay($user->email,$amount,$reference);

            DB::commit();

            if ($response->status == 'true') {
                return redirect()->away($response->data->authorization_url) ;
            }
            // dd($response);

        }

        catch(\Exception $exception){
            DB::rollback();

            // dd($exception);
            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to credit account. Reason: ' . $exception->getMessage()
            ])->withInput();
        }
    }

    public function verifyFund(Request $request)
    {
        DB::beginTransaction();

        try{
            $paystack = new Paystack();
            $response = $paystack->requery($request->reference);
            if ($response->status == 'true' && $response->data->status == 'success'){
                $transaction = Transaction::where('reference',$request->reference)->first();

                $transactionLog = TransactionLog::where('transaction_id',$transaction->id)->first();
                $transactionLog->status = 'successful';
                $transactionLog->save();

                $wallet = CustomerWallet::where('customer_id',$transaction->user_id)->first();
                $wallet->previous_amount = $wallet->current_amount;
                $wallet->current_amount = $transaction->total_amount + $wallet->current_amount ;
                $wallet->save();

                $wallet_history = CustomerWalletHistory::create([
                    'customer_id' => $transaction->user_id,
                    'transaction_id' => $transaction->id,
                    'transaction_type' => 'deposit',
                    'previous_balance' => $wallet->previous_amount,
                    'current_balance' => $wallet->current_amount
                ]);

            }
            DB::commit();
            return redirect()->route('menu.wallet')->with([
                'type' => 'success',
                'message' => 'Account funded successfully'
            ]);
         }

        catch(\Exception $exception){
            DB::rollback();

            dd($exception);
        }


    }
    private function getReference($user, $type)
    {
        return Str::lower(sprintf('%s-%s-%s-%s',
            $user->first_name,
            'Calla', $type,
            Str::random(4)
        ));
    }

    public function withdraw(WalletRequest $request)
    {
        DB::beginTransaction();
        // dd($request->type);
        try{
            if ($request->type == "customer" ){
                $user = Customer::where('id',$request->userId)->first();
            }
            else{
                $user = Vendor::where('id',$request->userId)->first();
            }
            $charge = config('calla.charge.withdraw');
            $check_amount = $request['amount'] + $charge ;

            if($check_amount > $user->wallet->current_amount  ){
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Insufficient Funds.',
                ]);
            }
            if($request['amount'] <= $charge){
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Withdraw amount is too small.',
                ]);
            }
            $reference = $this->getReference($user, 'WIYU');

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'user_type' => 'customer',
                'transaction_type' => 'debit',
                'amount' => $request['amount'],
                'description' => 'Calla Charm: Wallet Withdraw Out-Of-App',
                'charge' => $charge,
                'total_amount' => $request['amount'] - $charge ,
                'reference' => $reference
            ]);

            $transactionLog = TransactionLog::create([
                'transaction_id' => $transaction->id,
                'status' => 'processing'
            ]);

            DB::commit();
            return back()->with([
                'type' => 'success',
                'message' => 'Request to withdraw sent successfully'
            ]);
        }

        catch(\Exception $exception){
            DB::rollback();

            // dd($exception);
            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to debit account. Reason: ' . $exception->getMessage()
            ])->withInput();
        }
    }
}
