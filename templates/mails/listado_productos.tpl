        <h4>Productos</h4>

        <table class="table table-hover" id ="table-carrito">
          <thead>
            <tr>
              <th>
                &nbsp;
              </th>
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
              <tr id="{$p.id_producto}">
                <td>
                  <div class="carrito-delete">
                  <i class="glyphicon glyphicon-remove-circle"
                     onclick = "delProducto({$p.id_producto});"></i>
                  </div>
                </td>
                <td><a href="index.php?{$ACTION}={$ACTION_DETALLE}&{$ID_PRODUCTO}={$p.id_producto}">{$p.v_nombre_producto}</a></td>
              
                <td>{$p.v_usuario}</td>
              
                <td>${$p.f_precio_unidad}</td>

                <td name="n_cantidad">
                  <span>{$p.n_cantidad}</span>
                  <div class="carrito-up-down">
                    <i class="glyphicon glyphicon-chevron-up" 
                       onclick = "incCantidad({$p.id_producto});"></i>
                    <i class="glyphicon glyphicon-chevron-down"
                       onclick = "decCantidad({$p.id_producto});"></i>
                  </div>
                </td>
                <td name="f_total">${$p.n_cantidad * $p.f_precio_unidad}</td>
              </tr>    
            {/foreach}
          </tbody>
        </table>
      