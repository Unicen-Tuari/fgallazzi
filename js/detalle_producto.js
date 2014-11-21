

$(document).ready(function() { 
	var id_producto = $('#btn-trastos-comprar').attr('data-p');

	$('#carousel-example-generic').on('slide.bs.carousel', function () {
		alert();
		console.log(this);

	})

	$('#btn-trastos-comprar').click(function(){
		comprarClick(id_producto);
	});


});

function comprarClick(id_producto){
	$.ajax({
			url: 'index.php',
			type: 'POST',
			dataType: 'json',
			data: {action: "insert_producto_carrito_by_ajax", product: id_producto},
			success : function(data){
				console.log(data);
				if (data.success){
					alert("el producto se ha insertado correctamente");
				}else if ('action' in data && data.action == 'login'){
					FORM_LOGIN_TRASTOS.setAction(function (){
						comprarClick(id_producto);
					});
					FORM_LOGIN_TRASTOS.show();
				}
			}
		});
}


