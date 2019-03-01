jQuery.validator.addMethod("specialcharacters", function(a,b) {
  return this.optional(b) || /^[0-9a-zA-Z]+$/.test(a);
  });

jQuery.validator.addMethod("sqldangerous", function(a,b) {
  return this.optional(b) || /^[^\\\'\`\%]+$/.test(a);
  });

jQuery.validator.addMethod("steam", function(a,b) {
  return this.optional(b) || /\b(?=\w)STEAM_\d[:]\d[:]\d+/.test(a);
  });

$("#formValidate").validate({
	rules: {
		name: {
			required: true,
			minlength: 3,
			maxlength: 32,
			sqldangerous: true
		},
		sid: {
			required: true,
			sqldangerous: true,
			maxlength: 64,
			steam: true
		},
		password: {
			required: true,
			sqldangerous: true,
			minlength: 6,
			maxlength: 32
		},
		codesms: {
			specialcharacters: true,
			minlength: 8,
			maxlength: 8
		},
		securityq: {
			required: true,
			step: 4
		},
		agree:"required",
	},
	//For custom messages
	messages: {
		name:{
			required: "Wpisz swój nick.",
			minlength: "Nick musi posiadać przynajmniej 3 znaki.",
			maxlength: "Nick nie może posiadać więcej niż 32 znaki.",
			sqldangerous: "Nick nie może posiadać takich znaków specjalnych."
		},
		sid:{
			required: "Wpisz swój SID.",
			sqldangerous: "SID nie może posiadać takich znaków specjalnych.",
			maxlength: "SID nie może posiadać więcej niż 32 znaki.",
			steam: "To nie jest Steam ID."
		},
		password:{
			required: "Wpisz swoje hasło.",
			sqldangerous: "Hasło nie może posiadać takich znaków specjalnych.",
			minlength: "Hasło musi posiadać przynajmniej 6 znaków.",
			maxlength: "Hasło nie może posiadać więcej niż 32 znaki."
		},
		codesms:{
			specialcharacters: "Kod nie może posiadać znaków specjalnych.",
			minlength: "Kod musi mieć 8 znaków.",
			maxlength: "Kod musi mieć 8 znaków."
		},
		securityq:{
			required: "Musisz podać odpowiedź.",
			step: "Podana odpowiedź jest błędna."
		},
		agree:{
			required: "Żeby dokonać rejestracji, musisz zaakceptować regulamin"
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