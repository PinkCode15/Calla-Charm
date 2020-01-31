<?php

namespace App\Http\Controllers\MenuItems;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductPicture;
use Illuminate\Http\Request;
use Auth;
use App\AuthSetting;
use Illuminate\Support\Facades\DB;
use App\OpenTrade;
use App\Message;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\NewProductRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use http\Exception\RuntimeException;
use Faker\Generator;
use Illuminate\Support\Collection;



class VendorProductController extends Controller
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
        $this->middleware('check.guard:vendor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::guard($this->guard)->user();
        $products = Product::where('vendor_id', $user->id)->get();


        return view('menuItems.vendorProduct',
        ['guard' =>  $this->guard,
        'products' => $products
        ]);
    }

    public function newProduct()
    {
        $categories =  ['book','cloth','hair','shoe','others'];
        return view('menuItems.vendorNewProduct',
        ['guard' =>  $this->guard,
        'categories' => $categories
        ]);
    }

    public function addProduct(NewProductRequest $request, Generator $generator)
    {
        DB::beginTransaction();
        try{
            $product = Product::create([
                "vendor_id" => Auth::guard($this->guard)->user()->id,
                "name" => $request->name,
                "type" => $request->category,
                "price" => $request->price,
                "description" => $request->details,
                "quantity" => $request->quantity,
                "size" => $request->has('size') ? $request->size : 0

            ]);
            $photo = $this->getUploadedFileName($request,'picture1',$generator);
            ProductPicture::create([
                    "product_id" => $product->id,
                    "photo" => $photo
            ]);
            $photo = $this->getUploadedFileName($request, 'picture2',$generator);
            ProductPicture::create([
                    "product_id" => $product->id,
                    "photo" => $photo
            ]);
            $photo = $this->getUploadedFileName($request,'picture3',$generator);
            ProductPicture::create([
                    "product_id" => $product->id,
                    "photo" => $photo
            ]);

            DB::commit();
            $products = Product::where('vendor_id', Auth::guard($this->guard)->user()->id)->get();

            return view('menuItems.vendorProduct',
                ['guard' =>  $this->guard,
                'products' => $products
                ]);
        }
        catch(Exception $e){
            DB::rollBack();
            dd($e);
        }

    }

    public function selectProduct($id)
    {
        $user = Auth::guard($this->guard)->user();
        $openTrade = OpenTrade::where('product_id',$id)->where('status','processing')->get();
        $product = Product::where('id',$id)->first();
        // dd($product->productPicture);
        // foreach($product->productPicture as $picture){
        //     echo($picture);
        // }
        // dd("hi");
        $messages = new Collection();
        foreach($openTrade as $ok){
            $messages->push(Message::where("open_trade_id",$ok->id)->orderBy('created_at', 'ASC')->get());
        }
    //    dd($messages);
        // $messages = Message::where("open_trade_id",$openTrade->id)->orderBy('created_at', 'ASC')->get();
        return view('menuItems.vendorindividualproductview',
        ['guard' =>  $this->guard,
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

    /**
     * Get uploaded user photo
     *
     * @param Request $request
     * @return string
     */
    private function getUploadedFileName(Request $request,$picture,$generator): string
    {
        // dd($request->file('picture1'));
        $file = '';

        try {
            $folder = storage_path('app/public/product_pictures');
            $fileName = "{$request->name}_{$generator->sha256}_{$picture[-1]}";
            $extension = $request->file($picture)->getClientOriginalExtension();

            if (! file_exists($folder) && ! mkdir($folder) && ! is_dir($folder)) {
                throw new RuntimeException('Failed to create storage folder.');
            }

            // Resize the chosen image then, upload
            $photo = Image::make($request->file($picture))
                ->fit(300, 300)
                ->save("{$folder}/{$fileName}.{$extension}");

            $file = $photo->filename . '.' . $extension;
        }

        catch (\Exception $exception) {
            if ($file !== '') {
                // Delete uploaded photo from disk.
                Storage::disk('public')->delete("product_pictures/{$file}");
            }
        }
        // dd($file);
        return $file;
    }
}
