 <div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Categor&iacute;as</h3>
	  </div>
	  <div class="panel-body">
	  	<div class="row">
	  	{foreach from=$allCategorias item=c}
	  		<div class = "col-sm-3">
		  		<h4>{$c.categoria}</h4>
		  		<ul>
					{foreach from=$c.sub_categorias item=sc}
						<li class="list-inline">
							<a href="{$sc.id}"> {$sc.vDescripcion}</a>
						</li>
					{/foreach}	
				</ul>
			</div>
		{/foreach}
	  	</div>
	  </div>
	</div>
 </div>

