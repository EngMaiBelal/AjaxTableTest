@extends('layouts.header')
@section('title','Show Product')

@section('content')
    <div class="col-12 text-center text-dark">
        <h1>Show Products</h1>
    </div>
    <div class="col-12">

        <table class="table" id="Table">
            <thead>
                <td>
                    <tr>#</tr>
                    <tr>Name</tr>
                    <tr>Price</tr>
                    <tr>Quantity</tr>
                </td>
            </thead>
            <tbody>
                <td>
                    {{-- <tr>{{ $product->id }}</tr>
                    <tr>{{ $product->name }}</tr>
                    <tr>{{ $product->price }}</tr>
                    <tr>{{ $product->quantity }}</tr> --}}
                </td>
            </tbody>

        </table>
    </div>
@endsection



