@extends('layouts.parent');
@section('name','Update Product')
@section('content')
    <div class="col-12 text-center text-dark">
        <h1>Edit Products</h1>
    </div>
    <form method="" action="">
        <div class="form-group">
          <label for="nameInput">Name</label>
            @error('name')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror
          <input type="text" class="form-control" id="nameInput" placeholder="Enter name" name="name">
        </div>
        <div class="form-group">
            <label for="priceInput">Price</label>
                @error('price')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
            <input type="number" class="form-control" id="priceInput" placeholder="Enter price" name="price">
          </div>
          <div class="form-group">
            <label for="quantityInput">Quantity</label>
                @error('quantity')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
            <input type="number" class="form-control" id="quantityInput" placeholder="Enter quantity" name="quantity">
          </div>

        <button type="submit" class="btn btn-primary"> Edit Product </button>
    </form>
@endsection












