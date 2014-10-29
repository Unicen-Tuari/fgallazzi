<?php 
	include_once "config_app.php";

	/**
	* Clase Padre Controller
	*/
	class Controller  
	{
		/**
		 * Constructor
		 */
		function __construct()
		{
			$this->data = $_REQUEST;
			if (!$this->controlUsuario()){
				echo('No tenes acceso');
				die;
			}
			$this->setPathUser();
			
		}

		/**
		 * Atributos
		 * $data -> En esta variable se copiara el contenido del request.	
		 */

		protected $data;
		protected $pathUser;

		/**
		 * Metodos
		 * 
		 */

		/**
		 * @return true si el request es POST
		 * */

		protected function isPost(){
			return  ( $_SERVER['REQUEST_METHOD'] === 'POST');
		}

		/**
		 * @return true si el request es GET
		 * */
		protected function isGet(){
			return  ( $_SERVER['REQUEST_METHOD'] === 'GET');
		}

		/**
		 * Metodo que devuelve el valor dada una clave, si es nula o no existe retorna false;
		 * */
		protected function getDataRequest($key){
			if (array_key_exists($key, $this->data) && $this->data[$key] != null){
				return $this->data[$key];
			}
			return false;
		}

		/**
		 * TODO
		 * 
		 * Implementar un metodo que verifique si es un usurio logueado.
		 * Implementar un metodo que verifique si el usuario tiene acceso a la pagina.
		 */

		private function identificarUsuario(){
			if (!isset($_SESSION['user'])){
				return ConfigApp::$USER_NO_LOGUEADO;
			}else if ($_SESSION['rol'] == ConfigApp::$USER_LOGUEADO){
				return ConfigApp::$USER_LOGUEADO;
			}else if ($_SESSION['rol'] == ConfigApp::$USER_ADMIN){
				return ConfigApp::$USER_ADMIN;
			}else{
				return false;
			}
		}

		private function controlUsuario(){
			$user = $this->identificarUsuario();
			if ($user == ConfigApp::$USER_NO_LOGUEADO){
				switch ($this->getDataRequest(ConfigApp::$ACTION)) {
					case false : 
					case ConfigApp::$ACTION_HOME:
					case ConfigApp::$ACTION_PRODUCTOS:
					case ConfigApp::$ACTION_DETALLE:
					case ConfigApp::$ACTION_PUBLICAR:
					case ConfigApp::$ACTION_GET_CATEGORIAS:
					case ConfigApp::$ACTION_CARGAR_PUBLICACION:
					case ConfigApp::$ACTION_GET_CARACTERISTICAS:
					case ConfigApp::$ACTION_BUSCADOR:
					case ConfigApp::$ACTION_GET_ALL_PRODUCTOS_BY_AJAX:
					case ConfigApp::$ACTION_GET_CARRITO_BY_AJAX:
					case ConfigApp::$ACTION_FORM_LOGIN_BY_AJAX:
					case ConfigApp::$ACTION_LOGIN_BY_AJAX:
					case ConfigApp::$ACTION_GET_TMP_LISTADO_BY_AJAX:
					case ConfigApp::$ACTION_FORM_NUEVO_USUARIO_BY_AJAX:
					case ConfigApp::$ACTION_ALTA_NUEVO_USUARIO_BY_AJAX:
						return true;
						break;
					default:
						return false;
						break;
				}

			} else if ($user == ConfigApp::$USER_LOGUEADO){
				switch ($this->getDataRequest(ConfigApp::$ACTION)) {
					case false : 
					case ConfigApp::$ACTION_HOME:
					case ConfigApp::$ACTION_PRODUCTOS:
					case ConfigApp::$ACTION_DETALLE:
					case ConfigApp::$ACTION_PUBLICAR:
					case ConfigApp::$ACTION_GET_CATEGORIAS:
					case ConfigApp::$ACTION_CARGAR_PUBLICACION:
					case ConfigApp::$ACTION_GET_CARACTERISTICAS:
					case ConfigApp::$ACTION_BUSCADOR:
					case ConfigApp::$ACTION_GET_ALL_PRODUCTOS_BY_AJAX:
					case ConfigApp::$ACTION_GET_CARRITO_BY_AJAX:
					//case ConfigApp::$ACTION_FORM_LOGIN_BY_AJAX:
					//case ConfigApp::$ACTION_LOGIN_BY_AJAX:
					case ConfigApp::$ACTION_GET_TMP_LISTADO_BY_AJAX:
					//case ConfigApp::$ACTION_FORM_NUEVO_USUARIO_BY_AJAX:
					//case ConfigApp::$ACTION_ALTA_NUEVO_USUARIO_BY_AJAX:
					case ConfigApp::$ACTION_LOGOUT_BY_AJAX:
						return true;
						break;
					default:
						return false;
						break;
				}

			} else if ($user == ConfigApp::$USER_ADMIN){
				switch ($this->getDataRequest(ConfigApp::$ACTION)) {
					case false : 
					case ConfigApp::$ACTION_HOME:
					case ConfigApp::$ACTION_PRODUCTOS:
					case ConfigApp::$ACTION_DETALLE:
					case ConfigApp::$ACTION_PUBLICAR:
					case ConfigApp::$ACTION_GET_CATEGORIAS:
					case ConfigApp::$ACTION_CARGAR_PUBLICACION:
					case ConfigApp::$ACTION_GET_CARACTERISTICAS:
					case ConfigApp::$ACTION_BUSCADOR:
					case ConfigApp::$ACTION_GET_ALL_PRODUCTOS_BY_AJAX:
					case ConfigApp::$ACTION_GET_CARRITO_BY_AJAX:
					//case ConfigApp::$ACTION_FORM_LOGIN_BY_AJAX:
					//case ConfigApp::$ACTION_LOGIN_BY_AJAX:
						return true;
						break;
					default:
						return false;
						break;
				}
			}
		}

		public function setDataSession($data){
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
		}

		public function getDataSession($key){
			return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
		}

		private function setPathUser (){
			if ($this->identificarUsuario() == ConfigApp::$USER_NO_LOGUEADO){
				$this->pathUser = ConfigApp::$PATH_USER_NO_LOGUEADO;
			}else if ($this->identificarUsuario() == ConfigApp::$USER_LOGUEADO){
				$this->pathUser = ConfigApp::$PATH_USER_LOGUEADO;
			}else if ($this->identificarUsuario() == ConfigApp::$USER_ADMIN){
				$this->pathUser = ConfigApp::$PATH_USER_ADMIN;
			}
		}
	}

 ?>