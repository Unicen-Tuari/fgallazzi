
$(document).ready(function() { 
	$.validator.setDefaults({
	  	debug: true,
	 	success: "valid"
	});

    $( "#ContactoForm" ).validate({
		errorClass: "has-error",
		validClass: "has-success",
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
	  	  	'Contacto[nombre]': {
	  	    	required: true,
	  	    	maxlength: 50
	  	  	},
	  	  	'Contacto[apellido]': {
	  	    	required: true,
	  	    	maxlength: 50
	  	  	},
	  	  	'Contacto[email]': {
	  	    	required: true,
	  	    	maxlength: 100,
	  	    	email:true
	  	  	},
	  	  	'Contacto[comentario]': {
	  	    	required: true,
	  	    	maxlength: 1000
	  	  	}

	  	},
	  	messages : {
	  		'Contacto[nombre]': {
	  	    	required: "Este campo es requerido",
	  	    	maxlength: "Maximo de 50 caracteres"
	  	  	},
	  	  	'Contacto[apellido]': {
	  	    	required: "Este campo es requerido",
	  	    	maxlength: "Maximo de 50 caracteres"
	  	  	},
	  	  	'Contacto[email]': {
	  	    	required: "Este campo es requerido",
	  	    	maxlength: "Maximo de 100 caracteres",
	  	    	email:"Indique una dirección de mail válida"
	  	  	},
	  	  	'Contacto[comentario]': {
	  	    	required: "Este campo es requerido",
	  	    	maxlength: "Maximo de 1000 caracteres"
	  	  	}
	  	}
	});

    $('#ContactoForm').ajaxForm();

	var options = {
			url: "index.php",
			data : {action : "form_contacto"},
			type : "post",
			dataType : 'json',
			success : function (data){
				LOADING.hide();
				if ('success' in data && data.success){
					$( "#ContactoForm" ).empty();
					DIALOG.addButton('Ok',function(){
						window.location.href = "index.php?action=home";
					});
					DIALOG.show('A la brevedad nos pondremos en contacto con Ud. <br> Muchas Gracias');
					
				}else if ('info' in data){
					DIALOG.show(data.info);
				}else{
					DIALOG.show('Ha surgido un Error <br> Intentelo nuevamente mas tarde, gracias');
				}
			},
			beforeSend : function(){
				LOADING.show();
			}

		};

});


