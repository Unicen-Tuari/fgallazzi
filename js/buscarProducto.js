$(document).ready(function() {

	var txt_buscar = $('#buscador #buscar_txt').val();

	$.ajax({
		url: 'index.php',
		type: 'GET',
		dataType: 'json',
		data: {action : "get_all_productos_by_ajax", buscar_txt:txt_buscar},
		success : updateListado
	});
	

	$('#buscador').ajaxForm({
		url : "index.php",
		type : "GET",
		dataType : "json",
		data : {action : "get_all_productos_by_ajax"},
		success : updateListado
	});

});	


function updateListado(data){
	$("#listado_productos").empty();
	
	$.each(data.productos, function(index, p) {
		$("#listado_productos").append( 
			'<div class="row row-trastos">'+
			'	<div class="col-xs-12 col-sm-3 col-md-2" >'+
			'		<a href="">'+
			'			<img src="'+ p.v_img_path +'" class="thumbnail img-responsive img-producto center-block">'+
			'		</a>'+
			'		'+
			'	</div>'+
			'	<div class="col-xs-12 col-sm-9 col-md-10 " >'+
			' 	<div class="row">'+
			'			<div class="col-sm-8 col-md-9">'+
			'				<h3 class="txt-nombre-producto">'+
			'					<a href="index.php?action=detalle&product='+p.id_producto+'">'+
			'						'+p.v_nombre+	
			'					</a>'+
			'				</h3>'+
			'				<p>'+
			'					'+ p.v_descripcion +
            ''+
			'				</p>'+
			'			</div>'+
			'			<div class="col-sm-4 col-md-3 hidden-xs">'+
			'				<span class="label label-default info-precio-producto ">$ '+parseFloat(p.f_precio).toFixed(2)+'</span>'+
            ' '+
			'				<span class = "info-extra-producto">'+
			'					Desde: 									'+p.ts_creado+
			'				</span>'+
			'				<span class = "info-extra-producto">'+
			'					<i class = "glyphicon glyphicon-eye-open"></i>'+
			'					'+p.n_visitado+
			'				</span>'+
			'				'+
			'			</div>'+
			'			'+
			'			'+
			'			<div class="col-xs-12 txt-nombre-producto visible-xs">'+
			'				<span class="label label-default">$ '+parseFloat(p.f_precio).toFixed(2)+'</span>'+
			'			</div>'+
			'			'+
			'		</div>'+
            ''+
			'	</div>'+
            ''+
			'</div>');
		
	});
}