<?php 
	include_once "controller_class.php";
	include_once "view/caracteristica_view.php";
	include_once "model/caracteristica_model.php";

	/**
	 * CaracteristicaController
	 * 
     */
	class CaracteristicaController extends Controller
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->model = new CaracteristicaModel();
			$this->view  = new CaracteristicaView();
		}

		/**
		 * Atributos
		 * */
		private $model;
		private $view;

		public function getAllCaracteristicasPorCategoriaByAjax(){
			$id_categoria = $this->getDataRequest(ConfigApp::$ID_CATEGORIA);
			$data = array();
			if ($id_categoria){
				// dada una categoria
				$data = $this->model->getAllByCategoria($id_categoria);
			}else{
				// todo

			}

			// Generar arreglo que contenga las claves value text

			$r = array();

			for ($i=0; $i < count($data); $i++) { 
				$r[] = array('value' => $data[$i]['id_caracteristica'],
							 'text'  => $data[$i]['v_nombre']);
			}
			
			$this->view->json($r);
		}

	}

 ?>