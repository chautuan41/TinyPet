<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

// use App\Http\Middleware\CheckRole;

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



Route::group(['middleware' => ['auth']], function(){
   
   Route::middleware(['checkRole:1'])->group(function () {
        // Route::get('/',[Admin\HomeController::class,'index'])->name('admin');
        Route::get('/',[Admin\HomeController::class,'index'])->name('admin.index');
        Route::get('/role',[Admin\RoleController::class,'role'])->name('admin.role');
        Route::get('/role/showdata',[Admin\RoleController::class,'roleData'])->name('admin.role.data');
        Route::get('/role/edit/{id}',[Admin\RoleController::class,'getEditRole'])->name('admin.role.editGet');
    });
    
    
});

