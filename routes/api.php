<?php

use App\Http\Controllers\Product\ProductDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/product-category', [ProductDetailsController::class, 'getProductCategory']);
Route::get('/product-color', [ProductDetailsController::class, 'getColor']);
Route::get('/product-size', [ProductDetailsController::class, 'getSizes']);
