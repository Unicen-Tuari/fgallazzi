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
			return ConfigApp::$USER_NO_LOGUEADO;
		}

		private function controlUsuario(){
			$user = $this->identificarUsuario();
			if ($user == ConfigApp::$USER_NO_LOGUEADO){
				switch ($this->getDataRequest(ConfigApp::$ACTION)) {
					case false : 
					case ConfigApp::$ACTION_HOME:
					case ConfigApp::$ACTION_PRODUCTOS:
						return true;
						break;
					default:
						return false;
						break;
				}

			} else if ($user == ConfigApp::$USER_LOGUEADO){

			} else if ($user == ConfigApp::$USER_ADMIN){
				
			}
		}

		private function setPathUser (){
			if ($this->identificarUsuario() == ConfigApp::$USER_NO_LOGUEADO){
				$this->pathUser = ConfigApp::$PATH_USER_NO_LOGUEADO;
			}
		}
	}

 ?>