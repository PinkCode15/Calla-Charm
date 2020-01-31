<?php

namespace App\Http\Controllers\MenuItems;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AuthSetting;
use App\Customer;
use App\Vendor;
use Illuminate\Support\Str;
use App\Transaction;
use App\TransactionLog;
use App\OpenTrade;
use App\Message;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Http\Requests\CategoryRequest;
use App\Product;
use App\Http\Requests\MessageRequest;
use App\Cart;


class CustomerProductController extends Controller
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
        // $user = Auth::guard($this->guard)->user();
        $user = Auth::guard($this->guard)->user();
        $cartCount = Cart::where('customer_id',$user->id)->count();
        $categories =  ['book','cloth','hair','shoe','others','all'];

        return view('menuItems.customerProduct',
        ['guard' =>  $this->guard,
         'cartCount' => $cartCount,
        'categories' => $categories
        ]);
    }

    public function selectCategory(CategoryRequest $request)
    {
        $user = Auth::guard($this->guard)->user();
        $cartCount = Cart::where('customer_id',$user->id)->count();
        $categories =  ['book','cloth','hair','shoe','others','all'];
        $category = $request->category;
        if ($category == "all")
        {
            $products = Product::all();
        }
        else{
            $products = Product::getProducts($category);
        }
        // $product = Product::first();
        // dd($product->productPicture->first()->getAvatarAttribute());
        return view('menuItems.customerproductview',
        ['guard' =>  $this->guard,
        'cartCount' => $cartCount,
        'categories' => $categories,
        'products' => $products
        ]);

    }

    public function selectProduct($id)
    {
        $user = Auth::guard($this->guard)->user();
        $cartCount = Cart::where('customer_id',$user->id)->count();
        $openTrade = OpenTrade::where('customer_id',$user->id)->where('product_id',$id)->where('status','processing')->first();
        DB::beginTransaction();
        try{
            if ($openTrade == null){
                $openTrade = OpenTrade::create([
                    'customer_id' => $user->id,
                    'product_id' => $id
                ]);
            }

            $messages = Message::where("open_trade_id",$openTrade->id)->orderBy('created_at', 'ASC')->get();
            DB::commit();
        }

        catch(\Exception $exception){
            DB::rollback();
            return back()->with([
                'type' => 'danger',
                'message' => 'Error ocurred. Reason: ' . $exception->getMessage()
            ])->withInput();
        }

        $product = Product::where('id',$id)->first();
        return view('menuItems.customerindividualproductview',
        ['guard' =>  $this->guard,
        'cartCount' => $cartCount,
        'product' => $product,
        'openTrade'=> $openTrade,
        'messages' => $messages
        ]);
    }
    public function sendMessage(MessageRequest $request)
    {
        DB::beginTransaction();
        try{
            Message::create([
                "open_trade_id" => $request->openTradeId,
                "sender" => $this->guard,
                "receiver" => $request->receiver,
                "body" => $request->messageBody
            ]);

            DB::commit();
            return back();
        }
        catch(\Exception $exception){
            DB::rollback();
            return back()->with([
                'type' => 'danger',
                'message' => 'Error ocurred ' . $exception->getMessage()
            ])->withInput();
        }
    }

}
