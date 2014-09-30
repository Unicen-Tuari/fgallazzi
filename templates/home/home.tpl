

{extends file="layout-trastos.tpl"}


{block name=body}
{include file = "jumbotron.tpl"}

<div class="container">
	Contenido	
</div>

{include file = "listado_categorias.tpl" allCategorias = $allCategorias}

{/block}


