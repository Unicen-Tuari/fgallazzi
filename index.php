<?php 
	/**
	 * Derivador de peticiones
	 * Segun el pedido, instanciara su correspondiente Controlador.
	 * Por defecto sera HomeController.
	 * Si el pedido no se encuentra disponible, se mostrara una pagina 
	 *  informando que no existe tal pagina.
	 *  **/
	include_once "controller/home_controller.php";
	include_once "controller/producto_controller.php";

	/**
	 * Constantes
	 * se definiran todos los action
	 * */
	define ('ACTION','action');
	define ('HOME','home');
	define ('LISTADO_PRODUCTOS_POR_CATEGORIA','productos');

	if (!array_key_exists(ACTION,$_REQUEST ) || $_REQUEST[ACTION] == HOME){
		// Home del sitio
		$homeController = new HomeController();
		$homeController->home();
		
	}else if (array_key_exists(ACTION,$_REQUEST )){
		switch ($_REQUEST[ACTION]) {
			case LISTADO_PRODUCTOS_POR_CATEGORIA:
				$productoController = new ProductoController();
				$productoController->listadoPorCategoria();
				break;
			
			default:
				echo "Pagina no encontrada";
				break;
		}

	}


 ?>