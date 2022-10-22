<?php

use Illuminate\Support\Facades\Route;
/*---------Controller----------*/
use App\Http\Controllers\AdminController;
/*---------Controller----------*/


Route::get('/', function () { return view('welcome');});

/*-----------Admin-----------------*/
Route::get('/admin/login',[AdminController::class, 'loginView'])->name('AdminLoginView');
Route::post('/admin/login/submit',[AdminController::class, 'login'])->name('AdminLogin');
Route::get('/admin/home',function () { return view('Admin.Dashboard.Home');})->name('AdminHome')->middleware('AdminValid');
/*-----------Admin-----------------*/
