

{extends file="layout-trastos-admin.tpl"}

{block name=scriptJS}
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/additional-methods.min.js"></script>
	<script type="text/javascript" src="js/new_categoria.js"></script>
{/block}

{block name=body}

<div class="container ">
	<div class="page-header">
	  {if $id_categoria_padre == false}
	  
	  	<h1>Nueva Categoría <small> trastos.com</small></h1>
	  
	  {else}
	  	<h1>Nueva Sub-Categoría <small> trastos.com</small></h1>
	  {/if}
	</div>

	<div class="col-sm-6 col-sm-push-3">
		<div class="panel panel-default panel-admin">
		  <div class="panel-body">
		  	
		  	<form role="form" action ="index.php" method="post" id ="CategoriaForm">
		  	  <input type="hidden" name="Categoria[id_categoria_padre]" value="{$id_categoria_padre}"/>	
			  <div class="form-group marca">
			    <label for="v_nombre">Nombre</label>
			    <input type="text" class="form-control" 
			    	   id="v_descripcion" name = "Categoria[v_descripcion]" 
			           placeholder="nombre"
			           value = "">
			  </div>
			  <button type="submit" class="btn btn-default" name="submit">Enviar</button>
			  <a   id = "back" class="btn btn-default" name="cancel">Cancelar</a>
			</form>
	    	
		  </div>
		</div>
	</div>

</div>

{/block}


