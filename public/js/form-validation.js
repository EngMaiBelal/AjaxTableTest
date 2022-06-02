// For 3 dimension array

$(function() {
    var validForm = $("form[name='form-reg']").validate();
    var data = $('input[name^="data"]');

        data.filter('input[name$="[product]"]').each(function() {
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Name is Mandatory"
                }
            });
            validForm.showErrors(messages);
        });

        data.filter('input[name$="[supplier]"]').each(function() {
            $(this).rules("add", {
                required: true,
                messages: {
                    required : 'Supplier is Mandatory',
                },
            });
        });

        data.filter('input[name$="[quantity]"]').each(function() {
            $(this).rules("add", {
                required: true,
                digits: true,
                messages: {
                    required : 'Quantity is Mandatory',
                    digits: 'Accept number only',

                }
            });
        });

        data.filter('input[name$="[price]"]').each(function() {
            $(this).rules("add", {
                required: true,
                digits: true,
                messages: {
                    required : 'Price is Mandatory',
                    digits: 'Accept number only',
                }
            });
        });
        
});



/////////////////////////////////////////////////////////////////////////
// For one dimension array
// $(function() {
//     // Initialize form validation on the registration form.
//     // It has the name attribute "form-reg"
//     $("form[name='form-reg']").validate({
//       // Specify validation rules
//       rules: {
//         // The key name on the left side is the name attribute
//         // of an input field. Validation rules are defined
//         // on the right side
//         firstname: "required",
//         lastname: "required",
//         email: {
//           required: true,
//           // Specify that email should be validated
//           // by the built-in "email" rule
//           email: true
//         },
//         password: {
//           required: true,
//           minlength: 5
//         }
//       },
//       // Specify validation error messages
//       messages: {
//         firstname: "Please enter your firstname",
//         lastname: "Please enter your lastname",
//         password: {
//           required: "Please provide a password",
//           minlength: "Your password must be at least 5 characters long"
//         },
//         email: "Please enter a valid email address"
//       },


// errorPlacement: function(error, element) {

//     if(error[0].htmlFor == 'name')
//     {
//         error.appendTo($(element).parents('div').find($('.error-product')));
//     }
//     if(error[0].htmlFor == 'supplier')
//     {
//         error.appendTo($(element).parents('div').find($('.error-supplier')));
//     }
//     if(error[0].htmlFor == 'quantity')
//     {
//         error.appendTo($(element).parents('div').find($('.error-price')));
//     }
//     if(error[0].htmlFor == 'price')
//     {
//         error.appendTo($(element).parents('div').find($('.error-quantity')));
//     }
// }
//       // Make sure the form is submitted to the destination defined
//       // in the "action" attribute of the form when valid
//       submitHandler: function(form) {
//         form.submit();
//       }
//     });
//   });



//////////////////////////////////////////////////////////////////

// var validator = $("#myform").validate();
// $("#checkid").click(function() {
//     var errors;

//     if (!$("#name").val()) {
//         /* Build up errors object, name of input and error message: */
//         errors = { personalid: "Please enter an ID to check" };
//         /* Show errors on the form */
//         validator.showErrors(errors);
//     }
// });
