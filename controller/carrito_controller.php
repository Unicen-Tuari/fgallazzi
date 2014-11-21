<?php 
	include_once "controller_class.php";
	include_once "model/producto_model.php";
	include_once "view/carrito_view.php";
	include_once "model/carrito_model.php";

	/**
	 * CarritoController
	 * 
     */
	class CarritoController extends Controller
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->model = new CarritoModel();
			$this->view = new CarritoView();
			
		}

		/**
		 * Atributos
		 * */
		private $model;
		private $view;

		/**
		 * visualizara el carrito de compras
		 * */

		public function carritoCompraByAjax(){

			$id_usuario = $this->getDataSession('id');

			$carrito = $this->model->getCarritoActivo($id_usuario);

			// 1°
			// Si el carrito es nulo devolver un mensaje diciendo que no hay productos seleccionados.
			if (count($carrito) == 0){
				//
				$json = array('success' => false, 'info' => 'Aún no se ha seleccionado dingun producto');
				return $this->view->json($json);
			}

			// 2°
			// Si existe verificar que no ha caducado caso contrario darlo de baja y realizar punto 1
			// 
		    $ts = ($carrito[0]['ts_actualizado'] != null ) ? $carrito[0]['ts_actualizado'] : $carrito[0]['ts_creado'];
		    
		    if (strtotime($carrito[0]['now']) - strtotime($ts) > ConfigApp::VIDA_CARRITO ){
		    	$json = array('success' => false, 'info' => 'Aún no se ha seleccionado dingun producto');
				return $this->view->json($json);
		    }

			
			// 3°
			// LLegado aqui recuperar los productos que tiene el carrito

			$productos = $this->model->getProductosXCarrito($carrito[0]['id_carrito']);

			// 4°
			// Devolver el carrito con toda la info
			$params = array(
				'carrito' => $carrito[0],
				'productos' => $productos
				);
			$this->view->carritoCompraByAjax($params);
		}

		public function insertarProductoAlCarritoByAjax(){

			$idProducto = $this->getDataRequest(ConfigApp::$ID_PRODUCTO);
			
			if ($this->isPost() && $idProducto){

				$id_carrito = $this->getCarritoActivo(true);

				$productoModel = new ProductoModel();
				$producto = $productoModel->getById($idProducto);
				if (count($producto) > 0){
					$data = array(':id_producto' => $idProducto, ':id_carrito' => $id_carrito, 
				           ':n_cantidad'=> 1, ':f_precio_unidad'=>$producto[0]['f_precio']);
					

					$this->model->insertProductoXCarrito($data);
					$this->view->success(true);
				}
			}
			$this->view->success(false);
		}

		private function getCarritoActivo($crear=true){

			$id_usuario = $this->getDataSession('id');
			$id_carrito = $this->getDataSession('id_carrito');
			$carrito = array();
			//si el carrito no esta en la sesion, buscarlo en la base
			if ($id_carrito === false){
				$carrito = $this->model->getCarritoActivo($id_usuario);
				//si aun no se ha creado, crear nuevo carrito
				if (count($carrito) == 0){
					$id_carrito = $this->model->nuevoCarrito($id_usuario);
				}else {
					// verificar que no ha caducado caso contrario darlo de baja 
					$id_carrito = $carrito[0]['id_carrito'];
					$ts = ($carrito[0]['ts_actualizado'] != null ) ? $carrito[0]['ts_actualizado'] : $carrito[0]['ts_creado'];
		    
				    if (strtotime($carrito[0]['now']) - strtotime($ts) > ConfigApp::VIDA_CARRITO ){
				    	$this->model->bajaCarrito($id_carrito);
				    	// si $crear esta en true, crea el carrito
				    	if ($crear){
				    		$id_carrito = $this->model->nuevoCarrito($id_usuario);
				    	} else {
				    		$id_carrito = null;
				    	}
				    } else {
				    	//Setear en session todos los productos del carrito
				    } 
				}
				
				//setear el id_carrito en session
				if ($id_carrito != null){
					$this->setDataSession(array('id_carrito' => $id_carrito));
				}
			}
			return $id_carrito;
		}
	}

 ?>