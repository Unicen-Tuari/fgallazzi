
var validator = null;


$(document).ready(function() { 

	$('#modal-success').on('hide.bs.modal', function (e) {
	   window.location.href = "index.php";
	})

	// Actualizar el combo de sub-categoria cuando cambie la categoria principal
	// Traer Las caracteristicas correspondientes
	$("#categoria_principal").change(function(){
		var categoriaSelect = $(this).val();
		$.ajax({
			url: 'index.php?action=get_categorias',
			type: 'POST',
			data: {categoria : categoriaSelect},
			dataType: 'json',
			success : function(data){
				cargarCombo("sub_categoria",data);
			}
		});
		$.ajax({
			url: 'index.php?action=get_caracteristicas',
			type: 'POST',
			data: {categoria : categoriaSelect},
			dataType: 'json',
			success : function(data){
				updateFormCaracteristicas(data);
			}
		});
	});
	

	// Cargar vía Ajax el combo de categorías principales
	$.ajax({
		url: 'index.php?action=get_categorias',
		type: 'POST',
		dataType: 'json',
		success : function(data){
			cargarCombo("categoria_principal",data);
			// Laamar al metodo change para actualizar el combo de subcategorias.
			$("#categoria_principal").change();
		}
	});

	$('#publicar_producto_guardar').ajaxForm({
		url: "index.php",
		data : {action : "cargar_publicacion"},
		type : "POST",
		dataType : 'json',
		success : function (data){
			LOADING.hide();
			if ('success' in data && data.success){
				$("#modal-success").modal('show');
			}else if ('action' in data){
				if (data.action == 'login'){
					FORM_LOGIN_TRASTOS.setAction(function (){
						$('#publicar_producto_guardar').submit();
					});
					FORM_LOGIN_TRASTOS.show();
				}

			}

		},
		beforeSend : function(){
			console.log("paso");
			LOADING.show();
		}

	});

	// Validar Formulario con Jquery.validate()

	setearValidateFomInfo();
	

	// info 
	$('#publicar_producto_info').click(function(e) {
		e.preventDefault();
		if ($('#publicar_producto_guardar').valid()){
			$('#publicar_tab a[href="#caracteristicas"]').tab('show').parent('li').removeClass('disabled');

		}
	});

 	// Caracteristicas 
				
 	$("#btn-caracteristicas-siguiente").click(function(e) {
 		e.preventDefault();
 		$('#publicar_tab a[href="#imagenes"]').tab('show').parent('li').removeClass('disabled');
 		setearValidateFomImagenes();
 	});

 	// Imagenes

 	$('#btn-publicar_producto_imagenes').click(function(e) {
		e.preventDefault();
		if ($('#publicar_producto_guardar').valid()){
			$('#publicar_tab a[href="#confirmar"]').tab('show').parent('li').removeClass('disabled');

		}
	});

	$('input:file').change(function(e){
		e.preventDefault();
		var file = this.files[0];
		var url = window.URL || window.webKitUrl;
		$(this).parent('div').parent('div.thumbnail').find('img').attr('src',url.createObjectURL(file));
	});


	// tab

	$('#publicar_tab a').click(function (e) {
	  	e.preventDefault();
	 
	});

	

});

function cargarCombo(id,data){
	var combo = $("#"+id);
	combo.empty();
	$.each(data, function(index, itm) {
		combo.append('<option value ="' + itm.value + '">' + itm.text + '</select>');
	});
}



function updateFormCaracteristicas(data){
	var form = $("#publicar_producto_caracteristicas");
	form.empty();
	$.each(data,function(key,val){
		form.append('<div class="form-group">' +
					    '<label for="caracteristica_'+val.value+'" class="col-lg-2 control-label">'+val.text+'</label>'+
					    '<div class="col-lg-10">'+
					    	'<input type="text" class="form-control" id="caracteristica_'+val.value+'" name="caracteristicas['+val.value+']" placeholder="'+val.text+'">'+
					    '</div>'+
					'</div>');
	});
}

function setearValidateFomInfo(){
	$.validator.setDefaults({
	  	debug: true,
	 	success: "valid"
	});

	validator = $( "#publicar_producto_guardar" ).validate({
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
		   	
		},
	  	rules: {
	  	  	'info[nombre]': {
	  	    	required: true,
	  	    	maxlength: 50
	  	  	},
	  	  	'info[precio]': {
	  	    	required: true,
	  	    	number : true,
	  	    	min : 0
	  	  	},
	  	  	'info[descripcion]': {
	  	    	required: true
	  	  	}
	  	},
	  	messages : {
	  		'info[nombre]': {
	  	    	required: "Este campo es requerido",
	  	    	maxlength: "Maximo de 50 caracteres"
	  	  	},
	  	  	'info[precio]': {
	  	    	required: "Este campo es requerido",
	  	    	number : "Solo numeros",
	  	    	min : "El valor minimo es 0"
	  	  	},
	  	  	'info[descripcion]': {
	  	    	required: "Este campo es requerido"
	  	  	}
	  	}
	});

}

function setearValidateFomImagenes(){
	$('#file_1').rules('add',{
		required: true,
	  	accept: "image/gif,image/jpg,image/png",
	  	messages : {
	  		required: "La imagen principal es requerida",
	  	    accept: "Formato valido .gif, .jpg, .png"
	  	}
	});
	$('#file_2').rules('add',{
	  	accept: "image/gif,image/jpg,image/png",
	  	messages : {
	  	    accept: "Formato valido .gif, .jpg, .png"
	  	}
	});
	$('#file_3').rules('add',{
	  	accept: "image/gif,image/jpg,image/png",
	  	messages : {
	  	    accept: "Formato valido .gif, .jpg, .png"
	  	}
	});
	$('#file_4').rules('add',{
	  	accept: "image/gif,image/jpg,image/png",
	  	messages : {
	  	    accept: "Formato valido .gif, .jpg, .png"
	  	}
	});
	$('#file_5').rules('add',{
	  	accept: "image/gif,image/jpg,image/png",
	  	messages : {
	  	    accept: "Formato valido .gif, .jpg, .png"
	  	}
	});
	$('#file_6').rules('add',{
	  	accept: "image/gif,image/jpg,image/png",
	  	messages : {
	  	    accept: "Formato valido .gif, .jpg, .png"
	  	}
	});
}
