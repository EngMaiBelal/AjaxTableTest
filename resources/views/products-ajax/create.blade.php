@extends('layouts.parent')
@section('title', 'Create Products')

@section('content')

    <div class="col-12 text-center text-dark">
        <h1>Create Products</h1>
    </div>
    <select id="select">

    </select>


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

                            <td>
                                <input class="form-control name" type="text" name="data[0]name" />
                                <div id="data.0.name" class="text-danger font-weight-bold">

                                </div>
                            </td>
                            <td>
                                <input class="form-control price" type="number" name="data[0]price" />
                                <div id="data.0.price" class="text-danger font-weight-bold">

                                </div>
                            </td>
                            <td>
                                <input class="form-control quantity" type="number" name="data[0]quantity" />
                                <div id="data.0.quantity" class="text-danger font-weight-bold">

                                </div>
                            </td>

                            <td><input type="button" class="btn btn-danger" id="delbut" value="Delete"
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
    <script>
        $('#option_product')
        var tablePro = document.getElementById('Table');

        function delRow(row) {
            let i = row.parentNode.parentNode.rowIndex;
            if (row.parentNode.parentNode.parentNode.rows.length != 1) {
                document.getElementById('Table').deleteRow(i);
            }
        }


        function addRow(forcedLength) {

            let newRow = tablePro.rows[1].cloneNode(true);
            let len = tablePro.rows.length;
            newRow.cells[0].innerHTML = forcedLength ? 1 : len;
            let newLength = forcedLength ? 0 : len - 1 ;

            var inp1 = newRow.cells[1].getElementsByTagName('input')[0];
            var inp2 = newRow.cells[2].getElementsByTagName('input')[0];
            var inp3 = newRow.cells[3].getElementsByTagName('input')[0];

            var errorDiv1 = newRow.cells[1].getElementsByTagName('div')[0];
            var errorDiv2 = newRow.cells[2].getElementsByTagName('div')[0];
            var errorDiv3 = newRow.cells[3].getElementsByTagName('div')[0];
            errorDiv1.id = (errorDiv1.id.replace('.0.', '.' + newLength + '.'));
            errorDiv1.innerHTML = '';
            errorDiv2.id = (errorDiv2.id.replace('.0.', '.' + newLength + '.'));
            errorDiv2.innerHTML = '';
            errorDiv3.id = (errorDiv3.id.replace('.0.', '.' + newLength + '.'));
            errorDiv3.innerHTML = '';

            // concate the name  not value
            // for(let i=1; 0 <i< cellLen-3; i++){
            // this["inp"+i] = newRow.cells[i].getElementsByTagName('input')[0];
            // this["marker"+i] = "some stuff";

            //         (inp+i).name = ((inp+i).name.replace('[1]', '[' + len + ']'));
            //         (inp+i).id += len;
            //         (inp+i).value = '';
            // }

            inp1.name = (inp1.name.replace('[0]', '[' + newLength + ']'));
            inp1.value = '';

            inp2.name = (inp2.name.replace('[0]', '[' + newLength + ']'));
            inp2.value = '';

            inp3.name = (inp3.name.replace('[0]', '[' + newLength + ']'));
            inp3.value = '';
            return newRow;
        }

        function appendRow(forcedLength) {
            tablePro.appendChild(addRow(forcedLength));
        }

        function resetTable() {
            appendRow(true);
            length = document.getElementById('Table').rows.length;
            // console.log(length);
            for (let index = 0; index <= length-1 ; index++) {
                if(index == 0 || index == length-1){
                    continue;
                }
                document.getElementById('Table').deleteRow(index);
            }

            // tablePro.rows[1].innerHTML =  addRow(true).cells;
        }


        $(document).on('click', '#create-product', function(event) {
            // var formData = new FormData(product-form);

            event.preventDefault();

            let data = [];
            $(".data").map(function(index, currentValue) {
                data.push({
                    'name': $('input[name="data[' + (index) + ']name"]').val(),
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
                        document.getElementById('select').innerHTML = (data.options);
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
    </script>
@endsection
