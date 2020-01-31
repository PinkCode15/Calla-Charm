<?php

namespace App\Http\Controllers\MenuItems;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AuthSetting;
use App\Cart;
use App\Http\Requests\BuyRequest;
use App\Http\Requests\CartRequest;
use App\ClosedTrade;
use App\Product;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Customer;
use App\Transaction;
use App\TransactionLog;
use App\CustomerWallet;
use App\CustomerWalletHistory;
use Illuminate\Support\Str;



class CartController extends Controller
{
    protected $guard;
    protected $cartCount;
    protected $user;
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
        $this->middleware('check.guard:customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(Auth::guard($this->guard)->user());
        $user = Auth::guard($this->guard)->user();
        $cartCount = Cart::where('customer_id',$user->id)->count();
        $cart = Cart::where('customer_id',$user->id)->get();

        return view('menuItems.cart',
        ['guard' =>  $this->guard,
        'cartCount' =>  $cartCount,
        'cart' => $cart
        ]);
    }

    public function buyProduct(BuyRequest $request)
    {
        $product = Product::where('id',$request->productId)->first();
        $user = Auth::guard($this->guard)->user();

        DB::beginTransaction();
        try{
            $closedTrade = ClosedTrade::create([
                'product_id' => $request->productId,
                'customer_id' => $user->id,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'size' => isset($request->size) ? $request->size : null
            ]);

            Cart::create([
                'closed_trade_id' => $closedTrade->id,
                'customer_id' => $user->id
            ]);
            DB::commit();

            return back()->with([
                'type' => 'success',
                'message' => 'Product Added To Cart'
            ]);
        }

        catch(\Exception $exception){
            DB::rollback();

            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to buy product. Reason: ' . $exception->getMessage()
            ]);
        }
    }

    public function payProduct(CartRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = Auth::guard($this->guard)->user();
            $closedTrade = ClosedTrade::where('product_id',$request->productId)->where('customer_id',$user->id)->first();
            $amount = $closedTrade->price * $closedTrade->quantity;

            if($amount > $user->wallet->current_amount){
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Insufficient Fund in Wallet',
                ]);
            }

            $reference = $this->getReference($user, 'WIIN');

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'user_type' => 'customer',
                'transaction_type' => 'credit',
                'closed_trade_id' => $closedTrade->id,
                'amount' => $amount,
                'description' => 'Calla Charm: Wallet Withdraw In-App',
                'total_amount' => $amount ,
                'reference' => $reference
            ]);

            $wallet = CustomerWallet::where('customer_id',$transaction->user_id)->first();
            $wallet->previous_amount = $wallet->current_amount;
            $wallet->current_amount = $wallet->current_amount - $transaction->total_amount ;
            $wallet->save();

            $wallet_history = CustomerWalletHistory::create([
                'customer_id' => $transaction->user_id,
                'transaction_id' => $transaction->id,
                'transaction_type' => 'withdraw',
                'previous_balance' => $wallet->previous_amount,
                'current_balance' => $wallet->current_amount
            ]);


            $transactionLog = TransactionLog::create([
                'transaction_id' => $transaction->id,
                'status' => 'successful'
            ]);

            $cart = Cart::where('closed_trade_id',$closedTrade->id)->first();
            $cart->delete();

            DB::commit();
            return back()->with([
                'type' => 'success',
                'message' => 'Purchase Successful'
            ]);
        }
        catch(\Exception $exception){
            DB::rollback();

            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to purchase product. Reason: ' . $exception->getMessage()
            ])->withInput();
        }

    }

    public function removeProduct(CartRequest $request)
    {
        $user = Auth::guard($this->guard)->user();
        $closedTrade = ClosedTrade::where('product_id',$request->productId)->where('customer_id',$user->id)->first();
        $cart = Cart::where('closed_trade_id',$closedTrade->id)->first();
        $cart->delete();
        return back()->with([
            'type' => 'success',
            'message' => 'Product Removed'
        ]);
    }

    private function getReference($user, $type)
    {
        return Str::lower(sprintf('%s-%s-%s-%s',
            $user->first_name,
            'Calla', $type,
            Str::random(4)
        ));
    }
}
