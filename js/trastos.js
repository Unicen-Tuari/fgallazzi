$(document).ready(function() {

	marcarActiveMenu(location.href);

	// carrito de compra
	$('body').append('<div id = "content-carrito-compra" class = "hidden"> </div>');

	// formulario de login
	$('body').append('<div id = "content-form-login" class = "hidden"> </div>');

	// formolario de nuevo usuario
	$('body').append('<div id = "content-form-nuevo-usuario" class = "hidden"> </div>');

});	


function marcarActiveMenu(url){
	$('#navbar-trastos li').removeClass('active');
	var uri = url.split('?');
	if (uri.length > 1){
		uri = uri[1].split('&');
		for (var i = 0; i < uri.length; i++) {
			var param = uri[i].split('=');
			if (param.length > 1){
				if (param[0] == 'action'){
					$('#navbar-trastos li').find("a[href*='"+param[1]+"']").parent('li').addClass('active');
					return;
				}
			}
		}

	}else{
		$('#navbar-trastos li').find("a[href*='home']").parent('li').addClass('active');
	}
}

function miCarrito_onclick(){
	
	MI_CARRITO_TRASTOS.show();
	
}

var MI_CARRITO_TRASTOS = { 
	show : function(){
		$('#content-carrito-compra').empty();
			LOADING.show();
			$.ajax({
				url: 'index.php',
				type: 'POST',
				dataType: 'html',
				data: {action: 'carrito_compra_by_ajax'},
				success : function(data){
					$('#content-carrito-compra').html(data).removeClass('hidden');
					$('#modal-carrito').modal('show');
					LOADING.hide();
				}
			});
	}
};

function formLogin_onclick(){
	FORM_LOGIN_TRASTOS.show();
}
	
var FORM_LOGIN_TRASTOS = { 
	actionDefault : function(){
		window.location.href = "index.php";
	},
	action : null,
	show : function(){	
		LOADING.show();
		$('#content-form-login').empty();
		$.ajax({
			url: 'index.php',
			type: 'POST',
			dataType: 'html',
			data: {action: 'form_login_by_ajax'},
			success : function(data){
				$('#content-form-login').html(data).removeClass('hidden');
				$('#modal-login').modal('show');
				$('#modal-login').on('hidden.bs.modal', function (e) {
					$('#content-form-login').addClass('hidden');
				});
				LOADING.hide();
			}
		});
	},
	setAction : function(obj){
		this.action = obj;
	},
	getAction : function(){
		if (this.action != null){
			var a = this.action;
			this.action = null;
			return a;
		} else {
			return this.actionDefault;
		}
	},
	hide : function(){
		$('#modal-login').modal('hide');
		$('#modal-login').on('hidden.bs.modal', function (e) {
			$('#content-form-login').addClass('hidden');
		});
	}
}

function formRegistrarme_onclick(){
	LOADING.show();
	$('#content-form-nuevo-usuario').empty();
		var that = this;
		$.ajax({
			url: 'index.php',
			type: 'POST',
			dataType: 'html',
			data: {action: 'form_nuevo_usuario_by_ajax'},
			success : function(data){
				$('#content-form-nuevo-usuario').html(data).removeClass('hidden');
				$('#modal-nuevo-usuario').modal('show');
				$('#modal-nuevo-usuario').on('hidden.bs.modal', function (e) {
					$('#content-form-nuevo-usuario').empty();
				});
				LOADING.hide();

			}
		});

}

function salir_onclick(){
	$.ajax({
		url: 'index.php',
		type: 'POST',
		dataType: 'json',
		data: {action: 'logout_by_ajax'},
		success : function(data){
			if ('success' in data && data.success){
				window.location.href = "index.php";
			}

		}
	});
}


function getRandomId(frase){
	var id = $.now();
	frase = (frase == undefined) ? '' : frase;
	while ($('#' + frase + id).length > 0 ){
		id += Math.random() * 1000;
	}
	return frase + id;
}

var LOADING = {
	id : "content-loading-icon",
	show : function(){
		var left = Math.floor($('body').width() / 2  - $('#'+ this.id).width() / 2) + 'px';
		var top = Math.floor(window.innerHeight / 2 - 100) + 'px';
		$('#'+ this.id).css('left', left).css('top', top).removeClass('hidden');
	},
	hide : function(){
		$('#'+ this.id).addClass('hidden');
	}
};