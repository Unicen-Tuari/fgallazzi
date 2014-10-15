<ul class="nav nav-pills nav-stacked" id = "menubar">
{foreach from=$dataMenu item=c}
	<li>
		<a > {$c.categoria}</a>
		<ul class="nav nav-pills nav-stacked hidden">
			{foreach from=$c.sub_categorias item=sc}
				<li id = {$sc.id}>
					<a  href="index.php?action=productos&categoria={$sc.id}&page=1"> {$sc.vDescripcion}
					
					<span class = "pull-right">
						
					</span>
					</a>
				</li>
			{/foreach}	
		</ul>
	</li>  

{/foreach}
</ul>
