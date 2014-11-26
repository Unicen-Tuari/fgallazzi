

{extends file="layout-trastos-admin.tpl"}

{block name=scriptJS}
    <script type="text/javascript" src="js/jquery.form.min.js"></script> 
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/additional-methods.min.js"></script>
	<script type="text/javascript" src="js/edit_categoria.js"></script>
{/block}

{block name=body}

<div class="container ">
	<div class="page-header">
	  <h1>Editar Categoría <small> trastos.com</small></h1>
	</div>
	<div class="col-sm-6 col-sm-push-3">
		<div class="panel panel-default panel-admin">
		  <div class="panel-body">
		  	
		  	<form role="form" action ="index.php" method="post" id = "CategoriaEdit">
		  	  <input type="hidden" value = {$id_categoria} name="Categoria[id_categoria]"/>	
			  <div class="form-group marca">
			    <label for="v_nombre">Nombre</label>
			    <input type="text" class="form-control" 
			    	   id="v_descripcion" name = "Categoria[v_descripcion]" 
			           placeholder="nombre"
			           value = "{$v_descripcion}">
			  </div>
			  <button type="submit" class="btn btn-default" name="submit">Enviar</button>
			  <a   id = "back" class="btn btn-default" name="cancel">Cancelar</a>
			</form>
	    	
		  </div>
		</div>
	</div>

</div>

{/block}


