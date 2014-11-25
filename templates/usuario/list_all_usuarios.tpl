

{extends file="layout-trastos-admin.tpl"}

{block name=scriptJS}
	<script type="text/javascript" src="js/buscador.js"></script>
	<script type="text/javascript" src="js/listado_usuarios.js"></script>
{/block}

{block name=body}

<div class="container ">
	<div class="page-header">
	  <h1>Listado de usarios <small> trastos.com</small></h1>
	</div>

	<div class="panel panel-default panel-admin">
	  <div class="panel-body">
	  	<div class="form-inline pull-right">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar" id="usuarios_buscar_txt" name = "buscar_txt">
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
          <th width="20%">Apellido</th>
          <th width="15%">Teléfono</th>
          <th width="30%">Email</th>
        </tr>
      </thead>
		
      <tbody id ="content-listado-usuarios">
      	<tr id="content-listados-usuarios-tpl" class="hidden">
			<td>
				<div class="action-table-admin">
					<a href="index.php?action=edit_user&user=id_usuario" 
						tag = "href_edit">
					<i class="glyphicon glyphicon-edit action-edit"
		     		onclick = ""
		     		data-toggle="tooltip" data-placement="top" title="Editar información"></i>
					</a>
					

		     		<a href="index.php?action=listar_productos&user=id_usuario" tag ="href_productos_user">
		     			<i class="glyphicon glyphicon-zoom-in action-ver"
					data-toggle="tooltip" data-placement="right" title="Ver productos publicados del usuario"
		     		onclick = ""></i>	
		     		</a>
					
				</div>
				
		     </td>
			<td tag="id_usuario">id_usuario</td>
			<td tag="v_nombre">v_nombre</td>
			<td tag="v_apellido">v_apellido</td>
			<td tag="v_telefono">v_telefono</td>
			<td tag="v_email">v_email</td>
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


