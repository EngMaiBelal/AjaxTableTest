@extends('layouts.parent')
@section('title','Create Products')

@section('content')

    <div class="col-12 text-center text-dark">
        <h1>Create Products</h1>
    </div>

    <div class="col-12">
        <div id="divTable">
            <form action="{{ route('products.store') }}" method="post">
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
                            <td><input class="form-control" type="text" name="name" id="name" /></td>
                            <td><input class="form-control" type="text" name="price" id="price" /></td>
                            <td><input class="form-control" type="text" name="quantity" id="quantity" /></td>
                            <td><input type="button" class="btn btn-danger" id="delbut" value="Delete" onclick="delRow(this)" /></td>
                            <td><input type="button" class="btn btn-success" id="addbut" value="Add More" onclick="addRow()" /></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary"> Create Products </button>
            </form>
        </div>
    </div>
@endsection

@section('js')

    <script>
        function delRow(row) {

            //row index [0],[1],[2],.....
            let i = row.parentNode.parentNode.rowIndex;
            if (row.parentNode.parentNode.parentNode.rows.length != 1) {
                document.getElementById('Table').deleteRow(i);
                // prevent deleting the first element
            }
        }


        function addRow() {

            // Catch the table and make copy of the first row ---> cloneNode
            // Get length
            // content of cell index
            // every inp name,value,id

            let tablePro = document.getElementById('Table');
            let newRow = tablePro.rows[1].cloneNode(true);
            let len = tablePro.rows.length;
            let cellLen=newRow.cells.length;
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

@endsection

