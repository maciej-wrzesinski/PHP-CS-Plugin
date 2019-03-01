jQuery.validator.addMethod("sqldangerous", function (a, b) {
  return this.optional(b) || /^[^\\\'\`\%]+$/.test(a);
});

jQuery.validator.addMethod("isip", function (a, b) {
  return this.optional(b) || /^(\d+\.\d+\.\d+\.\d+):(\d+)$/.test(a);
});

$("#formValidate").validate({
    rules: {
        'service_id[]': {
            maxlength: 23,
            isip: true,
            sqldangerous: true
        }
    },
    messages: {
        'service_id[]': {
            maxlength: "IP can't be this long!",
            isip: "Thats not how IP looks like!",
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