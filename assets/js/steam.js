jQuery.validator.addMethod("sqldangerous", function (a, b) {
  return this.optional(b) || /^[^\\\'\`\%]+$/.test(a);
});

jQuery.validator.addMethod("steam", function (a, b) {
  return this.optional(b) || /\b(?=\w)STEAM_\d[:]\d[:]\d+/.test(a);
});

jQuery.validator.addMethod("something", function (a, b) {
  return this.optional(b) || /^[A-Z]+$/.test(a);
});

$("#formValidate").validate({
    rules: {
        'formsteamid': {
            required: true,
            steam: true,
            sqldangerous: true
        },
        'formuniqueshort': {
            required: true,
            something: true,
            sqldangerous: true
        }
    },
    messages: {
        'formsteamid': {
            required: "This must be filled!",
            steam: "Thats not how STEAM ID looks like!",
            sqldangerous: "Naughty naughty!"
        },
        'formuniqueshort': {
            required: "This must be filled!",
            something: "This must be only upper letters",
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

$("#formValidate2").validate({
    rules: {
        'formuniqueshort': {
            required: true,
            something: true,
            sqldangerous: true
        }
    },
    messages: {
        'formuniqueshort': {
            required: "This must be filled!",
            something: "This must be only upper letters",
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