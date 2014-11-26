<?php 
	include_once "controller_class.php";
	include_once "model/producto_model.php";
	include_once "view/carrito_view.php";
	include_once "model/carrito_model.php";
	include_once "controller/mail_controller.php";
	include_once "view/mails_view.php";
	include_once "paginador_controller.php";

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
			$id_carrito = $this->getCarritoActivo();
			if ($id_carrito === false){
				$json = array('success' => false, 'info' => 'Aún no se ha seleccionado dingun producto');
				return $this->view->json($json);
			}
			
			// LLegado aqui recuperar los productos que tiene el carrito

			$productos = $this->model->getProductosXCarrito($id_carrito);
			// Devolver el carrito con toda la info
			if (count($productos) == 0){
				$json = array('success' => false, 'info' => 'Aún no se ha seleccionado dingun producto');
				return $this->view->json($json);
			}else{
				$params = array(
					'productos' => $productos
					);
				$html = $this->view->carritoCompraByAjax($params);
				
				$json = array(
					'success' => true,
					'html' => $html
					);
				$this->view->json($json);
			}
		}

		public function insertarProductoAlCarritoByAjax(){

			$idProducto = $this->getDataRequest(ConfigApp::$ID_PRODUCTO);
			
			if ($this->isPost() && $idProducto){

				$id_carrito = $this->getCarritoActivo(true);

				$productoModel = new ProductoModel();
				$producto = $productoModel->getById($idProducto);
				if (count($producto) > 0){
					//verificar si ya esta en el carrito
					$pxc = $this->model->getProductoXCarritoById($idProducto,$id_carrito);
					if (count($pxc) > 0) {
						return $this->view->json(array('success'=>false,'existe'=>true));
					}
					$data = array(':id_producto' => $idProducto, ':id_carrito' => $id_carrito, 
				           ':n_cantidad'=> 1, ':f_precio_unidad'=>$producto[0]['f_precio']);
					

					$this->model->insertProductoXCarrito($data);
					$this->view->success(true);
				}
			}
			$this->view->success(false);
		}

		public function updateCarritoByAjax(){
			$id_usuario = $this->getDataSession('id');
			$id_carrito = $this->getCarritoActivo(false);

			if ($this->isPost() && $id_carrito !== false){
				$id_producto = $this->getDataRequest('product');
				$data_pxc = $this->model->getProductoXCarritoById($id_producto,$id_carrito);
				switch ($this->getDataRequest('action_update')) {
					case 'inc':
						$n_cantidad = $data_pxc[0]['n_cantidad'] + 1;
						$this->model->updateProductoXCarritoById($id_producto,$id_carrito,$n_cantidad);
						$json = array('success' => true,
									  'n_cantidad' => $n_cantidad,
							          'f_total' => $data_pxc[0]['f_precio_unidad'] * $n_cantidad);
						return $this->view->json($json);
					case 'dec':
						$n_cantidad = $data_pxc[0]['n_cantidad'] - 1;
						if ($n_cantidad > 0) {
							$this->model->updateProductoXCarritoById($id_producto,$id_carrito,$n_cantidad);
							$json = array('success' => true,
										  'n_cantidad' => $n_cantidad,
							        	  'f_total' => $data_pxc[0]['f_precio_unidad'] * $n_cantidad);
							return $this->view->json($json);
						}
						return $this->view->success(false);
						break;
					case 'del':
						$this->model->deleteProductoXCarritoById($id_producto,$id_carrito);
						$json = array('success' => true,
									  'n_cantidad' => '-1');
						return $this->view->json($json);
						break;
					
					default:
						break;
				}

			}

		}

		public function confirmarCompra(){
			$id_usuario = $this->getDataSession('id');
			$id_carrito = $this->getCarritoActivo();

			if ($this->isPost() && $id_carrito !== false){
				//verificar que el carrito no este vacio
				$productosXC = $this->model->getProductosXCarrito($id_carrito);
				if (count($productosXC) == 0){
					$json = array('success' => false,'info' => "Su carrito de compras esta vacío");
					return $this->view->json($json);
				}
				// confirmar la compra en la base
				//$this->model->confirmarCarrito($id_carrito,$id_usuario);

				//enviar mails
				$mail = new MailController();
				$productoModel = new ProductoModel();
				$mailsView = new MailsView();
				
				// cliente listado con todos los productos
				$mensaje = $mailsView->listadoProductos($productosXC);
				$destino = 'franciscogallazzi@gmail.com';
				$nombre = 'Francisco Gallazzi';
				$subject = 'Pedido de compra';
				$mail->send($destino,$nombre,$subject,$mensaje);
				
				// vendedor

				// admin
				

				return $this->view->success(true);
			}
			
		}

		private function getCarritoActivo($crear=false){
			$id_usuario = $this->getDataSession('id');
			$carrito = array();
			$carrito = $this->model->getCarritoActivo($id_usuario);
			//si aun no se ha creado, crear nuevo carrito
			$id_carrito = false;
			if (count($carrito) == 0 && $crear){
				$id_carrito = $this->model->nuevoCarrito($id_usuario);
			}else if (count($carrito) > 0){
				// verificar que no ha caducado caso contrario darlo de baja 
				$id_carrito = $carrito[0]['id_carrito'];
				$ts = ($carrito[0]['ts_actualizado'] != null ) ? $carrito[0]['ts_actualizado'] : $carrito[0]['ts_creado'];
	    
			    if (strtotime($carrito[0]['now']) - strtotime($ts) > ConfigApp::VIDA_CARRITO ){
			    	$this->model->bajaCarrito($id_carrito);
			    	// si $crear esta en true, crea el carrito
			    	if ($crear){
			    		$id_carrito = $this->model->nuevoCarrito($id_usuario);
			    		$carrito = $this->model->getCarritoActivo($id_usuario);
			    	} else {
			    		$id_carrito = null;
			    	}
			    } 
			}
			return $id_carrito;
		}

		/**
		 * FUNCIONES ADMIN
		 * */

		public function listAllCompras(){
			$this->view->listAllCompras();
		}
		
		public function listAllComprasByAjax(){
			$paginador = new PaginadorController();
			$paginador->setTabla('view_compras');
			$paginador->setCols(array('id_carrito','cantTotalUnidades','montoTotal','vFecha','vUsuario'));
			$paginador->setCant($this->getDataRequest('cant'));
			//$paginador->setWhere(array('id_usuario'=>2));
			$paginador->setPage($this->getDataRequest('page'));
			$paginador->setTxt($this->getDataRequest('txt'));
			
			$data = $paginador->getPage();

			$cantPages = $paginador->getCountPages();
			$page = $paginador->getNPage();

			$json = array(
				'success' => true,
				'rows' => $data,
				'cant_pages' => $cantPages,
				'page' => $page,
				);
			return $this->view->json($json);
		}
	}

 ?>