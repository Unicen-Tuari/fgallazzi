<?php 
	include_once "controller_class.php";
	include_once "view/usuario_view.php";
	include_once "model/usuario_model.php";


	/**
	 * UsuarioController
	 * 
     */
	class UsuarioController extends Controller
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->model = new UsuarioModel();
			$this->view = new UsuarioView($this->pathUser);
			
		}

		/**
		 * Atributos
		 * */
		private $model;
		private $view;

		/**
		 * visualizara el carrito de compras
		 * */

		public function formLoginByAjax(){
			$this->view->formLoginByAjax();
		}

		public function loginByAjax(){
			//Identificar la session
			$_SESSION['user'] = 'Troy McClure';
			$_SESSION['rol'] = 'ADMIN';
			$json = array('success' => true);
			$this->view->json($json);
		}
	}

 ?>