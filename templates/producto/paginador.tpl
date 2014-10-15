<p class="text-right">
	P&aacute;gina {$page} de {$nPagina_max}
</p>

<ul class="pagination pagination-sm pagination-trastos">

	<li	{if $page == 1}	class="disabled" {/if}>

	<a {if $page != 1}	href="?action=productos&categoria={$id}&page={$page - 1}&ini={$nPagina_ini}&fin={$nPagina_fin}" {/if}>&laquo;</a>

	</li>

		{for $foo=$nPagina_ini to $nPagina_fin}
			<li 
				{if $page == $foo}
					class="active" 
				{/if}

			><a href="?action=productos&categoria={$id}&page={$foo}&ini={$nPagina_ini}&fin={$nPagina_fin}">{$foo}</a></li>
		{/for}
	
	<li{if $page >= $nPagina_max }	class="disabled" {/if}>
	
		<a {if $page < $nPagina_max}	href="?action=productos&categoria={$id}&page={$page + 1}&ini={$nPagina_ini}&fin={$nPagina_fin}" {/if}>&raquo;</a>

	</li>

</ul>



