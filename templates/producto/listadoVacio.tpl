

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
				<div class="alert alert-warning">
				<h2 class="text-center">
					A&uacute;n no hay productos disponibles en esta categor&iacute;a!!!
				</h2>		
				</div>
			</div>
	</div>
</div>


{/block}

{block name=footer}
	{include file = "footer-trastos.tpl" allCategorias = $allCategorias}
{/block}

