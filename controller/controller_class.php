<?php 
	include_once "config_app.php";
	include_once "view/view_class.php";
	
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
		}

		/**
		 * Atributos
		 * $data -> En esta variable se copiara el contenido del request.	
		 */

		protected $data;
		protected $pathUser = "/rol/user-no-logueado";

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

		protected function getUriParamsRequest(){
			$uri = $_SERVER['REQUEST_URI'];
			$uri = explode('?', $uri);
			return (isset($uri[1]) ? $uri[1] : "");
		}

		/**
		 * TODO
		 * 
		 * Implementar un metodo que verifique si es un usurio logueado.
		 * Implementar un metodo que verifique si el usuario tiene acceso a la pagina.
		 */

		

		public function setDataSession($data){
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
		}

		public function getDataSession($key){
			return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
		}

		public function isAjax(){
			if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			    return true;
			}else{
				return false;
			}
		}
	}

 ?>