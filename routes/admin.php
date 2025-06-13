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
            //PROFILE
            Route::get('/profile/{id}',[Admin\AccountController::class,'profile'])->name('admin.profile');
            Route::post('/profile/edit/{id}',[Admin\AccountController::class,'editProfile'])->name('admin.profile');

        //PRODUCT
        Route::get('/product',[Admin\ProductController::class,'product'])->name('admin.product');
        Route::get('/product/showdata',[Admin\ProductController::class,'data'])->name('admin.product.data');
        Route::get('/product/edit/{id}',[Admin\ProductController::class,'showEdit'])->name('admin.product.editGet');
        Route::post('/product/edit/{id}',[Admin\ProductController::class,'postEdit'])->name('admin.product.editPost');
        Route::get('/product/view/{id}',[Admin\ProductController::class,'view'])->name('admin.product.view');
        Route::get('/product/delete/{id}',[Admin\ProductController::class,'delete'])->name('admin.product.delete');
        Route::post('/product/add',[Admin\ProductController::class,'add'])->name('admin.product.add');
                
        //SUPPLIER
        Route::get('/supplier',[Admin\SupplierController::class,'supplier'])->name('admin.supplier');
        Route::get('/supplier/showdata',[Admin\SupplierController::class,'data'])->name('admin.supplier.data');
        Route::get('/supplier/edit/{id}',[Admin\SupplierController::class,'showEdit'])->name('admin.supplier.editGet');
        Route::post('/supplier/edit/{id}',[Admin\SupplierController::class,'postEdit'])->name('admin.supplier.editPost');
        Route::get('/supplier/delete/{id}',[Admin\SupplierController::class,'delete'])->name('admin.supplier.delete');
        Route::post('/supplier/add',[Admin\SupplierController::class,'add'])->name('admin.supplier.add');

        //PRODUCT-TYPE
        Route::get('/product-type',[Admin\ProductTypeController::class,'index'])->name('admin.productType');
        Route::get('/product-type/showdata',[Admin\ProductTypeController::class,'data'])->name('admin.productType.data');
        Route::get('/product-type/edit/{id}',[Admin\ProductTypeController::class,'showEdit'])->name('admin.productType.editGet');
        Route::post('/product-type/edit/{id}',[Admin\ProductTypeController::class,'postEdit'])->name('admin.productType.editPost');
        Route::get('/product-type/delete/{id}',[Admin\ProductTypeController::class,'delete'])->name('admin.productType.delete');
        Route::post('/product-type/add',[Admin\ProductTypeController::class,'add'])->name('admin.productType.add');

        //CATEGORIES
        Route::get('/category',[Admin\CategoryController::class,'index'])->name('admin.category');
        Route::get('/category/showdata',[Admin\CategoryController::class,'data'])->name('admin.category.data');
        Route::get('/category/edit/{id}',[Admin\CategoryController::class,'showEdit'])->name('admin.category.editGet');
        Route::post('/category/edit/{id}',[Admin\CategoryController::class,'postEdit'])->name('admin.category.editPost');
        Route::get('/category/delete/{id}',[Admin\CategoryController::class,'delete'])->name('admin.category.delete');
        Route::post('/category/add',[Admin\CategoryController::class,'add'])->name('admin.category.add');

        //BRAND
        Route::get('/brand',[Admin\BrandController::class,'index'])->name('admin.brand');
        Route::get('/brand/showdata',[Admin\BrandController::class,'data'])->name('admin.brand.data');
        Route::get('/brand/edit/{id}',[Admin\BrandController::class,'showEdit'])->name('admin.brand.editGet');
        Route::post('/brand/edit/{id}',[Admin\BrandController::class,'postEdit'])->name('admin.brand.editPost');
        Route::get('/brand/delete/{id}',[Admin\BrandController::class,'delete'])->name('admin.brand.delete');
        Route::post('/brand/add',[Admin\BrandController::class,'add'])->name('admin.brand.add');
        
        
    });

    Route::middleware(['checkRole:2'])->group(function () {
       
    });
});


//SHIPPING
Route::get('/shipping',[Admin\RoleController::class,'shipping'])->name('admin.shipping');
Route::get('/shipping/showdata',[Admin\RoleController::class,'shippingData'])->name('admin.shipping.data');
Route::get('/shipping/edit/{id}',[Admin\RoleController::class,'getEditShipping'])->name('admin.shipping.editGet');

