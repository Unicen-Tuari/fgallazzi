<?php 
	include_once "controller_class.php";
	include_once "model/categoria_model.php";

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
		}

		private $model;

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