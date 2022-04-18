@extends('layouts.parent')
@section('title', 'Create Products')

@section('content')

    <div class="col-12 text-center text-dark">
        <h1>Create Products</h1>
    </div>

    <div class="col-12">
        <div id="divTable">
            <form action="" id="product-form">
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
                            <td>1</td>
                            <td>
                                {{-- <select class="form-select product m-2" id="all-product-immediately" name="data[0]product"> --}}
                                    <select class="form-select product m-2 select-custom" number="0" id="product0" name="data[0]product" onchange="getSuppliers(this)">
                                    <option selected>Choose Products</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                <div id="data.0.product" class="text-danger font-weight-bold">

                                </div>
                            </td>
                            <td>
                                <select  class="form-select supplier m-2" id="supplier0" data="0" name="data[0]supplier">
                                </select>
                                <div id="data.0.supplier" class="text-danger font-weight-bold">
                                </div>
                            </td>
                            <td>
                                <input class="form-control quantity" type="number" name="data[0]quantity" />
                                <div id="data.0.quantity" class="text-danger font-weight-bold">
                                </div>
                            </td>
                            <td>
                                <input class="form-control price" type="number" name="data[0]price" />
                                <div id="data.0.price" class="text-danger font-weight-bold">
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
    {{-- jqueryLink for ajax --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">


        var tablePro = document.getElementById('Table');
        var tbody = document.getElementById('tbody');

        function delRow(row) {
            let i = row.parentNode.parentNode.rowIndex;
            // if (row.parentNode.parentNode.parentNode.rows.length != 1) {
                if(i != 1){
                document.getElementById('Table').deleteRow(i);
                }
            // }
        }

        var count= 1;
        function addRow(forcedLength, childName) {
            //forcedLength to solve table when reset
            let newRow = tablePro.rows[1].cloneNode(true);
            let len = tablePro.rows.length;
            newRow.cells[0].innerHTML = forcedLength ? 1 : len;
            let newLength = forcedLength ? 0 : len - 1 ;

            var inpDel =newRow.cells[4].getElementsByTagName('input')[0];
            inpDel.id = (inpDel.id.replace('[1]', '[' + count + ']'));


            var inp1 = newRow.cells[1].getElementsByTagName('select')[0];
            let attrNumber = (Number(inp1.getAttribute('number'))+ count);
            inp1.id = (inp1.id.replace('0', count ));
            inp1.name = (inp1.name.replace('[0]', '[' + count + ']'));
            inp1.value = '';
            inp1.setAttribute("number", attrNumber);

            var inp2 = newRow.cells[2].getElementsByTagName('select')[0];
            let attrData = (Number(inp2.getAttribute('data'))+ count);
            inp2.id = (inp2.id.replace('0', count));
            inp2.name = (inp2.name.replace('[0]', '[' + count + ']'));
            inp2.value = '';
            inp2.setAttribute("data", attrData);

            var inp3 = newRow.cells[3].getElementsByTagName('input')[0];
            var inp4 = newRow.cells[4].getElementsByTagName('input')[0];

            inp3.name = (inp3.name.replace('[0]', '[' + count + ']'));
            inp3.value = '';
            inp4.name = (inp4.name.replace('[0]', '[' + count + ']'));
            inp4.value = '';

            var errorDiv1 = newRow.cells[1].getElementsByTagName('div')[0];
            var errorDiv2 = newRow.cells[2].getElementsByTagName('div')[0];
            var errorDiv3 = newRow.cells[3].getElementsByTagName('div')[0];
            var errorDiv4 = newRow.cells[4].getElementsByTagName('div')[0];
            errorDiv1.id = (errorDiv1.id.replace('.0.', '.' + count + '.'));
            errorDiv1.innerHTML = '';
            errorDiv2.id = (errorDiv2.id.replace('.0.', '.' + count + '.'));
            errorDiv2.innerHTML = '';
            errorDiv3.id = (errorDiv3.id.replace('.0.', '.' + count + '.'));
            errorDiv3.innerHTML = '';
            errorDiv4.id = (errorDiv4.id.replace('.0.', '.' + count + '.'));
            errorDiv4.innerHTML = '';
            count++;
            return newRow;
        }

        var newTbody = {};

        function appendRow(forcedLength,childName=newTbody) {
            tbody.appendChild(addRow(forcedLength,tbody));
        }

        function resetTable() {
            newTbody = document.createElement('tbody');
            appendRow(true,newTbody);
            newTbody.setAttribute("id", "tbody");
            newTbody.setAttribute("name", "newTbody");
            tbody.parentNode.replaceChild(newTbody, tbody);
        }


        $(document).on('click', '#create-product', function(event) {
            event.preventDefault();
            let data = [];
            $(".data").map(function(index, currentValue) {
                data.push({
                    'product': $('select[name="data[' + (index) + ']product"]').val(),
                    'supplier': $('select[name="data[' + (index) + ']supplier"]').val(),
                    'price': $('input[name="data[' + (index) + ']price"]').val(),
                    'quantity': $('input[name="data[' + (index) + ']quantity"]').val(),
                });
            });


            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    "Accept": "application/json"
                },
                method: "POST",
                url: '{{ Route('products.ajax.store') }}',
                data: {
                    "data": data
                },
                success: function(data) {
                    if (data.success == true) {
                        resetTable();
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $('div[id="' + key + '"]').html(val[0]);
                    });
                },
            });
        });


        function getSuppliers(value){
            let number = value.getAttribute('number');

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                    "Accept": "application/json"
                },
                method: "GET",
                url: '{{ Route('products.ajax.get-select-input') }}',
                data: {
                    'product': $(`select[number=`+number+`]`).val(),
                },
                success: function(data) {
                    if(data.suppliers){
                // console.log(data.suppliers['pivot']);
            }

                    if (data.success == true) {
                        $(`select[data=`+number+`]`).html(data.options);
                    }
                },
                error: function(data,status){
                    if(data.status == 404){
                        document.getElementById('general-error').innerHTML = "Product Not Found";
                    }
                }

            });
            }
    </script>
@endsection


