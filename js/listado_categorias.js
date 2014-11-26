$(document).ready(function($) {

	$('#categorias_buscar_txt').keydown(function(){
		buscador.buscarTxt($('#categorias_buscar_txt').val());
	});

	var objTpl = $('#content-listados-categorias-tpl').clone().removeClass('hidden');

	var optionsTpl = {
		delete_categoria :{
			onclick : "id_categoria"
		},
		href_edit:{
			href : "id_categoria"
		},
		href_subcategorias:{
			href : "id_categoria"
		},
		id_categoria : {
			text : "id_categoria"
		},
		v_descripcion : {
			text : "v_descripcion"
		}
	};

	buscador = new Buscador();
	buscador.action = "list_all_categorias_by_ajax";
	buscador.content = 'content-listado-categorias';
	buscador.objTpl = objTpl;
	buscador.optionsTpl = optionsTpl;
	buscador.init();
	
});

var buscador = null;

function buscarTxt(){
	buscador.buscarTxt($('#categorias_buscar_txt').val());
}

function next(){
	buscador.next();
}

function prev(){
	buscador.prev();
}