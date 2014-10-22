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
		function __construct($pathUser=false)
		{
			parent::__construct($pathUser);
			$this->addDir("./templates/carrito/");
		}

		private $carritoModalTpl = "modal_carrito.tpl";
		
		/**
		 * metodo carritoCompraByAjax
		 * Visualizara el modal_carrito
		 * 
		 * */
		
		public function carritoCompraByAjax(){
			return $this->render($this->carritoModalTpl);
		}
	}


 ?>