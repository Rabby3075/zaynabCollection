<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Product\colorController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductDetailsController;
use App\Http\Controllers\Product\SizeController;
use Illuminate\Support\Facades\Route;
/*---------Controller----------*/
use App\Http\Controllers\AdminController;
/*---------Controller----------*/


Route::get('/',[CustomerController::class, 'customer_dashboard'])->name('customer_dashboard');

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
        Route::group(['name' => 'ProductDetails'], function() {
            Route::get('/add-product-details',[ProductDetailsController::class, 'addProductDetailsView'])->name('addProductDetailsView');
            Route::get('/product-list',[ProductDetailsController::class, 'productList'])->name('productList');
            Route::post('/add-product',[ProductDetailsController::class, 'addProductDetails'])->name('addProductDetails');
            Route::post('/delete-product',[ProductDetailsController::class, 'productDelete'])->name('productDelete');
            Route::post('/update-product',[ProductDetailsController::class, 'editProduct'])->name('editProduct');
            Route::get('/get-product-info/{id}',[ProductDetailsController::class,'getProductDetailsInfo'])->name('getProductDetailsInfo');
        });
        Route::group(['name' => 'color'], function() {
            Route::get('/add-color',[colorController::class, 'colorView'])->name('colorView');
            Route::post('/add-color-post',[colorController::class, 'addColor'])->name('addColor');
            Route::get('/color-list',[colorController::class, 'colorList'])->name('colorList');
            Route::get('/get-color-info/{id}',[colorController::class,'getColorInfo'])->name('getColorInfo');
            Route::post('/delete-color',[colorController::class,'deleteColor'])->name('deleteColor');
            Route::post('/update-color',[colorController::class,'updateColor'])->name('updateColor');
        });
        Route::group(['name' => 'size'], function() {
            Route::get('/add-size',[SizeController::class, 'sizeView'])->name('sizeView');
            Route::post('/add-size-post',[SizeController::class, 'addSize'])->name('addSize');
            Route::get('/size-list',[SizeController::class, 'sizeList'])->name('sizeList');
            Route::get('/get-size-info/{id}',[SizeController::class,'getSizeInfo'])->name('getSizeInfo');
            Route::post('/delete-size',[SizeController::class,'deleteSize'])->name('deleteSize');
            Route::post('/update-size',[SizeController::class,'updateSize'])->name('updateSize');
        });

    });
});

Route::group(['name' => 'user'], function() {
    Route::group(['name' => 'Customer-Authentication'], function() {
        Route::get('/customer-registration',[CustomerController::class, 'registrationView'])->name('registrationView');
        Route::post('/customer-registration',[CustomerController::class, 'registration'])->name('registration');
        Route::get('/customer-login',[CustomerController::class, 'loginView'])->name('loginView');
        Route::get('/customer-opt',[CustomerController::class, 'otpView'])->name('otpView');
        Route::post('/customer-login',[CustomerController::class, 'login'])->name('login');
        Route::get('/customer-logout',[CustomerController::class, 'logout'])->name('logout');
    });
    Route::group(['name' => 'socialite'], function() {
        Route::get('authorized/{provider}', [CustomerController::class, 'redirectToSocialite']);
        Route::get('authorized/{provider}/callback', [CustomerController::class, 'handleSocialiteCallback']);
    });

    Route::group(['name' => 'productView'], function() {
        Route::get('/product-summary/{id}',[ProductDetailsController::class,'getProductDetailsInfo'])->name('productSummary');
    });

    Route::group(['name' => 'customer-otp','middleware' => 'auth'], function() {
        Route::get('/customer-otp',[CustomerController::class, 'otpView'])->name('otpView');
        Route::post('/customer-otp',[CustomerController::class, 'otpSubmit'])->name('otpSubmit');
        Route::get('/customer-otp-resend',[CustomerController::class, 'ResendOtp'])->name('ResendOtp');
    });

});


