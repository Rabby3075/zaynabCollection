<?php

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
    });
});
