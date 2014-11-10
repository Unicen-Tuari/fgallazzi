<?php 
	include_once "controller_class.php";
	include_once "categoria_controller.php";
	include_once "view/home_view.php";
	include_once "model/categoria_model.php";

	/**
	 * HomeController
	 * 
     */
	class HomeController extends Controller
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->model = null;
			$this->view = new HomeView();
			
		}

		/**
		 * Atributos
		 * */
		private $model;
		private $view;

		/**
		 * visualizara el home del sitio
		 * */

		public function home(){
			$categoriaController = new categoriaController();
			$allCategorias = $categoriaController->getCategorias();
			$this->view->home($allCategorias);
		}
	}

 ?>