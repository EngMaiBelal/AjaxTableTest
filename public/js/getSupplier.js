 

 let urlSupplier = document.currentScript.getAttribute('url');
function getSuppliers(value){
    let number = value.getAttribute('number');

    $.ajax({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
            "Accept": "application/json"
        },
        method: "GET",
        url: urlSupplier,
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

