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
		function __construct()
		{
			parent::__construct();
			$this->addDir("./templates/producto/");
			$this->set("ACTION",ConfigApp::$ACTION);
			$this->set("ACTION_DETALLE",ConfigApp::$ACTION_DETALLE);
			$this->set("ID_PRODUCTO",ConfigApp::$ID_PRODUCTO);
			$this->set("ACTION_CARGAR_PUBLICACION",ConfigApp::$ACTION_CARGAR_PUBLICACION);
		}

		private $listadoPorCategoriaTpl = "listadoPorCategoria.tpl";
		private $listadoVacioTpl = "listadoVacio.tpl";
		private $detalleProductoTpl = "detalleProducto.tpl";
		private $publicarProductoTpl = "publicarProducto.tpl";
		private $buscarProductoTpl = "buscarProducto.tpl";
		private $listadoProductoTpl = "listadoProducto.tpl";

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
			$this->set("title","Listado por categor&iacute;a : Trastos");
			$this->setParams($params);
			$this->render($this->listadoPorCategoriaTpl);
		}

		public function listadoVacio($params){
			$this->set("title","Listado por categor&iacute;a : Trastos");
			$this->setParams($params);
			$this->render($this->listadoVacioTpl);
		}

		public function detalleProducto($params){
			$this->set("title","Detalle producto : Trastos");
			$this->setParams($params);
			$this->render($this->detalleProductoTpl);
		}

		public function publicarProducto(){
			$this->set("title","Publicar producto : Trastos");
			$this->render($this->publicarProductoTpl);
		}

		public function buscarProducto($params){
			$this->set("title","Busqueda productos : Trastos");
			$this->setParams($params);
			$this->render($this->buscarProductoTpl);
		}

		public function getTmpListadoByAjax(){
			$this->render($this->listadoProductoTpl);

		}
	}


 ?>