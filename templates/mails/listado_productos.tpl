<h1>{$titulo}</h1>

{if $esComprador == false}
  <h2>Datos del Comprador: </h2>
  <label>Nombre: {$nombre}</label>
  <br>
  <label>Apellido: {$apellido}</label>
  <br>
  <label>Emal: {$email}</label>
  <br>
  <label>Telefono: {$telefono}</label>
  <br>
{/if}

<table style = "border : 1px;">
  <thead>
    <tr>
      <th width="40%">
        Producto
      </th>
      {if $esComprador }
      <th width="20%">
        Vendedor
      </th>
      {/if}
      <th width="10%">
        Precio
      </th>
      <th width="10%">
        Cant.
      </th>
      <th width="20%">
        Total
      </th>
    </tr>  
  </thead>
  <tbody>
    {foreach from=$productos item = p}
      <tr>
        
        <td style = "text-align: center">{$p.v_nombre_producto}</td>

        {if $esComprador }
        <td style = "text-align: center">{$p.v_usuario}</td>
        {/if}

        <td style = "text-align: center">${$p.f_precio_unidad}</td>

        <td style = "text-align: center">{$p.n_cantidad}</td>

        <td style = "text-align: center">${$p.n_cantidad * $p.f_precio_unidad}</td>
      </tr>    
    {/foreach}
  </tbody>
</table>
      