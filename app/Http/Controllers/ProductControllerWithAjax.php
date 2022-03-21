<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductControllerWithAjax extends Controller
{
    public function index(){
        return view('products-ajax.index');
    }
    public function create(){
        return view('products-ajax.create');
    }
    public function store(Request $request){
        // $productValid= $request->validate([
        //     'name'=>'required',
        //     'price'=>'required',
        //     'quantity'=>'required',

        // ]);
        return response()->json($request->all());
        $product = Product::create($request->all());

        if($product){
            return response()->json([
                'status'=> true,
                'msg'=> 'Save Success',
            ]);
        }else{
            return response()->json([
                'status'=> false,
                'msg'=> 'Save Failed',
            ]);
        }
    }
}



