

{extends file="layout-trastos-admin.tpl"}

{block name=scriptJS}
	<script> id_categoria_padre = {$id_categoria_padre} </script>
	<script type="text/javascript" src="js/buscador.js"></script>
	<script type="text/javascript" src="js/listado_sub_categorias.js"></script>
	<script type="text/javascript" src="js/comun_listado_categorias.js"></script>

{/block}

{block name=body}

<div class="container ">
	<div class="page-header">
	  <h1>Listado de Sub Categorías <small> trastos.com</small></h1>
	  <h2>{$nombre}</h2>
	</div>

	<div class="panel panel-default panel-admin">
	  <div class="panel-body">
	  	<a href="index.php?action=new_categoria&categoria={$id_categoria_padre}&mark=list_all_categorias"><button class="btn btn-default">Nueva Sub-Categoría</button></a>
	  	<div class="form-inline pull-right">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar" id="categorias_buscar_txt" name = "buscar_txt">
				<button class="btn btn-default" onclick="buscarTxt()";>Buscar</button>
			</div>
		</div>
	  	<table class="table table-striped table-hover"
	  		   >
      <thead>
        <tr>
          <th width="20%">&nbsp;</th>
          <th width="20%">Id</th>
          <th width="60%">Nombre</th>
        </tr>
      </thead>
		
      <tbody id ="content-listado-categorias">
      	<tr id="content-listados-categorias-tpl" class="hidden">
			<td>
				<div class="action-table-admin">
					<a href="index.php?action=edit_categoria&categoria=id_categoria&mark=list_all_categorias" 
						tag = "href_edit">
					<i class="glyphicon glyphicon-edit action-edit"
		     		onclick = ""
		     		data-toggle="tooltip" data-placement="top" title="Editar información"></i>
					</a>

					<i class="glyphicon glyphicon-remove-sign action-delete" tag = "delete_categoria"
					data-toggle="tooltip" data-placement="right" title="Eliminar"
		     		onclick = "eliminarCategoria(id_categoria)"></i>
				</div>
		     </td>

			<td tag="id_categoria">id_categoria</td>
			<td tag="v_descripcion">v_descripcion</td>
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


