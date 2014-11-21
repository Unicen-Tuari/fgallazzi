

{extends file="layout-trastos.tpl"}

{block name=scriptJS}
	<script type="text/javascript" src="js/detalle_producto.js" ></script>
{/block}

{block name=body}


<div class="container" >
<div class="panel panel-default">
  <div class="panel-body">
	<div class="row">
				<div class="col-sm-6">
					<picture>
						<img src = "{$data.v_img_path}" class="img-responsive center-block thumbnail" />
					</picture>
				</div>
				<div class="col-sm-6 pu">
					<div class="panel-detalle-producto">
						
						<div class="page-header">

							<h2>
								{$data.v_nombre}
								<br>
								<span class="label label-default --info-precio-producto ">
									$ {$data.f_precio|number_format:2:',':'.'}
								</span>
							</h2>
							
						</div>
						<p>{$data.v_descripcion}</p>
						<button type="button" class="btn btn-primary btn-lg btn-comprar" id = "btn-trastos-comprar" data-p = "{$data.id_producto}">Comprar</button>
						
						<div class="info-extra-detalle-producto">
							<p>
								Publicado desde: {$data.ts_creado|date_format}
							</p>
							<p>
								Visto: {$data.n_visitado}
								{if $data.n_visitado > 1 }
								  veces
								{else}
								  vez
								{/if}
							</p>
						</div>
						
					</div>
					
				</div>
	</div>
	<div class="row">
		<div class = "col-sm-12">
			<div class="page-header">
				<h3>Caracter&iacute;sticas</h3>
			</div>
			<table class="table table-striped">
				<tbody>
					{foreach from=$caracteristicas item = c}
						<tr>
							<td class="col-1">{$c.v_nombre}</td>
							<td class="col-2">{$c.v_valor}</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
			<button type="button" class="btn btn-primary btn-lg btn-comprar" id = "btn-trastos-comprar" data-p = "{$data.id_producto}">Comprar</button>
		</div>
	</div>

	<div class="row">
		<div class = "col-sm-12">
			<div class="page-header">
				<h3>Datos del Vendedor</h3>
			</div>
			<table class="table table-detalle-producto-vendedor">
				<tbody>
					<tr>
						<td class="col-1">Nombre</td>
						<td class="col-2">{$data.v_nombre_vendedor}</td>
					</tr>
					<tr>
						<td class="col-1">Tel&eacute;fono</td>
						<td class="col-2">{$data.v_telefono_vendedor}</td>
					</tr>
				</tbody>
			</table>
			{include file = "carrusel.tpl"}

		</div>
	</div>
	
	<div class="row">
		<div class = "col-sm-12">
			<div class="page-header">
				<h3>Comentarios</h3>
			</div>
		</div>
	</div>
	</div>
</div>
</div>


{/block}

{block name=footer}
	
{/block}

