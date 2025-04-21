<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::group(['middleware' => ['guest']], function(){
    Route::get('/login', [AuthController::class,'showLogin'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.post');
   
});

//CUSTOMER
Route::group(['middleware' => ['auth']], function(){
    Route::middleware(['checkRole:3'])->group(function () {
        
       
    });

    
 });

