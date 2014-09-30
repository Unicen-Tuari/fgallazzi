<?php 
	include_once "view_class.php";

	/**
	 * CLase HomeView
	 */
	class HomeView extends View
	{
		/**
		 * Constructor
		 * */
		function __construct($pathUser=false)
		{
			parent::__construct($pathUser);
			$this->addDir("./templates/home/");
		}

		private $homeTpl = "home.tpl";
		/**
		 * metodo home
		 * Visualizara el homePage
		 * @param $allCategorias categorias a mostrar
		 * */
		
		public function home($allCategorias){
			$this->set("allCategorias",$allCategorias);
			$this->render($this->homeTpl);
		}
	}


 ?>