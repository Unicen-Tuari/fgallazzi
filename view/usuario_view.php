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
		private $formContactoTpl = "form_contacto.tpl";

		
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

		public function formContacto(){
			$this->set('title', 'Contacto : Trastos');
			$this->render($this->formContactoTpl);
		}


		/**
		 * FUNCIONES ADMIN
		 * */
		private $listAllUsuariosTpl = "list_all_usuarios.tpl";

		public function listAllUsuarios(){
			$this->set('title','Usuarios : Trastos');
			$this->render($this->listAllUsuariosTpl);
		}

	}


 ?>