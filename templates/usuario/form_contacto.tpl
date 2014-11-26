

{extends file="layout-trastos-atipico.tpl"}
{block name = scriptJS}

	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/additional-methods.min.js"></script>
	<script type="text/javascript" src="js/form_contacto.js"></script>

{/block}
{block name=body}


<div class="container">
	<div class="page-header">
	  <h1>Formulario de Contacto <small> trastos.com</small></h1>
	</div>

	<div class="panel panel-default">
	  <div class="panel-body">
	  	<form class="form-horizontal" role="form" id = "ContactoForm">

	  	  <div class="form-group marca">
		    <label for="nombre" class="col-lg-2 control-label">Nombre</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" id="nombre" name ="Contacto[nombre]"
		             placeholder="Nombre">
		    </div>
		  </div>

		  <div class="form-group marca">
		    <label for="apellido" class="col-lg-2 control-label">Apellido</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" id="apellido" name ="Contacto[apellido]"
		             placeholder="Apellido">
		    </div>
		  </div>	

		  <div class="form-group marca">
		    <label for="email" class="col-lg-2 control-label">Email</label>
		    <div class="col-lg-10">
		      <input type="email" class="form-control" id="email" name="Contacto[email]"
		             placeholder="Email">
		    </div>
		  </div>

		  <div class="form-group marca">
		    <label for="comentario" class="col-lg-2 control-label">Comentario</label>
		    <div class="col-lg-10">
		      <textarea  class="form-control" id="comentario" name ="Contacto[comentario]"
		             placeholder="Comentario"></textarea>
		    </div>
		  </div>	

		  <div class="form-group">
		    <div class="col-lg-offset-2 col-lg-10">
		      <button type="submit" name ="submit" class="btn btn-default">Enviar</button>
		    </div>
		  </div>

		</form>



	  </div>
	</div>	

</div>



{/block}


