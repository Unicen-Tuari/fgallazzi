
<div class="modal fade" id="modal-carrito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Trastos.com <small>Mi Carrito</small></h4>
      </div>
      <div class="modal-body">
        <h4>Productos</h4>

        <table class="table table-hover">
          <thead>
            <tr>
              <th>
                Producto
              </th>
              
              <th>
                Vendedor
              </th>
              <th>
                Precio
              </th>
              <th>
                Cant.
              </th>
              <th>
                Total
              </th>
            </tr>  
          </thead>
          <tbody>
            {foreach from=$productos item = p}
              <tr>
                <td>{$p.v_nombre_producto}</td>
              
                <td>{$p.v_usuario}</td>
              
                <td>${$p.f_precio_unidad}</td>

                <td>{$p.n_cantidad}</td>
              
                <td>${$p.n_cantidad * $p.f_precio_unidad}</td>
              </tr>    
            {/foreach}
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>