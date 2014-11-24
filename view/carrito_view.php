<?php 
	include_once "view_class.php";

	/**
	 * CLase HomeView
	 */
	class CarritoView extends View
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->addDir("./templates/carrito/");
			$this->set("ACTION",ConfigApp::$ACTION);
			$this->set("ACTION_DETALLE",ConfigApp::$ACTION_DETALLE);
			$this->set("ID_PRODUCTO",ConfigApp::$ID_PRODUCTO);
		}

		private $carritoModalTpl = "modal_carrito.tpl";
		
		/**
		 * metodo carritoCompraByAjax
		 * Visualizara el modal_carrito
		 * 
		 * */
		
		public function carritoCompraByAjax($params){
			$this->setParams($params);
			return $this->read($this->carritoModalTpl);
		}
	}


 ?>