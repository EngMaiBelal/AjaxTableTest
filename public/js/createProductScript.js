///////////////////////////////////////////////////////////
// Select2
$(document).ready(function(){
    $('.product').select2();
    $('.supplier').select2();
});


///////////////////////////////////////////////////////////
// Table

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
                firstRow.cells[1].getElementsByTagName("select")[0].value ='';
                // firstRow.cells[1].getElementsByTagName("select")[0].options[0].value; // option value = 0

                firstRow.cells[2].getElementsByTagName("select")[0].value ='';
                // firstRow.cells[2].getElementsByTagName("select")[0].options[0].value;


                firstRow.cells[3].getElementsByTagName("input")[0].value = '';
                firstRow.cells[4].getElementsByTagName("input")[0].value = '';
                // firstRow.cells[5].getElementsByTagName("input")[0].value = '';
            }

        }

        function addRow(forcedLength, childName) {
            //forcedLength to solve table when reset
            $('.product').select2('destroy');
            $('.supplier').select2('destroy');

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
            $('.product').select2();
            $('.supplier').select2();
        }

        function resetTable() {
            newTbody = document.createElement('tbody');
            appendRow(true,newTbody);
            newTbody.setAttribute("id", "tbody");
            newTbody.setAttribute("name", "newTbody");
            tbody.parentNode.replaceChild(newTbody, tbody);
        }
