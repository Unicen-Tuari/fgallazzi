

{extends file="layout-trastos.tpl"}

{block name=scriptJS}
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/publicar_producto.js"></script>
{/block}

{block name=body}

<div class="container container-publicar">
	<div class="row">
	<div class="col-sm-10 col-sm-push-1">
		<ul class="nav nav-tabs" role="tablist" id ="publicar_tab">
		  <li class="active"><a href="#info" role="tab" >Informaci&oacute;n principal</a></li>
		  <li class="disabled"><a href="#caracteristicas" role="tab" >Caracteristicas</a></li>
		  <li class="disabled"><a href="#imagenes" role="tab" >Im&aacute;genes</a></li>
		  <li class="disabled"><a href="#confirmar" role="tab" >Confirmar</a></li>
		</ul>
		<form class="form-horizontal" id = "publicar_producto_guardar" action = "index.php" method="post" enctype="multipart/form-data">
		 <!--input type="hidden" name = "{$ACTION}" value = "{$ACTION_CARGAR_PUBLICACION}"-->
		
		<div class="tab-content">
			
		<div class="col-sm-8 col-sm-push-2 tab-pane fade in active " id ="info" complete="false">
			<div class="page-header">
				<h2>Informaci&oacute;n principal
			    <button id = "publicar_producto_info" class="btn btn-default pull-right">Siguiente</button>
			    </h2>
			</div>
			  <!-- CATEGORIA PRINCIPAL-->
			  <div class="form-group">
			    <label for="categoria_principal" class="col-lg-2 control-label">Categor&iacute;a</label>
			    <div class="col-lg-10 marca">
			      <select class="form-control" id = "categoria_principal" name = "info[categoria_principal]">
			      </select>
			    </div>
			  </div>
			  <!-- SUB CATEGORIA -->
			  <div class="form-group">
			    <label for="sub_categoria" class="col-lg-2 control-label">Sub-categor&iacute;a</label>
			    <div class="col-lg-10 marca">
			      <select class="form-control" id = "sub_categoria" name = "info[sub_categoria]">
			      </select>
			    </div>
			  </div>

			  <!-- NOMBRE -->
			  <div class="form-group">
			    <label for="nombre" class="col-lg-2 control-label">Nombre</label>
			    <div class="col-lg-10 marca">
			      <input type="text" class="form-control" id="nombre" name="info[nombre]"
			             placeholder="Nombre">
			    </div>
			  </div>

			  <!-- DESCRIPCION -->
			  <div class="form-group">
			    <label for="descripcion" class="col-lg-2 control-label">Descripci&oacute;n</label>
			    <div class="col-lg-10 marca">
			      <textarea class="form-control" rows="7" id="descripcion" name="info[descripcion]" placeholder="Descripci&oacute;n"></textarea>
			    </div>
			  </div>

			  <!-- PRECIO -->
			  <div class="form-group">
			    <label for="precio" class="col-lg-2 control-label">Precio</label>
			    <div class="col-lg-10 marca">
			      <input type="text" class="form-control" id="precio" name="info[precio]"
			             placeholder="Precio">
			    </div>
			  </div>

			  
		</div>

		<!--CARACTERISTICAS-->
		<div class="col-sm-8 col-sm-push-2 tab-pane fade " id ="caracteristicas" complete="false">
			<div class="page-header">
				<h2>Caracteristicas <small>opcional</small><button id="btn-caracteristicas-siguiente" class="btn btn-default pull-right">Siguiente</button>
			    </h2>
			</div>
			<div class="form-horizontal" role="form" id="publicar_producto_caracteristicas">

			</div>
		</div>

		<!--IMAGENES-->
		<div class="col-sm-8 col-sm-push-2 tab-pane fade " id ="imagenes" complete="false">
			<div class="page-header">
				<h2>Im&aacute;genes
				<button id = "btn-publicar_producto_imagenes" class="btn btn-default pull-right">Siguiente</button>
			    </h2>
				
			</div>
			<div class="form-horizontal" role="form" id="publicar_producto_imagenes">
				<div class="row">
					<div class="col-sm-4 marca">
						<div class="thumbnail">
							<img src="img/sin_imagen_disponible.jpg" class="img-responsive">
							<div class="caption">
						        <label for = "file_1" class="btn btn-xs btn-primary" role="button" name="file_1">Agregar</label>
						        <input type="file" id = "file_1" name = "imagenes[file_1]" class="hidden" accept="image/gif,image/jpg,image/png" value=""/>
						    </div>
						</div>
					</div>
					<div class="col-sm-4 marca">
						<div class="thumbnail">
							<img src="img/sin_imagen_disponible.jpg" class="img-responsive">
							<div class="caption">
						        <label for = "file_2" class="btn btn-xs btn-primary" role="button">Agregar</label>
						        <input type="file" id = "file_2" name = "imagenes[file_2]"  class="hidden" accept="image/gif,image/jpg,image/png" value="" />
						    </div>
						</div>
					</div>
					<div class="col-sm-4 marca">
						<div class="thumbnail">
							<img src="img/sin_imagen_disponible.jpg" class="img-responsive">
							<div class="caption">
						        <label for = "file_3" class="btn btn-xs btn-primary" role="button">Agregar</label>
						        <input type="file" id = "file_3" name = "imagenes[file_3]"  class="hidden" accept="image/gif,image/jpg,image/png" value="" />
						    </div>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-sm-4 marca">
						<div class="thumbnail">
							<img src="img/sin_imagen_disponible.jpg" class="img-responsive">
							<div class="caption">
						        <label for = "file_4" class="btn btn-xs btn-primary" role="button">Agregar</label>
						        <input type="file" id = "file_4" name = "imagenes[file_4]"  class="hidden" accept="image/gif,image/jpg,image/png" value=""/>
						    </div>
						</div>
					</div>
					<div class="col-sm-4 marca">
						<div class="thumbnail">
							<img src="img/sin_imagen_disponible.jpg" class="img-responsive">
							<div class="caption">
						        <label for = "file_5" class="btn btn-xs btn-primary" role="button">Agregar</label>
						        <input type="file" id = "file_5" name = "imagenes[file_5]"  class="hidden" accept="image/gif,image/jpg,image/png" value=""/>
						    </div>
						</div>
					</div>
					<div class="col-sm-4 marca">
						<div class="thumbnail">
							<img src="img/sin_imagen_disponible.jpg" class="img-responsive">
							<div class="caption">
						        <label for = "file_6" class="btn btn-xs btn-primary" role="button">Agregar</label>
						        <input type="file" id = "file_6" name = "imagenes[file_6]"  class="hidden" accept="image/gif,image/jpg,image/png" value=""/>

						    </div>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<!--CONFIRMAR-->
		<div class="col-sm-8 col-sm-push-2 tab-pane fade " id ="confirmar" complete="false">
			<div class="page-header">
				<h2>Confirmar
				<small> y publicar el producto</small>
				<button for = "publicar_producto_guardar" type="submit" name="submit" class="btn btn-primary pull-right">Guardar</button>
			    </h2>
			</div>
			
		</div>
		</div>

		</form>
		</div>
	</div>
</div>

{include file = "modal_success.tpl"}

{/block}

{block name=footer}
	
{/block}

