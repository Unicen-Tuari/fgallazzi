$(document).ready(function($) {

	$('#productos_buscar_txt').keydown(function(){
		buscador.buscarTxt($('#productos_buscar_txt').val());
	});

	var objTpl = $('#content-listados-productos-tpl').clone().removeClass('hidden');

	var optionsTpl = {
		href_edit:{
			href : "id_producto"
		},
		href_productos:{
			href : "id_producto"
		},
		id_producto : {
			text : "id_producto"
		},
		v_nombre : {
			text : "v_nombre"
		},
		v_descripcion : {
			text : "v_descripcion"
		},
		f_precio : {
			text : "f_precio"
		},
		v_nombre_vendedor : {
			text : "v_nombre_vendedor"
		},
		n_visitado : {
			text : "n_visitado"
		}
	};

	buscador = new Buscador();
	buscador.action = "list_all_productos_by_ajax";
	buscador.content = 'content-listado-productos';
	buscador.objTpl = objTpl;
	buscador.optionsTpl = optionsTpl;
	buscador.init();
	
});

var buscador = null;

function buscarTxt(){
	buscador.buscarTxt($('#productos_buscar_txt').val());
}

function next(){
	buscador.next();
}

function prev(){
	buscador.prev();
}