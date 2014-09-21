<?php 

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


		/**
		 * Metodos
		 * 
		 */

		/**
		 * @return true si el request es POST
		 * */

		public function isPost(){
			return  ( $_SERVER['REQUEST_METHOD'] === 'POST');
		}

		/**
		 * @return true si el request es GET
		 * */
		public function isGet(){
			return  ( $_SERVER['REQUEST_METHOD'] === 'GET');
		}


		/**
		 * TODO
		 * 
		 * Implementar un metodo que verifique si es un usurio logueado.
		 * Implementar un metodo que verifique si el usuario tiene acceso a la pagina.
		 */
	}

 ?>