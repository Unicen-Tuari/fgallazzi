<?php 
	// Libreria de Smarty
		require_once "libs/Smarty.class.php";
		include_once "controller/config_app.php";
	/**
	* Clase Padre View
	*/
	class View
	{
		
		
		/**
		 * Constructor
		 */
		function __construct($pathUser=false)
		{
			$this->templateEng = new Smarty();
			$this->set("pathUser",$pathUser);
			$this->addDir("./templates/layouts");
		}

		/**
		 * Atributos
		 */
		private $templateEng;


		protected function set($name,$value){
			$this->templateEng->assign($name,$value);
			

		}

		protected function render($file){
			$this->templateEng->display($file);

		}

		protected function addDir($path){
			$d = $this->templateEng->getTemplateDir();
			$d[] = $path;
			$this->templateEng->setTemplateDir($d);
		}
		
	}

 ?>