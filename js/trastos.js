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
				dataType: 'json',
				data: {action: 'carrito_compra_by_ajax'},
				success : function(data){
					if ('success' in data && data.success){
						$('#content-carrito-compra').html(data.html).removeClass('hidden');
						$('#modal-carrito').modal('show');
					}else if ('action' in data && data.action == "login"){
						FORM_LOGIN_TRASTOS.setAction(function(){
							MI_CARRITO_TRASTOS.show();
						});
						FORM_LOGIN_TRASTOS.setContent();
						FORM_LOGIN_TRASTOS.show();
					}else if ('info' in data ){
						DIALOG.show(data.info);
					}
					LOADING.hide();
				}
			});
	},
	hide : function(){
		$('#modal-carrito').modal('hide');
	}
};

function formLogin_onclick(){
	FORM_LOGIN_TRASTOS.setContent();
	FORM_LOGIN_TRASTOS.notAction();
	FORM_LOGIN_TRASTOS.show();
}
	
var FORM_LOGIN_TRASTOS = { 
	actionDefault : function(){
		window.location.href = "index.php";
	},
	action : null,
	contents : false,
	not_action : false,
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
		if (this.not_action == false){
			if (this.action != null){
				var a = this.action;
				this.action = null;
				return a;
			} else {
				return this.actionDefault;
			}
		}else{
			this.not_action = false;
			return function(){return};
		}
		
	},
	hide : function(){
		$('#modal-login').modal('hide');
		$('#modal-login').on('hidden.bs.modal', function (e) {
			$('#content-form-login').addClass('hidden');
		});
	},
	setContent : function(){
		this.contents = true;
	},
	getContent : function(){
		var c = this.contents;
		this.contents = false;
		return c;
	},
	notAction : function(){
		this.not_action = true;
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

var DIALOG = {
	id : "content-dialog",
	dialog : null,
	buttons : [],
	show : function(mensaje){
		if (this.dialog == null){
			this.dialog = $('#' + this.id + " #modal-dialog");
			var that = this;
			this.dialog.on('hidden.bs.modal', function (e) {
					that.hide();
			});
		}
		$('#' + this.id).removeClass('hidden');
		if (mensaje){
			this.dialog.find('.modal-body p').html(mensaje);
		}
		this.dialog.find('div.modal-footer').empty();
		if (this.buttons.length > 0){
			for (var i = 0; i < this.buttons.length; i++){
				this.dialog.find('div.modal-footer').append(this.buttons[i]);
			}
			this.buttons = [];
		}else{
			this.dialog.find('div.modal-footer').append(this.getBtnDefault());
		}
		
		this.dialog.modal('show');
	},
	hide : function(){
		this.dialog.modal('hide');
		this.dialog.find('.modal-body p').html('');
		$('#' + this.id).addClass('hidden');
	},
	addButton : function(name,action){
		var btn = $('<button></button>').addClass('btn btn-default').text(name);
		btn.click(action);
		this.buttons.push(btn);
	},
	getBtnDefault : function(){
		var btn = $('<button></button>').addClass('btn btn-default');
		btn.attr('data-dismiss','modal');
		btn.text('Ok');
		return btn;
	}
}

var SHOW_ERRORS = {
	show : function (form,errors){
		$.each(errors,function(name,errormsj){
			var element = $(form).find('[name="' + name + '"]').parent('div.marca');
			if ($(element).find('span').length == 0 ){
				span = $('span');
				$(element).append(span);
			}
			$.each(errormsj, function(index, val) {
				$(element).find('span').html(val);
				$(element).removeClass('has-success').addClass('has-error');
			});
		});
	},
	hide : function (form){
		$(form).find('div.marca').removeClass('has-error');

	}
}

var GET_CONTENTS = {
	contentDefault : 'content-navbartrastos',
	contents : null,
	get : function(){
		if (this.contents != null){
			this.get_content(contents);
			this.contents = null;
		}else {
			this.get_content(this.contentDefault);
		}
	},
	get_content : function(content) {
		$.ajax({
			url: 'index.php',
			type: 'GET',
			dataType: 'json',
			data: {action: 'getcontent', content : content},
			success : function(data){
				if ('success' in data && data.success){
					if ('contents' in data){
						$.each(data.contents, function(k,v){
							$('#' + k).html($(v).children());						
						});
					}
				}
			}
		});
	}
}

var FORM_LOGIN_TRASTOS_ATIPICO =  {
	show : function(){
		var next = encodeDataURI();
		window.location.href = 'index.php?action=form_login&next=' + next;
	}
}

function getDataURI(field){
	var uri = location.href;
	var r;
	uri = uri.split('?');
	if (uri.length > 1){
		uri = uri[1].split('&');
		for (var i = 0 ; i < uri.length; i++){
			r = uri[i].split('=');
			if (r.length > 1){
				if (r[0]==field){
					return decodeURIComponent(r[1]);
				}
			}
		}
	}
	return false;
}

function encodeDataURI(){
	var uri = location.href;
	var r;
	uri = uri.split('?');
	if (uri.length > 1){
		return encodeURIComponent(uri[1]);
	}
	return false;
}