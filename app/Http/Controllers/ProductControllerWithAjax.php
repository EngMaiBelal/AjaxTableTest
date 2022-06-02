<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductInvoice;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductControllerWithAjax extends Controller
{
    public function index(){
        return view('products-ajax.index');
    }
    public function create(){
        $products = Product::all();
        return view('products-ajax.create',compact('products'));
    }


    public function store(Request $request){

        $request->validate([
            'data.*.product'=>'required',
            'data.*.supplier'=>'required',
            'data.*.price'=>'required',
            'data.*.quantity'=>'required',
        ]);

        ProductInvoice::insert($request->data);
        return response()->json(['success'=>true,'message'=>'Product Created Successfully','request'=>$request->data],201);
    }

    function getSelectInput(Request $request)
    {
        $request->validate([
            'data.*.product'=>'required|exists:Product,id'
        ]);
        // $suppliers = Product::find(10)->suppliers; ???
        // 500 (Internal Server Error)
        // $suppliers = Product::findorfail(10)->suppliers;
        // 404

        $suppliers = Product::findorfail($request->product)->suppliers;
        // $options = "<option value='' selected> Choose The Suppliers</option>";
        $options = "";


        foreach($suppliers AS $supplier){
            $options .= "<option value='{$supplier->id}'> {$supplier->name}</option>";

        }
        if($options == ""){
            $options .= "<option value=''> No Supplier </option>";

        }
        return response()->json(['options'=>$options, 'success'=>true, 'suppliers'=>$suppliers  ]);
    }
}



