

$(document).ready(function() {
	
	LOADING.show();

	var txt_buscar = $('#buscador #buscar_txt').val();

	var objTpl;

	var optionsTpl = {
		v_img_path :{
			src : "v_img_path"
		},
		id_producto :{
			href : "id_producto",
			text : "v_nombre"
		},
		v_descripcion : {
			text : "v_descripcion"
		},
		f_precio : {
			text : "f_precio"
		},
		ts_creado : {
			text : "ts_creado"
		},
		n_visitado : {
			text : "n_visitado"
		},
		f_precio_2 : {
			text : "f_precio"
		}
	};

	$.ajax({
		url: 'index.php',
		type: 'GET',
		dataType: 'html',
		data: {action: 'get_tmp_listado_by_ajax'},
		success : function(data){
			objTpl = $(data);
			$.ajax({
				url: 'index.php',
				type: 'GET',
				dataType: 'json',
				data: {action : "get_all_productos_by_ajax", buscar_txt:txt_buscar},
				success : function(data){
					updateListado(data.productos,objTpl,optionsTpl,'listado_productos');
					LOADING.hide();
				}
			});
		}
	});

	$('#buscador').ajaxForm({
		url : "index.php",
		type : "GET",
		dataType : "json",
		data : {action : "get_all_productos_by_ajax"},
		success : function(data){
			updateListado(data.productos,objTpl,optionsTpl,'listado_productos');
			LOADING.hide();
		},
		beforeSubmit: function(arr, $form, options) { 
			LOADING.show();
		}
	});
	
});	



