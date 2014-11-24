<?php 
	include_once "view_class.php";

	/**
	 * CLase MailsView
	 */
	class MailsView extends View
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->addDir("./templates/mails/");
		}

		private $listadoProductosTpl = "listado_productos.tpl";
		
		public function listadoProductos($data){
			$this->set("productos",$data);
			return $this->read($this->listadoProductosTpl);
		}
	}


 ?>