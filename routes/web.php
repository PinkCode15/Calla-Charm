<?php

use App\Http\Controllers\myAuth\MyLoginController;
use App\Http\Controllers\myAuth\MyRegisterController;
use App\Http\Controllers\myAuth\EmailTokenController;
use App\Http\Controllers\myAuth\PhoneTokenController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\MenuItems\WalletController;
use App\Http\Controllers\MenuItems\CustomerProductController;
use App\Http\Controllers\MenuItems\VendorProductController;
use App\Http\Controllers\MenuItems\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', function () {
    return view('mywelcome');
})->name('welcome');

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', [MyLoginController::class, 'index'])->name('login');
Route::post('/login', [MyLoginController::class, 'begin'])->name('login.begin');
Route::post('/logout', [MyLoginController::class, 'logout'])->name('logout');
Route::get('/register', [MyRegisterController::class, 'index'])->name('register');
Route::post('/register/create', [MyRegisterController::class, 'create'])->name('register.create');
Route::get('/email/{id}/{token}',[EmailTokenController::class,'index'])->name('email.token');
Route::get('/phone/{id}/{type}',[PhoneTokenController::class,'index'])->name('phone.token');
Route::post('/phone/verify',[PhoneTokenController::class,'verify'])->name('phone.verify');
Route::get('/forgotpassword', [PasswordController::class, 'forgotPassword'])->name('forgotpassword');
Route::post('/forgotpassword', [PasswordController::class, 'sendReset'])->name('forgotpassword.send');
Route::get('/receivereset/{id}/{token}', [PasswordController::class, 'receiveReset'])->name('receivereset');
Route::get('/resetpassword/{id}/{type}', [PasswordController::class, 'resetPassword'])->name('resetpassword');
Route::post('/resetpassword', [PasswordController::class, 'updatePassword'])->name('resetpassword.send');
Route::get('/wallet', [WalletController::class, 'index'])->name('menu.wallet');
Route::post('/wallet/fund', [WalletController::class, 'fund'])->name('wallet.fund');
Route::get('/wallet/verify', [WalletController::class, 'verifyFund'])->name('wallet.verify');
Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');
Route::get('/product/customer', [CustomerProductController::class, 'index'])->name('menu.customerproduct');
Route::post('/product/customer', [CustomerProductController::class, 'selectCategory'])->name('menu.customerproduct.select');
Route::get('/product/customer/{id}', [CustomerProductController::class, 'selectProduct'])->name('menu.customerproduct.product');
Route::post('/product/customer/message', [CustomerProductController::class, 'sendMessage'])->name('menu.customerproduct.message');
Route::get('/product/vendor', [VendorProductController::class, 'index'])->name('menu.vendorproduct');
Route::get('/product/vendor/{id}', [VendorProductController::class, 'selectProduct'])->name('menu.vendorproduct.product');
Route::get('/product/new', [VendorProductController::class, 'newProduct'])->name('menu.vendorproduct.new');
Route::post('/product/new', [VendorProductController::class, 'addProduct'])->name('menu.vendorproduct.add');
Route::get('/product/edit', [VendorProductController::class, 'edit'])->name('menu.vendorproduct.edit');
Route::get('/cart', [CartController::class, 'index'])->name('menu.cart');
Route::post('/cart/add', [CartController::class, 'buyProduct'])->name('menu.cart.add');
Route::post('/cart/pay', [CartController::class, 'payproduct'])->name('menu.cart.pay');
Route::post('/cart/remove', [CartController::class, 'removeProduct'])->name('menu.cart.remove');
