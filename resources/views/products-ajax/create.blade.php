@extends('layouts.parent')
@section('title', 'Create Products')
@section('css')
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
                                    <select class="form-select product m-2 select-custom" number="0" id="product0" name="data[0]product" onchange="getSuppliers(this)" required>
                                    <option selected>Choose Products</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                <div id="data.0.product" class="text-danger font-weight-bold error-product">

                                </div>
                            </td>
                            <td>
                                <select  class="form-select supplier m-2" id="supplier0" data="0" name="data[0]supplier" required>
                                </select>
                                <div id="data.0.supplier" class="text-danger font-weight-bold error-supplier">
                                </div>
                            </td>
                            <td>
                                <input class="form-control quantity" type="number" name="data[0]quantity" required/>
                                <div id="data.0.quantity" class="text-danger font-weight-bold error-quantity">
                                </div>
                            </td>
                            <td>
                                <input class="form-control price" type="number" name="data[0]price" required/>
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

    {{-- jqueryLink for ajax --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- jqueryLink for validation --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="{{asset('js/form-validation.js')}}"></script>

    <script type="text/javascript">
        var tablePro = document.getElementById('Table');
        var tbody = document.getElementById('tbody');
        var firstRow = tablePro.rows[1];
        var newTbody = {};
        var count = 1;
        var indexTable = 2;


        function delRow(row) {
            let i = row.parentNode.parentNode.rowIndex;
            if (i != 1) {
                document.getElementById('Table').deleteRow(i);
            }else{
                firstRow.cells[1].getElementsByTagName("select")[0].value =
                firstRow.cells[1].getElementsByTagName("select")[0].options[0].value; // option value = 0

                firstRow.cells[2].getElementsByTagName("select")[0].value =
                firstRow.cells[2].getElementsByTagName("select")[0].options[0].value;


                firstRow.cells[3].getElementsByTagName("input")[0].value = '';
                firstRow.cells[4].getElementsByTagName("input")[0].value = '';
                // firstRow.cells[5].getElementsByTagName("input")[0].value = '';
            }

        }

        function addRow(forcedLength, childName) {
            //forcedLength to solve table when reset
            let newRow = firstRow.cloneNode(true);
            let len = tablePro.rows.length;
            let newLength = forcedLength ? 0 : len - 1;
            // document.getElementById("span-count").innerHTML = count+1;
            newRow.cells[0].getElementsByTagName("span")[0].innerHTML = indexTable;

            let inp1 = newRow.cells[1].getElementsByTagName("select")[0];
            let attrNumber = (Number(inp1.getAttribute("number")) + count);
            console.log(count,indexTable, attrNumber)

            let inp2 = newRow.cells[2].getElementsByTagName("select")[0];
            let attrData = (Number(inp2.getAttribute("data")) + count);

            let inp3 = newRow.cells[3].getElementsByTagName("input")[0];
            let attrQuantity = (Number(inp3.getAttribute("quantity")) + count);

            let inp4 = newRow.cells[4].getElementsByTagName("input")[0];
            let attrPrice = (Number(inp4.getAttribute("price")) + count);

            // let inp5 = newRow.cells[5].getElementsByTagName("input")[0];
            // let attrTotal = (Number(inp5.getAttribute("total")) + count);

            // let inpDel = newRow.cells[0].getElementsByTagName("button")[0];
            // inpDel.id = (inpDel.id.replace('[1]', '[' + (indexTable) + ']'));


            let errorDiv1 = newRow.cells[1].getElementsByTagName("div")[0];
            let errorDiv2 = newRow.cells[2].getElementsByTagName("div")[0];
            let errorDiv3 = newRow.cells[3].getElementsByTagName("div")[0];
            let errorDiv4 = newRow.cells[4].getElementsByTagName("div")[0];
            // let errorDiv5 = newRow.cells[5].getElementsByTagName("div")[0];

            setAttrTableCells(inp1, "number", attrNumber);
            setAttrTableCells(inp2, "data", attrData);
            setAttrTableCells(inp3, "quantity", attrQuantity);
            setAttrTableCells(inp4, "price", attrPrice);
            // setAttrTableCells(inp5, "total", attrTotal);

            setAtrrTableMsg(errorDiv1);
            setAtrrTableMsg(errorDiv2);
            setAtrrTableMsg(errorDiv3);
            setAtrrTableMsg(errorDiv4);
            // setAtrrTableMsg(errorDiv5);

            count+=1;
            indexTable+=1;
            return newRow;
        }

        function setAttrTableCells(element, attrName, attrReplace) {
            element.id = (element.id.replace('0', count));
            element.name = (element.name.replace('[0]', '[' + count + ']'));
            element.value = '';
            element.setAttribute(attrName, attrReplace);
        }

        function setAtrrTableMsg(element) {
            element.id = (element.id.replace('.0.', '.' + count + '.'));
            element.innerHTML = '';
        }

        function appendRow(forcedLength, childName = newTbody) {
            tbody.appendChild(addRow(forcedLength, tbody));
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


                    if (data.success == true) {
                        document.getElementById('general-error').innerHTML = "";
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


