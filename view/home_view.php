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
		function __construct($pathUser=false,$nameUser=false)
		{
			parent::__construct($pathUser,$nameUser);
			$this->addDir("./templates/home/");
			$this->set("ACTION",ConfigApp::$ACTION);
			$this->set("ACTION_PUBLICAR",ConfigApp::$ACTION_PUBLICAR);
		}

		private $homeTpl = "home.tpl";
		/**
		 * metodo home
		 * Visualizara el homePage
		 * @param $allCategorias categorias a mostrar
		 * */
		
		public function home($allCategorias){
			$this->set("title","Home : Trastos");
			$this->set("allCategorias",$allCategorias);
			$this->render($this->homeTpl);
		}
	}


 ?>