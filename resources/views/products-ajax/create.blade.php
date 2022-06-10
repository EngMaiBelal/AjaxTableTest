@extends('layouts.parent')
@section('title', 'Create Products')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .errorTxt{
            border: 1px solid red;
            min-height: 20px;
        }
    </style>
@endsection
@section('content')
<div class="col-12 text-center text-dark">
    <h1>Create Products</h1>
</div>

<div class="col-12">
    <div id="divTable">
            <form action="" id="product-form" name="form-reg">

                <div id="general-error" class="text-danger font-weight-bold">
                </div>

                <table class="table" id="Table">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Supplier</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Delete</td>
                            <td>Add Rows</td>
                        </tr>
                    </thead>
                    <tbody id="tbody" name="tbody">

                        {{-- -------------------------------------------------------------- --}}
                        <tr class="data">
                            <td scope="row" class="th-btn-custom-remove">
                                <span id="span-count">1</span>
                            </td>
                            <td>
                                {{-- <select class="form-select product m-2" id="all-product-immediately" name="data[0]product"> --}}
                                    <select class="form-select product m-2 select-custom" number="0" id="product0" name="data[0][product]" onchange="getSuppliers(this)" required>
                                    <option selected disabled>Choose Products</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                <div id="data.0.product" class="text-danger font-weight-bold error-product">

                                </div>
                            </td>
                            <td>
                                <select  class="form-select supplier m-2" id="supplier0" data="0" name="data[0][supplier]" required>
                                </select>
                                <div id="data.0.supplier" class="text-danger font-weight-bold error-supplier">
                                </div>
                            </td>
                            <td>
                                <input class="form-control quantity" type="number" name="data[0][quantity]" required/>
                                <div id="data.0.quantity" class="text-danger font-weight-bold error-quantity">
                                </div>
                            </td>
                            <td>
                                <input class="form-control price" type="number" name="data[0][price]" required/>
                                <div id="data.0.price" class="text-danger font-weight-bold error-price">
                                </div>
                            </td>

                            <td><input type="button" class="btn btn-danger buttonDel" id="delbut[1]" value="Delete"
                                    onclick="delRow(this)" /></td>
                            <td><input type="button" class="btn btn-success" id="addbut" value="Add More"
                                    onclick="appendRow()" /></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary" id="create-product"> Create Products </button>
            </form>
        </div>
    </div>
@endsection

@section('js')


    <!-- select2 -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}

    <!-- jqueryLink for ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- My Ajax Files -->
    <script src="{{ asset('js/getSupplier.js') }}" url="{{ route('products.ajax.get.supplier') }}"></script>
    <!-- My ScriptFile -->
    <script src="{{ asset('js/createProductScript.js') }}"></script>

    <script type="text/javascript">



        $(document).on('click', '#create-product', function(event) {
            event.preventDefault();
            let data = [];
            $(".data").map(function(index, currentValue) {
                data.push({
                    'product': $('select[name="data[' + (index) + '][product]"]').val(),
                    'supplier': $('select[name="data[' + (index) + '][supplier]"]').val(),
                    'price': $('input[name="data[' + (index) + '][price]"]').val(),
                    'quantity': $('input[name="data[' + (index) + '][quantity]"]').val(),
                });
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    "Accept": "application/json"
                },
                method: "POST",
                url: "{{ Route('products.ajax.store') }}",
                data: {
                    "data": data
                },
                success: function(data) {
                    if (data.success == true) {
                        console.log(data);
                        resetTable();
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        console.log(key,val,response.errors);
                        $('div[id="' + key + '"]').html(val[0]);
                    });
                },
            });
        });



    </script>
@endsection


