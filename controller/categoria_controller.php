<?php 
	include_once "controller_class.php";
	include_once "paginador_controller.php";
	include_once "model/categoria_model.php";
	include_once "view/categoria_view.php";

	/**
	 * HomeController
	 * 
     */
	class CategoriaController extends Controller
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->model = new categoriaModel();
			$this->view  = new CategoriaView();
		}

		private $model;
		private $view;

		/**
		 * metodo getCategorias
		 * @return tipo Array() que contendra todas las categorias 
		 *         con sus subcategorias propias.
		 * */

		public function getCategorias(){
			$data = $this->model->loadCategoriasPadre();
			$menu = array();
			foreach ($data as $dato) {
				$menu[$dato["id_categoria"]]["categoria"] = $dato["v_descripcion"];
				$menu[$dato["id_categoria"]]["sub_categorias"] = array();
				$subCategorias =  $this->model->loadByCategoriaPadre($dato["id_categoria"]);
				foreach ($subCategorias as $sc) {
					$menu[$dato["id_categoria"]]["sub_categorias"][] = array(
							'id' => $sc["id_categoria"],
							'vDescripcion' => $sc["v_descripcion"]
						);
				}


			}
			return $menu;
		}

		/**
		 * dada una categoria devuelve su categoria padre y hermanos;
		 * */
		public function getByCategoria($id_categoria){
			$data = $this->model->getCategoriaPadreByCategoria($id_categoria);
			$menu = array();
			foreach ($data as $dato) {
				$menu[$dato["id_categoria"]]["categoria"] = $dato["v_descripcion"];
				$menu[$dato["id_categoria"]]["sub_categorias"] = array();
				$subCategorias =  $this->model->loadByCategoriaPadre($dato["id_categoria"]);
				foreach ($subCategorias as $sc) {
					$menu[$dato["id_categoria"]]["sub_categorias"][] = array(
							'id' => $sc["id_categoria"],
							'vDescripcion' => $sc["v_descripcion"]
						);
				}
			}
			return $menu;
		}

		public function getCategoriasEnComboByAjax(){
			$id_categoria = $this->getDataRequest(ConfigApp::$ID_CATEGORIA);
			$data = array();
			if ($id_categoria){
				// Devolver subcategorias
				$data = $this->model->loadByCategoriaPadre($id_categoria);

			} else {
				// Devolver categorias principales
				$data = $this->model->loadCategoriasPadre();

			}
			$categoriasEnCombo = array();
			for ($i = 0 ; $i < count($data); $i++){
				$categoriasEnCombo[] = array ('value' => $data[$i]['id_categoria'],
											  'text'  => $data[$i]['v_descripcion']);
			}
			$this->view->json($categoriasEnCombo);

		}

		/**
		 * Verifica si esxiste la id pasada por parametro
		 * @param $id
		 * @return boolean 
		 * */
		public function verifCategoriaId($id){
			$data = $this->model->verificarId($id);
			return (isset($data[0]['count']) && $data[0]['count'] > 0);
		}

		/**
		 * FUNCIONES ADMIN
		 * */

		public function listAllCategorias(){
			$this->view->listAllCategorias();
		}
		
		public function listAllCategoriasByAjax(){
			$paginador = new PaginadorController();
			$paginador->setTabla('view_categorias_pricipales');
			$paginador->setCols(array('id_categoria','v_descripcion'));
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

		public function listAllSubCategorias(){
			$id_categoria_padre = $this->getDataRequest('categoria');
			$categoria = $this->model->getById($id_categoria_padre);
			$nombre = isset($categoria[0]['v_descripcion']) ? $categoria[0]['v_descripcion'] : 'Categoría incorrecta';
			$this->view->listAllSubCategorias($nombre,$id_categoria_padre);
		}
		
		public function listAllSubCategoriasByAjax(){
			$paginador = new PaginadorController();
			$paginador->setTabla('categoria');
			$paginador->setCols(array('id_categoria','v_descripcion'));
			$paginador->setCant($this->getDataRequest('cant'));
			$paginador->setWhere(array('id_categoria_padre'=>  $this->getDataRequest('categoria')));
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

		public function editCategoria(){
			if ($this->isGet()){
				$id_categoria = $this->getDataRequest('categoria');
				$categoria = $this->model->getById($id_categoria);
				$this->view->editCategoria($id_categoria,$categoria[0]['v_descripcion']);
			}else if ($this->isPost() && $this->isAjax()){
				//update
				$this->saveCategoria(true);
			}
			header("Location: index.php?".ConfigApp::$ACTION."=".ConfigApp::$ACTION_LIST_ALL_CATEGORIAS);
			
		}

		public function newCategoria(){
			if ($this->isGet()){
				$this->view->newCategoria($this->getDataRequest('categoria'));
			}else if ($this->isPost() && $this->isAjax()){
				//insert
				$this->saveCategoria();
			}
			header("Location: index.php?".ConfigApp::$ACTION."=".ConfigApp::$ACTION_LIST_ALL_CATEGORIAS);
		}

		private function saveCategoria($update=false){
			$data = $this->getDataRequest('Categoria');
			if ($update){
				$this->model->updateCategoria($data['id_categoria'],$data['v_descripcion']);
			}else{
				$this->model->insertCategoria($data['v_descripcion'],($data['id_categoria_padre'] == "") ? null : $data['id_categoria_padre']);
			}
			$this->view->success(true);
		}

		public function bajaCategoriaByAjax(){
			$id_categoria = $this->getDataRequest('categoria');
			$categoria = $this->model->getById($id_categoria);
			if (count($categoria) > 0){
				//verificar que no tenga productos asociados si es subcategoria
				//verificar si es categoria principal que no tenga subcategorias
				if ($categoria[0]['id_categoria'] == $categoria[0]['id_categoria_padre'] ||
					$categoria[0]['id_categoria_padre'] == ""){
					//cate principal
					$hijos = $this->model->loadByCategoriaPadre($id_categoria);
					if (count($hijos) > 0){
						$json = array('success' => false, 'info' => 'Esta categoría tiene asignadas sub-categorías, no se puede eliminar');
						return $this->view->json($json);
					}

					$this->model->deleteCategoria($id_categoria);
					return $this->view->success(true);

				}else {
					//sub-categoria
					$productos = $this->model->countProductosxCategoria($id_categoria);
					if ($productos > 0){
						$json = array('success' => false, 'info' => 'Esta categoría tiene productos asignados, no se puede eliminar');
						return $this->view->json($json);
					}

					$this->model->deleteCategoria($id_categoria);
					return $this->view->success(true);
				}
			}
			$this->view->success(false);
		}


	}

 ?>