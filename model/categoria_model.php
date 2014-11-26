<?php 
	include_once "model_class.php";
	/**
	 * Clase Categoria Model
	 */
	class CategoriaModel extends Model
	{
		private $tabla = "categoria";
		
		private $sql_getAll = "Select * from categoria ";
		private $sql_getCategoriasPadre = "Select * from view_categorias_pricipales "; 
		private $sql_getCategoriaPadreByCategoria = "select * from categoria where id_categoria in (select id_categoria_padre from categoria where id_categoria = :id_categoria)";
		
		private $sql_getByCategoria = "Select * from categoria 
											where id_categoria_padre = :id_categoria_padre 
												  and id_categoria <> :id_categoria_padre ";
											  
		private $sql_varificar_id = "SELECT count(1) as count FROM categoria where id_categoria = :id_categoria limit 1";								  

		private $sql_getById = "SELECT * FROM categoria WHERE id_categoria = :id_categoria ";

		private $sql_update = "UPDATE categoria set v_descripcion = :v_descripcion WHERE id_categoria=:id_categoria ";

		private $sql_insert = "INSERT into categoria (v_descripcion,id_categoria_padre) value (:v_descripcion,:id_categoria_padre)";

		private $sql_delete = "DELETE FROM categoria where id_categoria = :id_categoria ";

		private $sql_countProductosXcategoria = "SELECT count(1) as count FROM producto where id_categoria = :id_categoria ";

		function __construct()
		{
			
		}

		public function getTabla(){
			return $this->tabla;
		}

		public function loadCategoriasPadre(){
			$data = $this->query($this->sql_getCategoriasPadre);
			return $data;
		}

		public function getCategoriaPadreByCategoria($idCategoria){
			$params = array(':id_categoria' => $idCategoria);
			return $this->query($this->sql_getCategoriaPadreByCategoria,$params);
		}

		public function loadByCategoriaPadre($id){
			$param = array(":id_categoria_padre" => $id);

			$data = $this->query($this->sql_getByCategoria,$param);

			return $data;
		}

		public function getById($id){
			$params = array(':id_categoria' => $id);
			return $this->query($this->sql_getById,$params);
		}

		

		public function verificarId($id){
			$param = array(":id_categoria" => $id);
			return $this->query($this->sql_varificar_id,$param);
		}

		public function updateCategoria($id,$v_descripcion){
			$params = array(':id_categoria' => $id, ':v_descripcion' => $v_descripcion);
			return $this->query($this->sql_update,$params);
		}

		public function insertCategoria($v_descripcion,$id_categoria_padre){
			$params = array(':v_descripcion' => $v_descripcion,
							':id_categoria_padre' => $id_categoria_padre);
			return $this->query($this->sql_insert,$params);
		}

		public function deleteCategoria($id){
			$param = array(":id_categoria" => $id);
			return $this->query($this->sql_delete,$param);
		}
		
		public function countProductosxCategoria($id){
			$param = array(":id_categoria" => $id);
			$q =$this->query($this->sql_countProductosXcategoria,$param);
			return (isset($q[0]['count'])) ? $q[0]['count'] : 0;
		}
	}

?>