$(document).ready(function() {

	

});	

function incCantidad(id){
	var params = {product : id,
	              action_update : 'inc'};
	updateCarrito(params);
}

function decCantidad(id){
	var params = {product : id,
	              action_update : 'dec'};
	updateCarrito(params);
}

function delProducto(id){
	var params = {product : id,
	              action_update : 'del'};
	updateCarrito(params);
}

function confirmarCompra(){
	MI_CARRITO_TRASTOS.hide();
	LOADING.show();
	$.ajax({
		url: 'index.php',
		type: 'POST',
		dataType: 'json',
		data: {action : 'confirmar_compra_by_ajax'},
		success : function(data){
			LOADING.hide();
			if ('success' in data && data.success){
				DIALOG.show('Su compra ha sido confirmada con exito');
			}else{
				if ('info' in data){
					DIALOG.show(data.info);
				}else{
					DIALOG.show('La operación no se ha podido realizar');
				}
			}
		}
	});
}

function updateCarrito(params){
	params.action = 'updatecarritobyajax';
	$.ajax({
		url: 'index.php',
		type: 'POST',
		dataType: 'json',
		data: params,
		success : function(data){
			if ('success' in data && data.success){
				updateContentCarrito(data,params.product);
			}
		}
	});
}

function updateContentCarrito(data,id){
	var tr = $("#table-carrito").find('tr#'+id);
	if (data.n_cantidad > 0){
		tr.find('td[name="n_cantidad"] span').text(data.n_cantidad);
		tr.find('td[name="f_total"]').text('$'+data.f_total);
	}else{
		tr.detach();
	}
}



