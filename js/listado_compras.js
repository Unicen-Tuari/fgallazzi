$(document).ready(function($) {

	$('#compras_buscar_txt').keydown(function(){
		buscador.buscarTxt($('#compras_buscar_txt').val());
	});

	var objTpl = $('#content-listados-compras-tpl').clone().removeClass('hidden');

	var optionsTpl = {
		href_detalle:{
			href : "id_carrito"
		},
		id_carrito : {
			text : "id_carrito"
		},
		vFecha : {
			text : "vFecha"
		},
		vUsuario : {
			text : "vUsuario"
		},
		cantTotalUnidades : {
			text : "cantTotalUnidades"
		},
		montoTotal : {
			text : "montoTotal"
		}
	};

	buscador = new Buscador();
	buscador.action = "list_all_compras_by_ajax";
	buscador.content = 'content-listado-compras';
	buscador.objTpl = objTpl;
	buscador.optionsTpl = optionsTpl;
	buscador.init();
	
});

var buscador = null;

function buscarTxt(){
	buscador.buscarTxt($('#compras_buscar_txt').val());
}

function next(){
	buscador.next();
}

function prev(){
	buscador.prev();
}