$(document).ready(function() {

	marcarActiveMenu(location.href);

	// carrito de compra
	$('body').append('<div id = "content-carrito-compra" class = "hidden"> </div>');
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
	$('#content-carrito-compra').empty();
		var that = this;
		$.ajax({
			url: 'index.php',
			type: 'POST',
			dataType: 'html',
			data: {action: 'carrito_compra_by_ajax'},
			success : function(data){
				$('#content-carrito-compra').html(data).removeClass('hidden');
				$('#modal-carrito').modal('show');
				$('#modal-carrito').on('hidden.bs.modal', function (e) {
					$('#content-carrito-compra').addClass('hidden');
				})

			}
		});
}