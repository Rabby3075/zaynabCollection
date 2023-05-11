<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductDetailsController;
use Illuminate\Support\Facades\Route;
/*---------Controller----------*/
use App\Http\Controllers\AdminController;
/*---------Controller----------*/


Route::get('/', function () { return view('Admin.Dashboard.Main.main');});

Route::fallback(function () {return view('Error.404');});
Route::group(['name' => 'Admin'], function() {

    Route::group(['name' => 'Authentication'], function() {
        Route::get('/admin/login',[AdminController::class, 'loginView'])->name('AdminLoginView');
        Route::get('/admin/logout',[AdminController::class, 'logout'])->name('AdminLogout');
        Route::post('/admin/login/submit',[AdminController::class, 'login'])->name('AdminLogin');
        Route::get('/admin/otp',[AdminController::class, 'OtpView'])->name('OtpView');
        Route::post('/verify-otp',[AdminController::class, 'verifyOtp'])->name('verifyOtp');
    });

    Route::group(['name' => 'Dashboard','middleware' => 'AdminValid'], function() {
        Route::get('/admin-log',[AdminController::class, 'logHistory'])->name('logHistory');
        Route::group(['name' => 'Main'], function() {
            Route::get('/admin-home',[AdminController::class, 'Homepage'])->name('Homepage');
        });
        Route::group(['name' => 'Company'], function() {
            Route::get('/company-controller',[CompanyController::class, 'companyView'])->name('companyView');
            Route::post('/company-management',[CompanyController::class, 'companyManagement'])->name('companyManagement');
        });

        Route::group(['name' => 'ProductCategory'], function() {
            Route::get('/add-product-category',[ProductCategoryController::class, 'addProductCategoryView'])->name('addProductCategoryView');
            Route::get('/product-category-list',[ProductCategoryController::class, 'productCategoryList'])->name('productCategoryList');
            Route::post('/add-product-category-post',[ProductCategoryController::class, 'addProductCategory'])->name('addProductCategory');
            Route::get('/get-product-category-info/{id}',[ProductCategoryController::class,'getProductCategoryInfo'])->name('getProductCategoryInfo');
            Route::post('/product-category-delete',[ProductCategoryController::class,'deleteProductCategory'])->name('deleteProductCategory');
            Route::post('/product-category-update',[ProductCategoryController::class,'editProductCategory'])->name('editProductCategory');
        });
        Route::group(['name' => 'Product Details'], function() {
            Route::get('/add-product-details',[ProductDetailsController::class, 'addProductDetailsView'])->name('addProductDetailsView');
            Route::get('/product-list',[ProductDetailsController::class, 'productList'])->name('productList');
            Route::post('/add-product',[ProductDetailsController::class, 'addProductDetails'])->name('addProductDetails');
            Route::post('/delete-product',[ProductDetailsController::class, 'productDelete'])->name('productDelete');
            Route::post('/update-product',[ProductDetailsController::class, 'editProduct'])->name('editProduct');
            Route::get('/get-product-info/{id}',[ProductDetailsController::class,'getProductDetailsInfo'])->name('getProductDetailsInfo');
        });

    });
});

Route::group(['name' => 'Authentication'], function() {
    Route::get('/customer-registration',[CustomerController::class, 'registrationView'])->name('registrationView');
});
