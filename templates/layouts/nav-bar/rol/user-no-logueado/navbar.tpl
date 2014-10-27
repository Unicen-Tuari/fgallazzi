<nav class="navbar-inverse navbar-default navbar-trastos" role="navigation" id= "navbar-trastos">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="index.php?action=home">
			<img src="img/trastos2.png" class="img-responsive img-trastos">
		</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li ><a href="index.php?action=home" name = "home">Home</a></li>
			<li><a href="#"></a></li>
		</ul>
		<form class="navbar-form navbar-left" role="search" id="buscador" method="post">
			<div class="form-group">
				<input type="hidden" name = "action" value = "buscar"/>
				<input type="text" class="form-control" placeholder="Buscar" id="buscar_txt" name = "buscar_txt" 
					{if isset($txt_buscar)} value="{$txt_buscar}" {/if}>
			</div>
			<button type="submit" class="btn btn-default">Go</button>
		</form>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="index.php?action=publicar" name="publicar">Publicar</a></li>
			<li ><a  id = "#carrito_compra" onclick="miCarrito_onclick();">Mi Carrito</a></li>
			<li ><a  id = "#form_login" onclick="formLogin_onclick();">Login</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">M&iacute; cuenta <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Acción 1</a></li>
					<li><a href="#">Acción 1</a></li>
					<li><a href="#">Acción 1</a></li>
					<li><a href="#">Acción 1</a></li>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>