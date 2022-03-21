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
    // Route::get('/all-products', [ProductControllerWithAjax::class,'index'])->name('index');
    // Route::get('/create-product', [ProductControllerWithAjax::class,'create'])->name('create');
    Route::post('/store-product', [ProductControllerWithAjax::class,'store'])->name('store');
});