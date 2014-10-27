

$(document).ready(function() {
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
		type: 'POST',
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
					updateListado(data,objTpl,optionsTpl);
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
			updateListado(data,objTpl,optionsTpl);
		}
	});
	
});	

function updateListado(data,objTpl,optionsTpl){
	var objAux = null;
	$("#listado_productos").empty();
	$.each(data.productos,function(k,v){
		objAux = objTpl.clone();
		$.each(optionsTpl, function(tag, values) {
			$.each(values,function(attr,val){
				if ( attr != 'text'){
					var a = $(objAux).find('[tag="'+tag+'"]').attr(attr);
					if (a == undefined){
						a = v[val];
					}else{
						a = a.replace(val,v[val]);
					}
					$(objAux).find('[tag="'+tag+'"]').attr(attr,a);
				}else{
					var t = $(objAux).find('[tag="'+tag+'"]').html();
					t = t.replace(val,v[val]);
					$(objAux).find('[tag="'+tag+'"]').html(t);
				}
			});
		});
		$("#listado_productos").append(objAux);
	});
}

