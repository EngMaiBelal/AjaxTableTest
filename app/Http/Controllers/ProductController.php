<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function create(){

        return view('products.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'price'=>'required|number',
            'quantity'=>'required|number',

        ]);

        Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,

        ]);
        return view('products.create')->with('product created succesfully');

    }



    // public function index(){
    //     return view('products.index');
    // }

    // public function edit(){
    //     return view('products.edit');
    // }
    // public function update(){
    //     // return view('products.index');

    // }
    // public function destroy($id){
    //     Product::destroy($id);
    //     return view('products.index');
    // }


    // Route::get('/all-products', [ProductController::class,'index'])->name('index');
    // Route::post('/destroy/{$id}', [ProductController::class,'destroy'])->name('destroy');
    // Route::get('/edit-product/{$id}', [ProductController::class,'edit'])->name('edit');
    // Route::post('/update-product', [ProductController::class,'update'])->name('update');

}
