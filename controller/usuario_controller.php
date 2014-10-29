<?php 
	include_once "controller_class.php";
	include_once "view/usuario_view.php";
	include_once "model/usuario_model.php";


	/**
	 * UsuarioController
	 * 
     */
	class UsuarioController extends Controller
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->model = new UsuarioModel();
			$this->view = new UsuarioView($this->pathUser);
			
		}

		/**
		 * Atributos
		 * */
		private $model;
		private $view;

		/**
		 * visualizara el carrito de compras
		 * */

		public function formLoginByAjax(){
			$this->view->formLoginByAjax();
		}

		public function loginByAjax(){
			//var_dump($this->data);exit();
			if ($this->isPost()){
				// autenticar par usuario clave
				$usuario = $this->getDataRequest('usuario');
				$pass = $this->getDataRequest('password');
				$params = array(
						':v_email' => $usuario,
						':v_clave' => $pass
					);
				if ($this->model->isUsuario($params)){

					$user = $this->model->getByUsuarioPass($params);

					//Identificar la session con id_usuario y rol
					//El rol de momento de deja configurado en un usuario logueado normal 
					$dataSession = array(					
						'id'   => $user[0]['id_usuario'],
						'user' => $user[0]['v_nombre'] . " " . $user[0]['v_apellido'],
						'rol'  => ConfigApp::$USER_LOGUEADO
					);

					$this->setDataSession($dataSession);

					$json = array(
						'success' => true,
						'user' => $user[0]['v_nombre'] . " " . $user[0]['v_apellido']
					);
					return $this->view->json($json);
				}
			}
			$json = array('success' => false);
			return $this->view->json($json);
		}

		public function formNuevoUsuarioByAjax(){
			$this->view->formNuevoUsuarioByAjax();
		}

		public function altaNuevoUsuarioByAjax(){
			if ($this->isPost()){
				$nombre = $this->getDataRequest('nombre');
				$apellido = $this->getDataRequest('apellido');
				$email = $this->getDataRequest('email');
				$telefono = $this->getDataRequest('telefono');
				$password = $this->getDataRequest('password');

				$params =array(
					':v_nombre' => $nombre,
					':v_apellido' => $apellido,
					':v_telefono' => $telefono,
					':v_clave' => $password, 
					':v_email' => $email
				);

				if ($this->model->add($params)){
					$json = array('success' => true);
					return $this->view->json($json);
				}
			} 
			
			$json = array('success' => false);
			return $this->view->json($json);
		}

		public function logOutByAjax(){
			if (session_destroy()){
				return $this->view->json(array('success' => true));
			}else{
				return $this->view->json(array('success' => false));
			}
		}


	}

 ?>