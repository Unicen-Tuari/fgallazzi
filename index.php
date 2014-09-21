<?php 
	/**
	 * Derivador de peticiones
	 * Segun el pedido, instanciara su correspondiente Controlador.
	 * Por defecto sera HomeController.
	 * Si el pedido no se encuentra disponible, se mostrara una pagina 
	 *  informando que no existe tal pagina.
	 *  **/

	include_once "controller/home_controller.php";

	if (!isset($_REQUEST['action']) || $_REQUEST['action'] == 'home'){
		// Home del sitio
		$homeController = new HomeController();
		$homeController->home();
		
	}else if (isset($_REQUEST['action'])){
		switch ($_REQUEST['action']) {
			case 'value':
				
				break;
			
			default:
				echo "Pagina no encontrada";
				break;
		}

	}


 ?>