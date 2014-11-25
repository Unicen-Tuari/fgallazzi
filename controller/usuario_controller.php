<?php 
	include_once "controller_class.php";
	include_once "view/usuario_view.php";
	include_once "model/usuario_model.php";
	include_once "validar_class.php";
	include_once "paginador_controller.php";

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
			$this->view = new UsuarioView();
			
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
						'rol'  => ($user[0]['b_admin']) ? ConfigApp::$USER_ADMIN : ConfigApp::$USER_LOGUEADO
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
				$passwordConfirm = $this->getDataRequest('passwordConfirm');

				// verificar los datos
				$datos = array(
						'nombre' => $nombre,
						'apellido' => $apellido,
						'email' => $email,
						'telefono' => $telefono,
						'password' => $password,
						'passwordConfirm' => $passwordConfirm
					);
				$reglas = array(
						'nombre' => array(
								'es_requerido' => true,
								'max_length' => 50,
								'min_length' => 2
							),
						'apellido' => array(
								'es_requerido' => true,
								'max_length' => 50,
								'min_length' => 2
							),
						'email' => array(
								'es_requerido' => true,
								'es_email' => 'es_email',
								'max_length' => 100
							),
						'telefono' => array(
								'es_requerido' => true,
								'max_length' => 50
							),
						'password' => array(
								'es_requerido' => true,
								'max_length' => 50,
								'min_length' => 6,
								'son_iguales' => array('password','passwordConfirm',
													   'msj' => "La confirmación de la clave no coincide")
							),
						'passwordConfirm' => array(
								'es_requerido' => true
							)
					);
				$validar = new Validar();
				$val = $validar->validar($datos,$reglas);
				if ($val !== true){
					return $this->view->json(array('success'=> false, 'errorMsj' => $val));
				}
				

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

		public function formLogin(){
			$this->view->formLogin();
		}

		/**
		 * FUNCIONES ADMIN
		 * */

		public function listAllUsuarios(){
			//$data = $this->model->listAllUsuarios();
			$this->view->listAllUsuarios();
		}
		
		public function listAllUsuariosByAjax(){
			$paginador = new PaginadorController();
			$paginador->setTabla('usuario');
			$paginador->setCols(array('id_usuario','v_nombre','v_apellido','v_telefono','v_email'));
			$paginador->setCant($this->getDataRequest('cant'));
			//$paginador->setWhere(array('id_usuario'=>2));
			$paginador->setPage($this->getDataRequest('page'));
			$paginador->setTxt($this->getDataRequest('txt'));
			
			$data = $paginador->getPage();

			$cantPages = $paginador->getCountPages();
			$page = $paginador->getNPage();

			$json = array(
				'success' => true,
				'rows' => $data,
				'cant_pages' => $cantPages,
				'page' => $page,
				);
			return $this->view->json($json);
		}

	}

 ?>