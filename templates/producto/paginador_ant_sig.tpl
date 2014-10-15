<ul class="pager">
  
  <li {if $page == 1}	class="previous disabled" {else}  class="previous"  {/if}>

    <a {if $page > 1} href="?action=productos&categoria={$id}&page={$page - 1}&ini={$nPagina_ini}&fin={$nPagina_fin}" {/if}><i class = "glyphicon glyphicon-arrow-left"> </i> Anterior</a>
  </li>

  <li {if $page >= $nPagina_max} class="next disabled" {else} class="next" {/if}>

     <a {if $page < $nPagina_max} href="?action=productos&categoria={$id}&page={$page + 1}&ini={$nPagina_ini}&fin={$nPagina_fin}"  {/if}>Siguiente <i class = "glyphicon glyphicon-arrow-right"></i></a>
  </li>

</ul>