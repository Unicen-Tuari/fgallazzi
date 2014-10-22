<?php 
	//sleep(1);
	/**
	 * Enrutador de peticiones
	 * Segun el pedido, instanciara su correspondiente Controlador.
	 * Por defecto sera HomeController.
	 * Si el pedido no se encuentra disponible, se mostrara una pagina 
	 *  informando que no existe tal pagina.
	 *  **/
	
	include_once "controller/config_app.php";
	include_once "controller/home_controller.php";
	include_once "controller/producto_controller.php";
	include_once "controller/categoria_controller.php";
	include_once "controller/caracteristica_controller.php";
	include_once "controller/carrito_controller.php";

	
	if (!array_key_exists(ConfigApp::$ACTION,$_REQUEST ) || $_REQUEST[ConfigApp::$ACTION] == ConfigApp::$ACTION_HOME){
		// Home del sitio
		$homeController = new HomeController();
		$homeController->home();
		
	}else if (array_key_exists(ConfigApp::$ACTION,$_REQUEST )){
		switch ($_REQUEST[ConfigApp::$ACTION]) {
			case ConfigApp::$ACTION_PRODUCTOS:
				$productoController = new ProductoController();
				$productoController->listadoPorCategoria();
				break;
			case ConfigApp::$ACTION_DETALLE:
				$productoController = new ProductoController();
				$productoController->detalleProducto();
				break;
			case ConfigApp::$ACTION_PUBLICAR:
				$productoController = new ProductoController();
				$productoController->publicarProducto();
				break;
			case ConfigApp::$ACTION_GET_CATEGORIAS:	
				$categoriaController = new CategoriaController();
				$categoriaController->getCategoriasEnComboByAjax();
				break;
			case ConfigApp::$ACTION_CARGAR_PUBLICACION:
				$productoController = new ProductoController();
				$productoController->cargarPublicacion();
				break;
			case ConfigApp::$ACTION_GET_CARACTERISTICAS:
				$caracteristicaController = new CaracteristicaController();
				$caracteristicaController->getAllCaracteristicasPorCategoriaByAjax();
				break;
			case ConfigApp::$ACTION_BUSCADOR:
				$productoController = new ProductoController();
				$productoController->buscarProducto();
				break;
			case ConfigApp::$ACTION_GET_ALL_PRODUCTOS_BY_AJAX:
				$productoController = new ProductoController();
				$productoController->getAllProductosByAjax();
				break;
			case ConfigApp::$ACTION_GET_CARRITO_BY_AJAX:
				$carritoController = new CarritoController();
				$carritoController->carritoCompraByAjax();
				break;
			default:
				echo "Pagina no encontrada";
				break;
		}

	}


 ?>