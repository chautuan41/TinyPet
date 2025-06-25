<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VnPayController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[HomeController::class,'index'])->name('user.index');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/search',[HomeController::class,'search'])->name('user.search');
Route::get('/search-get',[HomeController::class,'getSearch'])->name('user.search.get');
Route::get('/search-result',[HomeController::class,'postSearch'])->name('user.search.post');

Route::get('/product/{id}',[HomeController::class,'detailProduct'])->name('user.detailProduct');
Route::get('/product',[HomeController::class,'product'])->name('user.product');

Route::get('/cart',[CartController::class,'cart'])->name('user.cart');
Route::post('/cart',[CartController::class,'addCart'])->name('user.cart.add');
Route::get('/clear-cart', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout',[HomeController::class,'checkout'])->name('user.checkout');

Route::group(['middleware' => ['guest']], function(){
    Route::get('/login', [AuthController::class,'showLogin'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.post');
   
});

//CUSTOMER
Route::group(['middleware' => ['auth']], function(){
    Route::middleware(['checkRole:3'])->group(function () {
        
       
    });

    
 });
Route::get('/payment', function () {
    return view('user.pages.payment');
});
Route::post('/vnpay/payment', [VnPayController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/vnpay/return', [VnPayController::class, 'vnpayReturn'])->name('vnpay.return');