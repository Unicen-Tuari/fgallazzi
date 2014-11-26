

{extends file="layout-trastos-admin.tpl"}

{block name=scriptJS}
	<script type="text/javascript" src="js/buscador.js"></script>
	<script type="text/javascript" src="js/listado_compras.js"></script>
{/block}

{block name=body}

<div class="container ">
	<div class="page-header">
	  <h1>Listado de compras <small> trastos.com</small></h1>
	</div>

	<div class="panel panel-default panel-admin">
	  <div class="panel-body">
	  	<div class="form-inline pull-right">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar" id="compras_buscar_txt" name = "buscar_txt">
				<button class="btn btn-default" onclick="buscarTxt()";>Buscar</button>
			</div>
		</div>
	  	<table class="table table-striped table-hover"
	  		   >
      <thead>
        <tr>
          <th width="5%">&nbsp;</th>
          <th width="5%">Id</th>
          <th width="20%">Fecha</th>
          <th width="30%">Cliente</th>
          <th width="20%">Cantidad de unidades</th>
          <th width="20%">Monto total</th>
        </tr>
      </thead>
		
      <tbody id ="content-listado-compras">
      	<tr id="content-listados-compras-tpl" class="hidden">
			<td>
				<div class="action-table-admin">

		     		<a href="index.php?action=detalle_compra&compra=id_carrito" tag ="href_detalle">
		     			<i class="glyphicon glyphicon-zoom-in action-ver"
					data-toggle="tooltip" data-placement="right" title="Ver detalle"
		     		onclick = ""></i>	
		     		</a>
					
				</div>
				
		     </td>
			<td tag="id_carrito">id_carrito</td>
			<td tag="vFecha">vFecha</td>
			<td tag="vUsuario">vUsuario</td>
			<td tag="cantTotalUnidades">cantTotalUnidades</td>
			<td tag="montoTotal">montoTotal</td>
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


