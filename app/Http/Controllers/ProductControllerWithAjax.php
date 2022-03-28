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
    // public function store(Request $request){
        // $productValid= $request->validate([
        //     'name.*'=>'required',
        //     'price.*'=>'required',
        //     'quantity.*'=>'required',
        // ]);
        // return response()->json($productValid);
        // return response()->json($request->all());
        // $product = Product::create($request->all());

        // if($product){
        //     return response()->json([
        //         'status'=> true,
        //         'msg'=> 'Save Success',
        //     ]);
        // }else{
        //     return response()->json([
        //         'status'=> false,
        //         'msg'=> 'Save Failed',
        //     ]);
        // }
    // }

    public function store(Request $request){

        $request->validate([
            // 'data'=>'array:name,price,quantity', //return object
            'data.*.name'=>'required',
            'data.*.price'=>'required',
            'data.*.quantity'=>'required',
        ]);
        $products = Product::all();
        // return response()->json($products);
        // return response()->json($request->all());
        // dd($products); internal server error 500

        $options = "";

        if($products){
            foreach($products AS $product){
                $options .= "<option value='$product->id'> $product->name </option>";
            }
            return response()->json(['options'=>$options, 'status'=>true ]);

        }else{
            return response()->json([

                'options'=> $options,
                'status'=> false
            ]);
        }
        // $product = Product::insert($request->all()['data']);
    }
}



