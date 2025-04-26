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
        //ADMIN
        Route::get('/',[Admin\HomeController::class,'index'])->name('admin.index');

        //ROLE
        Route::get('/role',[Admin\RoleController::class,'role'])->name('admin.role');
        Route::get('/role/showdata',[Admin\RoleController::class,'data'])->name('admin.role.data');
        Route::get('/role/edit/{id}',[Admin\RoleController::class,'showEdit'])->name('admin.role.editGet');
        Route::post('/role/edit/{id}',[Admin\RoleController::class,'postEdit'])->name('admin.role.editPost');
        Route::post('/role/add',[Admin\RoleController::class,'add'])->name('admin.role.add');
        Route::get('/role/delete/{id}',[Admin\RoleController::class,'delete'])->name('admin.role.delete');

        //ACCOUNT
        Route::get('/account',[Admin\AccountController::class,'account'])->name('admin.account');
        Route::get('/account/showdata',[Admin\AccountController::class,'data'])->name('admin.account.data');
        Route::get('/account/edit/{id}',[Admin\AccountController::class,'showEdit'])->name('admin.account.editGet');
        Route::post('/account/edit/{id}',[Admin\AccountController::class,'postEdit'])->name('admin.account.editPost');
        Route::get('/account/view/{id}',[Admin\AccountController::class,'view'])->name('admin.account.view');
        Route::get('/account/delete/{id}',[Admin\AccountController::class,'delete'])->name('admin.account.delete');

        
        
    });

    Route::middleware(['checkRole:2'])->group(function () {
       
    });
});



//PRODUCT
Route::get('/product',[Admin\ProductController::class,'product'])->name('admin.product');
Route::get('/product/showdata',[Admin\ProductController::class,'productData'])->name('admin.product.data');
Route::get('/product/edit/{id}',[Admin\ProductController::class,'showEdit'])->name('admin.product.editGet');
Route::post('/product/edit/{id}',[Admin\ProductController::class,'postEdit'])->name('admin.product.editPost');
Route::get('/product/view/{id}',[Admin\ProductController::class,'view'])->name('admin.product.view');
Route::get('/product/delete/{id}',[Admin\ProductController::class,'delete'])->name('admin.product.delete');
Route::post('/product/add',[Admin\ProductController::class,'add'])->name('admin.product.add');

//SUPPLIER
Route::get('/supplier',[Admin\SupplierController::class,'supplier'])->name('admin.supplier');
Route::get('/supplier/showdata',[Admin\SupplierController::class,'supplierData'])->name('admin.supplier.data');
Route::get('/rosupplierle/edit/{id}',[Admin\SupplierController::class,'getEditSupplier'])->name('admin.supplier.editGet');

//SHIPPING
Route::get('/shipping',[Admin\RoleController::class,'shipping'])->name('admin.shipping');
Route::get('/shipping/showdata',[Admin\RoleController::class,'shippingData'])->name('admin.shipping.data');
Route::get('/shipping/edit/{id}',[Admin\RoleController::class,'getEditShipping'])->name('admin.shipping.editGet');
