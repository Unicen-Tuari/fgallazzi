$(document).ready(function($) {

	$('#usuarios_buscar_txt').keydown(function(){
		buscador.buscarTxt($('#usuarios_buscar_txt').val());
	});

	var objTpl = $('#content-listados-usuarios-tpl').clone().removeClass('hidden');

	var optionsTpl = {
		href_edit:{
			href : "id_usuario"
		},
		href_productos:{
			href : "id_usuario"
		},
		id_usuario : {
			text : "id_usuario"
		},
		v_nombre : {
			text : "v_nombre"
		},
		v_apellido : {
			text : "v_apellido"
		},
		v_telefono : {
			text : "v_telefono"
		},
		v_email : {
			text : "v_email"
		}
	};

	buscador = new Buscador();
	buscador.action = "list_all_usuarios_by_ajax";
	buscador.content = 'content-listado-usuarios';
	buscador.objTpl = objTpl;
	buscador.optionsTpl = optionsTpl;
	buscador.init();
	
});

var buscador = null;

function buscarTxt(){
	buscador.buscarTxt($('#usuarios_buscar_txt').val());
}

function next(){
	buscador.next();
}

function prev(){
	buscador.prev();
}