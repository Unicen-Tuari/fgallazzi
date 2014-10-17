<?php 
	include_once "controller_class.php";
	include_once "categoria_controller.php";
	include_once "model/categoria_model.php";
	include_once "model/producto_model.php";
	include_once "view/producto_view.php";

	/**
	 * HomeController
	 * 
     */
	class ProductoController extends Controller
	{
		
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->model = new ProductoModel();
			$this->view = new ProductoView($this->pathUser);
			
		}

		/**
		 * Atributos
		 * */

		private $view;
		private $model;

		// PUBLIC FUNCTIONS //

		/**
		 * visualizara un listado de productos dado por la categoria
		 * */

		public function listadoPorCategoria(){
			

			//Verificar que la id de categoria es correcta
			$categoriaController = new categoriaController();
			$idCategoria = $this->getDataRequest(ConfigApp::$ID_CATEGORIA);
			$dataMenu = $categoriaController->getByCategoria($idCategoria);
			$allCategorias = $categoriaController->getCategorias();
			if (!$categoriaController->verifCategoriaId($idCategoria)) {
				echo "categoria incorecta";
				exit();
			}
			

			//Recuperar los productos de la base
			//$data = $this->model->getAllByCategoria($idCategoria);
			
			$cant_elementos = 20; // cantidad de elementos por pagina
			$cant_paginas = 5; // cantidad de paginas en el paginador
			
			$arr = $this->getPage($cant_paginas,$cant_elementos,$idCategoria);
			$page = $arr['page'];
			$ini  = $arr['ini'];
			$fin  = $arr['fin'];
			$nPaginas = $arr['nPaginas'];

			$offset = $this->getOffset($page,$cant_elementos);

			$data = $this->model->getAllByCategoriaPaginado($idCategoria, $offset, $cant_elementos);
			
			if (count($data) > 0){
				//Mostrar la vista con los productos de forma paginada
				$params = array(
					"productos" => $data,
					"dataMenu" => $dataMenu,
					"allCategorias" => $allCategorias,
					"nPagina_ini" => $ini,
					"nPagina_fin" => $fin,
					"nPagina_max" => $nPaginas,
					"page" => $page,
					"id" => $idCategoria
					);
				$this->view->listadoPorCategoria($params);
			}else{
				//Mostrar la vista que no se han encontrado productos
				$params = array(
					"dataMenu" => $dataMenu,
					"allCategorias" => $allCategorias,
					"id" => $idCategoria
					);
				$this->view->listadoVacio($params);
			}
			
		}

		public function detalleProducto(){
			$id_producto = $this->getDataRequest(ConfigApp::$ID_PRODUCTO);
			if (!$this->model->verificarId($id_producto)){
				echo "producto inexistente";
				exit();
			}
			$data = $this->model->getById($id_producto);
			$caracteristicas = $this->model->getCaracteristicasByProducto($id_producto);
			$data = $data[0];
			if (count($caracteristicas) > 0){
				$caracteristicas[] = array('v_nombre' => "Precio",
										   'v_valor' => "$".$data['f_precio']);
			}
			
			$params = array(
				'data' => $data,
				'caracteristicas' => $caracteristicas
				);
			$this->view->detalleProducto($params);
		}

		//PRIVATE FUNCTIONS //
		private function getPage($cant_paginas,$cant_elementos,$idCategoria){

			$nPaginas = $this->countPage($cant_elementos,$idCategoria);

			if ($nPaginas == 0){
				return array('page' => 1, 'ini'=>1, 'fin'=>1, 'nPaginas' => 1);
			}

			$page = $this->getDataRequest("page");
			
			$ini = 1;
			$fin = $cant_paginas;
			if (!$page || $page <= 0){
				$page = 1;
			}
			if ($page != 1){
				$ini = $this->getDataRequest("ini");
				$fin = $this->getDataRequest("fin");
				if ((!$ini || !$fin) && $page > $cant_paginas){
					$ini = $page - floor($cant_paginas/2);
					$fin = $ini + $cant_paginas -1;
				}
			}

			if ($page > $nPaginas){
				$page = $nPaginas;
			}
			
			if ($page == $fin || $page == $ini){
				$ini = $page - floor($cant_paginas/2);
				$fin = $ini + $cant_paginas -1;
			}
			if ($fin > $nPaginas){
				$fin = $nPaginas;
				$ini = ($nPaginas - $cant_paginas +1) < 1 ? 1 : $nPaginas - $cant_paginas +1;
			}
			if ($ini < 1){
				$ini = 1;
				$fin =  ($cant_paginas > $nPaginas) ? $nPaginas : $cant_paginas;
			}

			return array('page' => $page, 'ini'=>$ini, 'fin'=>$fin, 'nPaginas' => $nPaginas);
		}

		private function countPage($cant,$idCategoria){
			$count = $this->model->count($idCategoria);
			$nPaginas = ceil($count / $cant);
			return $nPaginas;
		}

		private function getOffset($page, $cant){
			$offset = ($page - 1 ) * $cant;

			return $offset;

		}
		
		
	}

 ?>