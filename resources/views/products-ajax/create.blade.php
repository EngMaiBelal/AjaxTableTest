@extends('layouts.parent')
@section('title','Create Products')

@section('content')

    <div class="col-12 text-center text-dark">
        <h1>Create Products</h1>
    </div>
    <select id="optionProduct">

    </select>
    {{-- last error only  , the name of field , exist all the time--}}
    <div id="name_error" class=" form-text text-danger"> </div>
    <div id="price_error" class=" form-text text-danger"> </div>
    <div id="quantity_error" class=" form-text text-danger"> </div>

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
                        <tr class="data">
                            <td>1</td>

                            <td><input class="form-control name" type="text" name="data[1]name" id="name" /></td>
                            <td><input class="form-control price" type="number" name="data[1]price" id="price" /></td>
                            <td><input class="form-control quantity" type="number" name="data[1]quantity" id="quantity" /></td>

                            <td><input type="button" class="btn btn-danger" id="delbut" value="Delete" onclick="delRow(this)" /></td>
                            <td><input type="button" class="btn btn-success" id="addbut" value="Add More" onclick="addRow()" /></td>

                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary" id="create-product"> Create Products </button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    {{-- jqueryLink for ajax --}}
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
            let cellLen=newRow.cells.length;
            newRow.cells[0].innerHTML = len;


            var inp1 = newRow.cells[1].getElementsByTagName('input')[0];
            var inp2 = newRow.cells[2].getElementsByTagName('input')[0];
            var inp3 = newRow.cells[3].getElementsByTagName('input')[0];
            // concate the name  not value
            // for(let i=1; 0 <i< cellLen-3; i++){
                // this["inp"+i] = newRow.cells[i].getElementsByTagName('input')[0];
                // this["marker"+i] = "some stuff";

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
        $( document ).ready(function() {
            $(document).on('click', '#create-product',function(event){
                // var formData = new FormData(product-form);
                event.preventDefault();
                let data = [];
                $(".data").map(function(index, currentValue){
                    data.push({
                        'name':$('input[name="data['+(index+1)+']name"]').val(),
                        'price':$('input[name="data['+(index+1)+']price"]').val(),
                        'quantity':$('input[name="data['+(index+1)+']quantity"]').val(),
                    });
                });


                console.log(typeof(data));
                $.ajax({

                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                        "Accept":"application/json"
                        // "Content-Type":"multipart/form-data; boundary=<calculated when request is sent>",
                        // "Connection":"keep-alive",
                    },
                    // type:'POST',
                    method:"POST",
                    url:'{{ Route('products.ajax.store') }}',
                    // async:false,
                    data:{
                        "data":data
                        // '_token':'{{ csrf_token() }}',
                        // '_token': @json(csrf_token()),
                        // "_token": $('#csrf-token')[0].content,

                        // $('tagname[attrname="...."]').val()
                        // 'name[]': $("input[class='name']").val(), //first row only
                        // 'name[]': $(".name").val(),
                        // 'price[]': $(".price").val(),
                        // 'quantity': $(".quantity").val(),
                        // 'dataTest':"test"
                    },
                    success:function(data){
                        console.log(data.options);
                        if (data.status == true) {
                            // $("#option_product").html(data.options);
                            // $('#option_product').append(data.options);
                            var response =$.parseJSON(data);
                            document.getElementById("option_product").innerHTML =response.options;
                            // $('#success_msg').show();
                        }
                        // 32
                    },
                    error:function(reject){
                        console.log("reject");
                        //return message, errors
                        var response = $.parseJSON(reject.responseText);
                                $.each(response.errors, function (key, val) {
                                    // console.log($("#" + key + "_error"));

                                    var key_update= key.slice(7)
                                    $("#" + key_update + "_error").text(val[0]);


                                });
                    },

                    // https://stackoverflow.com/questions/28225885/laravel-ajax-output-json-error-messages
                    //   success: function (json) {
                    //     // clear inputs
                    //         $('#name,#message,#email').val('');
                    //         // append success message
                    //         $( "#success" ).append(json.message );
                    //     },
                    //     error: function (jqXHR, json) {
                    //         $( "#errors" ).append(json.errors );
                    // }

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






