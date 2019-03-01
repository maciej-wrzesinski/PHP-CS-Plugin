jQuery.validator.addMethod("sqldangerous", function (a, b) {
  return this.optional(b) || /^[^\\\'\`\%\-\"\;]+$/.test(a);
});

$("#formValidate").validate({
    rules: {
        'opinion': {
            maxlength: 200,
            sqldangerous: true,
            required: true
        }
    },
    messages: {
        'opinion': {
            maxlength: "Please less than 200!",
            sqldangerous: "Forbidden signs!",
            required: "You have to fill this to submit!"
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