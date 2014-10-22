<?php 
	include_once "controller_class.php";
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
	}

 ?>