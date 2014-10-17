

{extends file="layout-trastos.tpl"}

{block name=scriptJS}

	<script type="text/javascript" src = "js/menubar.js">
	</script>
{/block}

{block name=body}


<div class="container">
	<h1 class="text-center"> Listado de productos </h1>

	<div class="row">
			<div class="hidden-xs  col-sm-3 col-md-3">
				{include file = "menubar.tpl"  dataMenu = $dataMenu}
			</div>
			<div class="col-xs-12 col-sm-9 col-md-9">
				<div class = "row ">
					<div class="col-xs-12">	
						<div class = "pull-right">
						{include file="paginador.tpl" nPagina_ini = $nPagina_ini nPagina_fin =$nPagina_fin page = $page id = $id nPagina_max=$nPagina_max}	
						</div>
						
					</div>
				</div>	
				{foreach from=$productos item = p}
					<div class="row row-trastos">
						<div class="col-xs-12 col-sm-3 col-md-2" >
							<a href="">
								<img src={$p.v_img_path} class="thumbnail img-responsive img-producto center-block">
							</a>
							
						</div>
						<div class="col-xs-12 col-sm-9 col-md-10 " >
							<div class="row">
								<div class="col-sm-8 col-md-9">
									<h3 class="txt-nombre-producto">
										<a href="index.php?{$ACTION}={$ACTION_DETALLE}&{$ID_PRODUCTO}={$p.id_producto}">
											{$p.v_nombre}	
										</a>
									</h3>
									<p>
										{$p.v_descripcion}

									</p>
								</div>
								<div class="col-sm-4 col-md-3 hidden-xs">
									<span class="label label-default info-precio-producto ">$ {$p.f_precio|number_format:2:',':'.'}</span>

									<span class = "info-extra-producto">
										Desde: 										{$p.ts_creado|date_format}
									</span>
									<span class = "info-extra-producto">
										<i class = "glyphicon glyphicon-eye-open"></i>
										{$p.n_visitado}
									</span>
									
								</div>
								
								
								<div class="col-xs-12 txt-nombre-producto visible-xs">
									<span class="label label-default">$ {$p.f_precio|number_format:2:',':'.'}</span>
								</div>
								
							</div>

							
							
							
							

						</div>

					</div>


				{/foreach}

				
				{include file="paginador_ant_sig.tpl" nPagina_ini = $nPagina_ini nPagina_fin =$nPagina_fin page = $page id = $id nPagina_max=$nPagina_max}			

			</div>

	</div>

	
</div>


{/block}

{block name=footer}
	{include file = "footer-trastos.tpl" allCategorias = $allCategorias}
{/block}

