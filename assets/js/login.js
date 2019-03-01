jQuery.validator.addMethod("specialcharacters", function(a,b) {
  return this.optional(b) || /^[0-9a-zA-Z]+$/.test(a);
  });

jQuery.validator.addMethod("sqldangerous", function(a,b) {
  return this.optional(b) || /^[^\\\'\`\%]+$/.test(a);
  });
  
$("#formValidate").validate({
	rules: {
		name: {
			required: true,
			minlength: 3,
			maxlength: 32,
			sqldangerous: true,
			specialcharacters: true
		},
		password: {
			required: true,
			sqldangerous: true,
			minlength: 6,
			maxlength: 32
		},
		securityq: {
			required: true,
			step: 4
		},
	},
	//For custom messages
	messages: {
		name:{
			required: "Wpisz swój login.",
			minlength: "Login musi posiadać przynajmniej 3 znaki.",
			maxlength: "Login nie może posiadać więcej niż 32 znaki.",
			sqldangerous: "Login nie może posiadać takich znaków specjalnych.",
			specialcharacters: "Login nie może zawierać znaków specjalnych."
		},
		password:{
			required: "Wpisz swoje hasło.",
			sqldangerous: "Hasło nie może posiadać takich znaków specjalnych.",
			minlength: "Hasło musi posiadać przynajmniej 6 znaków.",
			maxlength: "Hasło nie może posiadać więcej niż 32 znaki."
		},
		securityq:{
			required: "Musisz podać odpowiedź.",
			step: "Podana odpowiedź jest błędna."
		},
	},
	errorElement : 'div',
	errorPlacement: function(error, element) {
	  var placement = $(element).data('error');
	  if (placement) {
		$(placement).append(error)
	  } else {
		error.insertAfter(element);
	  }
	}
 });