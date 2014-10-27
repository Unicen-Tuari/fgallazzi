<?php 
	include_once "view_class.php";

	/**
	 * CLase HomeView
	 */
	class UsuarioView extends View
	{
		/**
		 * Constructor
		 * */
		function __construct($pathUser=false)
		{
			parent::__construct($pathUser);
			$this->addDir("./templates/usuario/");
		}

		private $loginModalTpl = "login_modal.tpl";

		
		/**
		 * metodo login
		 * Visualizara el formulario de login_modal
		 * 
		 * */
		
		public function formLoginByAjax(){
			return $this->render($this->loginModalTpl);
		}
	}


 ?>