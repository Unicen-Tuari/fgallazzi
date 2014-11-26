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
		
		public function listadoProductos($data,$titulo,$esComprador=true){
			$this->set('titulo',$titulo);
			$this->set('esComprador', $esComprador);
			if ($esComprador == false){
				$this->set("nombre",$data['cliente']['v_nombre']);
				$this->set("apellido",$data['cliente']['v_apellido']);
				$this->set("email",$data['cliente']['v_email']);
				$this->set("telefono",$data['cliente']['v_telefono']);
			}
			$this->set("productos",$data['productos']);
			return $this->read($this->listadoProductosTpl);
		}
	}


 ?>