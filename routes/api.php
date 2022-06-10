<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductControllerWithAjax;

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

Route::group(['prefix'=>'/products/ajax', 'as' =>'products.ajax.'],function(){
    Route::post('/store-product', [ProductControllerWithAjax::class,'store'])->name('store');
    Route::get('/get-select', [ProductControllerWithAjax::class,'getSelect'])->name('get-select');
    Route::get('/get-supplier', [ProductControllerWithAjax::class,'getSelectInput'])->name('get.supplier');
});
// /products/ajax/store-product
