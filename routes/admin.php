<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;
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

Route::group(['middleware' => ['guest']], function(){
    Route::get('/login', [Backend\AuthController::class,'login'])->name('login');
    Route::get('/login', [Backend\AuthController::class,'login'])->name('auth.login.post');
    
});

Route::group(['middleware' => ['auth']], function(){
   
    Route::get('/', function () {
        return view('welcome');
    });
});
