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
        $products = Product::all();
        $options = "";
        foreach($products AS $product){
            $options .= "<option value='$product->id'> $product->name </option>";
        }
        return response()->json(['options'=>$options]);
        // $request->validate([
        //     'data'=>'array:name,price,quantity',
        //     'data.*.name'=>'required',
        //     'data.*.price'=>'required',
        //     'data.*.quantity'=>'required',
        // ]);
        // return response()->json($request->all());
        // $product = Product::insert($request->all()['data']);

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
    }
}



