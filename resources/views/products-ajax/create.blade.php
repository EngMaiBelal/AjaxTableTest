@extends('layouts.parent')
@section('title', 'Create Products')

@section('content')

    <div class="col-12 text-center text-dark">
        <h1>Create Products</h1>
    </div>

    <div class="col-12">
        <div id="divTable">
            <form action="" id="product-form">
                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                <table class="table" id="Table">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Delete</td>
                            <td>Add Rows</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input class="form-control name" type="text" name="name[1]" id="name" /></td>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <td><input class="form-control price" type="number" name="price[1]" id="price" /></td>
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <td><input class="form-control quantity" type="number" name="quantity[1]" id="quantity" /></td>
                            @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <td><input type="button" class="btn btn-danger" id="delbut" value="Delete"
                                    onclick="delRow(this)" /></td>
                            <td><input type="button" class="btn btn-success" id="addbut" value="Add More"
                                    onclick="addRow()" /></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary" id="create-product"> Create Products </button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    {{-- query for ajax --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function delRow(row) {
            let i = row.parentNode.parentNode.rowIndex;
            if (row.parentNode.parentNode.parentNode.rows.length != 1) {
                document.getElementById('Table').deleteRow(i);
            }
        }

        function addRow() {
            let tablePro = document.getElementById('Table');
            let newRow = tablePro.rows[1].cloneNode(true);
            let len = tablePro.rows.length;
            let cellLen = newRow.cells.length;
            newRow.cells[0].innerHTML = len;


            var inp1 = newRow.cells[1].getElementsByTagName('input')[0];
            var inp2 = newRow.cells[2].getElementsByTagName('input')[0];
            var inp3 = newRow.cells[3].getElementsByTagName('input')[0];

            // for(let i=1; 0<i<cellLen-3; i++){
            //         (inp+i).name = ((inp+i).name.replace('[1]', '[' + len + ']'));
            //         (inp+i).id += len;
            //         (inp+i).value = '';
            // }

            inp1.name = (inp1.name.replace('[1]', '[' + len + ']'));
            inp1.id += len;
            inp1.value = '';

            inp2.name = (inp2.name.replace('[1]', '[' + len + ']'));
            inp2.id += len;
            inp2.value = '';

            inp3.name = (inp3.name.replace('[1]', '[' + len + ']'));
            inp3.id += len;
            inp3.value = '';

            tablePro.appendChild(newRow);
        }
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#create-product', function(event) {
                // var formData = new FormData(product-form);
                event.preventDefault();
                let data = [];
                $(".name").map(function(index, currentValue){
                    data.push({
                        'name':$('input[name="name['+(index+1)+']"]').val(),
                        'price':$('input[name="price['+(index+1)+']"]').val(),
                        'quantity':$('input[name="quantity['+(index+1)+']"]').val(),
                    });
                });
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                        //     // "Content-Type":"multipart/form-data; boundary=<calculated when request is sent>",
                        //     // "Connection":"keep-alive",
                            "Accept":"application/json"
                    },
                    // type:'POST',
                    method: "POST",
                    url: '{{ Route('products.ajax.store') }}',
                    // async:false,
                    data: {
                        "data":data
                    },
                    success: function(data) {
                        console.log("data");
                        // console.log(data);
                        if (data.status == true) {
                            $('#success_msg').show();
                        }
                    },
                    error: function(reject) {
                        console.log(reject);
                        // var response = $.parseJSON(reject.responseText);

                        //         $.each(response.errors, function (key, val) {
                        //             $("#" + key + "_error").text(val[0]);
                        //         });

                    },
                    // processData:false,
                    // contentType:false,
                    // cashe:false,


                });
            });
        });
    </script>
@endsection
{{-- for loop??? --}}
{{-- ajax //@csrf//input invalid //array? --}}
{{-- multidimensional --}}
{{-- https://forum.jquery.com/topic/passing-php-multidimensional-array-to-ajax --}}
