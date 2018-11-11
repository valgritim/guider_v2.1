jQuery(document).ready(function($){

	// Method to add regex rule for validation
	jQuery.validator.addMethod(
		"regex",
		function(value, element, regexp) {
			if (regexp.constructor != RegExp)
				regexp = new RegExp(regexp);
			else if (regexp.global)
				regexp.lastIndex = 0;
				return this.optional(element) || regexp.test(value);
		},"Le format ne correspond pas !"
	);

	// Call the validate plugin method
	$('#registerCheck').validate({
		rules:{
			'users_last':{
				'required':true,
				'regex':/^([a-z éèêñçîì]{2,30})$/i
			},
			'users_first':{
				'required':true,
				'regex':/^([a-z éèêñçîì]{2,30})$/i
			},
			'users_phone':{
				'required':true,
				'regex':/^([+(\d]{1})(([\d+() -.]){5,16})([+(\d]{1})$/
			},
			'users_email':{
				'required':true,
				'email':true
			},
			'users_pwd':{
				'required':true,
				'minlength':8,
				'maxlength':16
			}
		},
		messages:{
			users_last:{
				required:"Le champ est requis !",
				regex:"Doit être compris entre 2 et 30 caractères maximum. Doit uniquement comporter des lettres."

			},
			users_first:{
				required:"Le champ est requis !",
				regex:"Doit être compris entre 2 et 30 caractères maximum. Doit uniquement comporter des lettres."
			},
			users_phone:{
				required:"Le champ est requis !",
				regex:"Oups, le format n'est pas correct."
			},
			users_email:{
				required:"Le champ est requis !",
				email:"Vous devez entrer un email valide !"
			},
			users_pwd:{
				required:"Le champs est requis !",
				minlength:"Doit faire entre 8 et 16 caractères.",
				maxlength:"Doit faire entre 8 et 16 caractères."
			}

		}
	});


})