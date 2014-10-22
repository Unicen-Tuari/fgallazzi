<?php 
	include_once "controller_class.php";
	include_once "view/carrito_view.php";

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
			$this->model = null;
			$this->view = new CarritoView($this->pathUser);
			
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
			$this->view->carritoCompraByAjax();
		}
	}

 ?>