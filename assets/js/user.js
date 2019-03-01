jQuery.validator.addMethod("sqldangerous", function (a, b) {
  return this.optional(b) || /^[^\\\'\`\%]+$/.test(a);
});

$("#formValidate").validate({
    rules: {
        'textofticket': {
            required: true,
            sqldangerous: true
        }
    },
    messages: {
        'textofticket': {
            required: "This must be filled!",
            sqldangerous: "Naughty naughty!"
        }
    },
    errorElement : 'div',
    errorPlacement: function (error, element) {
    var placement = $(element).data('error');
        if (placement) {
            $(placement).append(error);
        } else {
            error.insertAfter(element);
        }
    }
});
