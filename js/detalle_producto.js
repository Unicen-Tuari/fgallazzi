

$(document).ready(function() { 
	var id_producto = $('button[name="btn-trastos-comprar"]').attr('data-p');

	$('#carousel-example-generic').on('slide.bs.carousel', function () {
		

	})

	$('button[name="btn-trastos-comprar"]').click(function(){
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
				if (data.success){
					DIALOG.addButton('Ver el carrito',function(){
						DIALOG.hide();
						MI_CARRITO_TRASTOS.show();
					});
					DIALOG.addButton('Seguir comprando',function(){
						DIALOG.hide();
					});
					DIALOG.show("El producto ha sido ingresado en su carrito de compras");
				}else if ('action' in data && data.action == 'login'){
					FORM_LOGIN_TRASTOS.setAction(function (){
						comprarClick(id_producto);
					});
					FORM_LOGIN_TRASTOS.setContent();
					FORM_LOGIN_TRASTOS.show();
				}else if ('existe' in data && data.existe){
					DIALOG.addButton('Ok',function(){
						DIALOG.hide();
						incCantidad(id_producto);
					});
					DIALOG.addButton('Cancelar',function(){
						DIALOG.hide();
					});
					DIALOG.show("El producto ya esta en el carrito, desea añadir una unidad mas");
				}
			}
		});
}


