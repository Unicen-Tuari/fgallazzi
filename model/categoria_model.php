<?php 
	include_once "model_class.php";
	/**
	 * Clase Categoria Model
	 */
	class CategoriaModel extends Model
	{
		private $sql_getAll = "Select * from categoria ";
		private $sql_getCategoriasPadre = "Select * from categoria 
											where id_categoria_padre = id_categoria"; 
		private $sql_getByCategoria = "Select * from categoria 
											where id_categoria_padre = :id_categoria_padre 
												  and id_categoria <> :id_categoria_padre ";
											  
		private $sql_varificar_id = "SELECT count(1) as count FROM categoria where id_categoria = :id_categoria limit 1";								  

		function __construct()
		{
			
		}

		public function loadCategoriasPadre(){
			$data = $this->query($this->sql_getCategoriasPadre);
			return $data;
		}

		public function loadByCategoriaPadre($id){
			$param = array(":id_categoria_padre" => $id);

			$data = $this->query($this->sql_getByCategoria,$param);

			return $data;
		}

		public function verificarId($id){
			$param = array(":id_categoria" => $id);
			return $this->query($this->sql_varificar_id,$param);
		}
		
	}

?>