 		<h3 class="text-left">
 			Categor&iacute;as
 		</h3>
	  	<div class="row">
	  	{foreach from=$allCategorias item=c}
	  		<div class = "col-sm-3">
		  		<h4>{$c.categoria}</h4>
		  		<ul>
					{foreach from=$c.sub_categorias item=sc}
						<li class="list-inline">
							<a href="index.php?action=productos&categoria={$sc.id}"> {$sc.vDescripcion}</a>
						</li>
					{/foreach}	
				</ul>
			</div>
		{/foreach}
	  	</div>

