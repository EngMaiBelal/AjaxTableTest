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

        $request->validate([
            'data.*.name'=>'required',
            'data.*.price'=>'required',
            'data.*.quantity'=>'required',
        ]);
        Product::insert($request->data);
        return response()->json(['success'=>true,'message'=>'Product Created Successfully'],201);

        }


    function getSelect()
    {
        $products = Product::all();


        $options = "";

        foreach($products AS $product){
            $options .= "<option value='{$product->id}'> {$product->name}</option>";
        }
        
        return response()->json(['options'=>$options, 'success'=>true ]);


    }
}



