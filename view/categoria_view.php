<?php 
	include_once "view_class.php";

	/**
	 * CLase HomeView
	 */
	class CategoriaView extends View
	{
		/**
		 * Constructor
		 * */
		function __construct()
		{
			parent::__construct();
			$this->addDir("./templates/categoria/");
		}
		

		/**
		 * FUNCIONES ADMIN
		 * */
		private $listAllCategoriasTpl = "list_all_categorias.tpl";
		private $listAllSubCategoriasTpl = "list_all_sub_categorias.tpl";
		private $editCategoriaTpl = "edit_categoria.tpl";
		private $newCategoriaTpl = "new_categoria.tpl";

		public function listAllCategorias(){
			$this->set('title','Categorías : Trastos');
			$this->render($this->listAllCategoriasTpl);
		}

		public function listAllSubCategorias($nombre,$id_categoria_padre){
			$this->set('title','Sub-Categorías : Trastos');
			$this->set('nombre',$nombre);
			$this->set('id_categoria_padre',$id_categoria_padre);
			$this->render($this->listAllSubCategoriasTpl);
		}

		public function editCategoria($id_categoria,$v_descripcion){
			$this->set('title', 'Editar Categoría : Trastos');
			$this->set('id_categoria',$id_categoria);
			$this->set('v_descripcion',$v_descripcion);
			$this->render($this->editCategoriaTpl);

		}
		public function newCategoria($id_categoria_padre){
			//var_dump($id_categoria_padre);exit();
			$this->set('title', 'Nueva Categoría : Trastos');
			$this->set('id_categoria_padre', $id_categoria_padre);
			$this->render($this->newCategoriaTpl);
		}
	}


 ?>