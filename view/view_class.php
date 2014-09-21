<?php 
	// Libreria de Smarty
		require_once "libs/Smarty.class.php";
	/**
	* Clase Padre View
	*/
	class View
	{
		
		
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