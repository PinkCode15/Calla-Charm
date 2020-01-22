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
use Illuminate\Support\Facades\DB;
// use Auth;
use App\Http\Requests\CategoryRequest;
use App\Product;

class CustomerProductController extends Controller
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
        // $user = Auth::guard($this->guard)->user();
        $categories =  ['book','cloth','hair','shoe'];

        return view('menuItems.customerProduct',
        ['guard' =>  $this->guard,
        'categories' => $categories
        ]);
    }

    public function selectCategory(CategoryRequest $request)
    {
        $categories =  ['book','cloth','hair','shoe'];
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
        'categories' => $categories,
        'products' => $products
        ]);

    }
    public function selectProduct($id)
    {
        $product = Product::where('id',$id)->first();
        return view('menuItems.customerindividualproductview',
        ['guard' =>  $this->guard,
        'product' => $product
        ]);
    }


}
