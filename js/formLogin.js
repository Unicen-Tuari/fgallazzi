$(document).ready(function() {

	

	var options = {
		url : "index.php",
		type : "POST",
		dataType : "json",
		data : {action:"login_by_ajax"},
		success : function(data){
			if ('success' in data && data.success){
				alert(data.user);
				window.location.href = "index.php";
			}
		}
	};

	$('#modal-login').on('hidden.bs.modal', function (e) {

	})

	$.validator.setDefaults({
	  	debug: false,
	 	success: "valid"
	});

	$( "#form_sesion_login" ).validate({
		errorClass: "has-error",
		validClass: "",
		errorElement : "span",
		ignore : false,
		highlight: function(element, errorClass, validClass) {
		    $(element).parents('div.marca').addClass(errorClass).removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) {
		    $(element).parents('div.marca').removeClass(errorClass).addClass(validClass);
		},
		submitHandler: function(form) {

			$(form).ajaxSubmit(options);
		},
	  	rules: {
	  	  	'usuario': {
	  	    	required: true,
	  	    	maxlength: 50
	  	  	},
	  	  	'password': {
	  	    	required: true,
	  	    	minlength : 6,
	  	    	maxlength : 50
	  	  	}
	  	},
	  	messages : {
	  		'usuario': {
	  	    	required: "Por favor indique su nombre de usuario",
	  	    	maxlength: "Maximo de 50 caracteres"
	  	  	},
	  	  	'password': {
	  	    	required: "Por favor indique su contraseña",
	  	    	maxlength: "Maximo de 50 caracteres",
	  	    	minlength: "Minimo 6 caracteres"
	  	  	}
	  	}
	});

	$('#form_sesion_login').ajaxForm();

	
});	

