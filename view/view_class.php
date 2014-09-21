<?php 
	/**
	* Clase Padre View
	*/
	class View
	{
		// Libreria de Smarty
		require_once "./libs/Smarty.class.php";
		
		/**
		 * Constructor
		 */
		function __construct()
		{
			$this->templateEng = new Smarty();
		}

		/**
		 * Atributos
		 */
		protected $templateEng;
		
	}

 ?>