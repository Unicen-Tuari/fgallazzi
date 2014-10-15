<?php 
	include_once "view_class.php";


	/**
	 * CLase ProductoView
	 */
	class ProductoView extends View
	{
		/**
		 * Constructor
		 * */
		function __construct($pathUser=false)
		{
			parent::__construct($pathUser);
			$this->addDir("./templates/producto/");
			$this->set("ACTION",ConfigApp::$ACTION);
			$this->set("ACTION_DETALLE",ConfigApp::$ACTION_DETALLE);
		}

		private $listadoPorCategoriaTpl = "listadoPorCategoria.tpl";
		private $listadoVacioTpl = "listadoVacio.tpl";
		/**
		 * metodo listadoPorCategoria
		 * Visualizara un listado de los productos indicado por la id de categoria
		 * @param $productos productos a mostrar
		 * @param $allCategorias categorias a mostrar en el menu
		 * */
		
		public function setTitle($title){
			$this->set("title",$title);
		}
		public function listadoPorCategoria($params){
			$this->setParams($params);
			$this->render($this->listadoPorCategoriaTpl);
		}

		public function listadoVacio($params){
			$this->setParams($params);
			$this->render($this->listadoVacioTpl);
		}
	}


 ?>