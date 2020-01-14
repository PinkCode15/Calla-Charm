<?php

use App\Http\Controllers\myAuth\MyLoginController;
use App\Http\Controllers\myAuth\MyRegisterController;
use App\Http\Controllers\myAuth\EmailTokenController;
use App\Http\Controllers\myAuth\PhoneTokenController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\MenuItems\WalletController;
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
Route::post('/wallet', [WalletController::class, 'fund'])->name('wallet.fund');
Route::get('/wallet/verify', [WalletController::class, 'verifyFund'])->name('wallet.verify');


