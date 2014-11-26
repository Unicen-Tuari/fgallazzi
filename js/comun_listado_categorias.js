$(document).ready(function($) {

	
	
});

function eliminarCategoria(id){

	DIALOG.addButton('Ok',function(){
		$.ajax({
			url: 'index.php',
			type: 'POST',
			dataType: 'json',
			data: {action: 'baja_categoria_by_ajax', categoria: id},
			success : function(data){
				if ('success' in data && data.success){
					buscador.init();
					DIALOG.show('La categoría se ha eliminado correctamente');
					
				}else if ('info' in data){
					DIALOG.show(data.info);
				}else{
					DIALOG.show('Error');
				}
			}
		});
	});

	DIALOG.addButton('Cancelar',function(){DIALOG.hide()});

	DIALOG.show("¿Ud esta seguro que dese eliminar esta categoría");
	
}