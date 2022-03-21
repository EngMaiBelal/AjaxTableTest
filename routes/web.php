<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductControllerWithAjax;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'/products', 'as' =>'products.'],function(){

    Route::get('/create-product', [ProductController::class,'create'])->name('create');
    Route::post('/store-product', [ProductController::class,'store'])->name('store');

});

Route::group(['prefix'=>'/products/ajax', 'as' =>'products.ajax.'],function(){
    Route::get('/all-products', [ProductControllerWithAjax::class,'index'])->name('index');
    Route::get('/create-product', [ProductControllerWithAjax::class,'create'])->name('create');
    // Route::post('/store-product', [ProductControllerWithAjax::class,'store'])->name('store');
});

