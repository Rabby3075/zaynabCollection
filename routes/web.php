<?php

use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductDetailsController;
use Illuminate\Support\Facades\Route;
/*---------Controller----------*/
use App\Http\Controllers\AdminController;
/*---------Controller----------*/


Route::get('/', function () { return view('Admin.Dashboard.Main.main');});


Route::group(['name' => 'Admin'], function() {

    Route::group(['name' => 'Authentication'], function() {
        Route::get('/admin/login',[AdminController::class, 'loginView'])->name('AdminLoginView');
        Route::post('/admin/login/submit',[AdminController::class, 'login'])->name('AdminLogin');
    });

    Route::group(['name' => 'Dashboard','middleware' => 'AdminValid'], function() {

        Route::group(['name' => 'Main','middleware' => 'AdminValid'], function() {
            Route::get('/admin-home',[AdminController::class, 'Homepage'])->name('Homepage');
        });


        Route::group(['name' => 'ProductCategory','middleware' => 'AdminValid'], function() {
            Route::get('/add-product-category',[ProductCategoryController::class, 'addProductCategoryView'])->name('addProductCategoryView');
            Route::get('/product-category-list',[ProductCategoryController::class, 'productCategoryList'])->name('productCategoryList');
            Route::post('/add-product-category-post',[ProductCategoryController::class, 'addProductCategory'])->name('addProductCategory');
            Route::get('/get-product-category-info/{id}',[ProductCategoryController::class,'getProductCategoryInfo'])->name('getProductCategoryInfo');
            Route::post('/product-category-delete',[ProductCategoryController::class,'deleteProductCategory'])->name('deleteProductCategory');
            Route::post('/product-category-update',[ProductCategoryController::class,'editProductCategory'])->name('editProductCategory');
        });
        Route::group(['name' => 'Product Details','middleware' => 'AdminValid'], function() {
            Route::get('/add-product-details',[ProductDetailsController::class, 'addProductDetailsView'])->name('addProductDetailsView');
            Route::post('/add-product',[ProductDetailsController::class, 'addProductDetails'])->name('addProductDetails');
        });

    });
});
