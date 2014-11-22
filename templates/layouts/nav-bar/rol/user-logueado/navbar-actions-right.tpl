

<ul class="nav navbar-nav navbar-right">
	<li><a href="index.php?action=publicar" name="publicar">Publicar</a></li>
	<li ><a  id = "#carrito_compra" onclick="miCarrito_onclick();">Mi Carrito</a></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">{$NOMBRE_USER} <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
			<li onclick="salir_onclick();"><a >Salir</a></li>
		</ul>
	</li>
</ul>