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
		function __construct()
		{
			parent::__construct();
			$this->addDir("./templates/usuario/");
		}

		private $loginModalTpl = "login_modal.tpl";
		private $formNuevoUsuarioTpl = "nuevo_usuario_modal.tpl";
		private $formLoginTpl = "form_login.tlp";

		
		/**
		 * metodo login
		 * Visualizara el formulario de login_modal
		 * 
		 * */
		
		public function formLoginByAjax(){
			return $this->render($this->loginModalTpl);
		}

		public function formNuevoUsuarioByAjax(){
			return $this->render($this->formNuevoUsuarioTpl);
		}

		public function formLogin(){
			return $this->render($this->formLoginTpl);
		}
	}


 ?>