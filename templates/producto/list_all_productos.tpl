

{extends file="layout-trastos-admin.tpl"}

{block name=scriptJS}
	<script type="text/javascript" src="js/buscador.js"></script>
	<script type="text/javascript" src="js/listado_productos.js"></script>
{/block}

{block name=body}

<div class="container ">
	<div class="page-header">
	  <h1>Listado de productos <small> trastos.com</small></h1>
	</div>

	<div class="panel panel-default panel-admin">
	  <div class="panel-body">
	  	<div class="form-inline pull-right">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar" id="productos_buscar_txt" name = "buscar_txt">
				<button class="btn btn-default" onclick="buscarTxt()";>Buscar</button>
			</div>
		</div>
	  	<table class="table table-striped table-hover"
	  		   >
      <thead>
        <tr>
          <th width="10%">&nbsp;</th>
          <th width="5%">Id</th>
          <th width="20%">Nombre</th>
          <th width="20%">Descripción</th>
          <th width="15%">Precio</th>
          <th width="20%">Vendedor</th>
          <th width="10%">Visto</th>
        </tr>
      </thead>
		
      <tbody id ="content-listado-productos">
      	<tr id="content-listados-productos-tpl" class="hidden">
			<td>
				<div class="action-table-admin">

		     		<a href="index.php?action=detalle&product=id_producto" tag ="href_productos">
		     			<i class="glyphicon glyphicon-zoom-in action-ver"
					data-toggle="tooltip" data-placement="right" title="Ver producto publicado"
		     		onclick = ""></i>	
		     		</a>
					
				</div>
				
		     </td>
			<td tag="id_producto">id_producto</td>
			<td tag="v_nombre">v_nombre</td>
			<td tag="v_descripcion">v_descripcion</td>
			<td tag="f_precio">f_precio</td>
			<td tag="v_nombre_vendedor">v_nombre_vendedor</td>
			<td tag="n_visitado">n_visitado</td>
		</tr>  
      </tbody>
    </table>

    	<ul class="pager">
		  <li><a href="#" onclick="prev()">Anterior</a></li>
		  <li><a href="#" onclick="next()">Siguiente</a></li>
		</ul>
    	
	  </div>
	</div>


</div>

{/block}


