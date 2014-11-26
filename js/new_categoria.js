
$(document).ready(function() { 


	$('#back').click(function(event) {
		history.back();
	});

	$.validator.setDefaults({
	  	debug: true,
	 	success: "valid"
	});

    $( "#CategoriaForm" ).validate({
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
	  	  	'Categoria[v_descripcion]': {
	  	    	required: true,
	  	    	maxlength: 50
	  	  	}
	  	},
	  	messages : {
	  		'Categoria[v_descripcion]': {
	  	    	required: "Este campo es requerido",
	  	    	maxlength: "Maximo de 50 caracteres"
	  	  	}
	  	}
	});

    $('#CategoriaForm').ajaxForm();

	var options = {
			url: "index.php",
			data : {action : "new_categoria"},
			type : "POST",
			dataType : 'json',
			success : function (data){
				LOADING.hide();
				if ('success' in data && data.success){
					history.back();
				}else{

				}
			},
			beforeSend : function(){
				LOADING.show();
			}

		};

});


