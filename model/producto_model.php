<?php 
	include_once "model_class.php";
	/**
	 * Clase Producto Model
	 */
	class ProductoModel extends Model
	{
		private $tabla = "producto";

		private $sql_getAllByCategoria = "SELECT  * FROM producto where id_categoria=:id_categoria ";
		
		private $sql_getAllByCategoriaPaginado = "SELECT  * FROM producto where id_categoria=:id_categoria ";

		private $sql_count = "SELECT count(1) as count from producto where id_categoria=:id_categoria";

		public function getTabla(){
			return $this->tabla;
		}

		public function getAllByCategoria($idCategoria){
			$param = array(':id_categoria' => $idCategoria);
			return $this->query($this->sql_getAllByCategoria,$param);
		}
		public function getAllByCategoriaPaginado($idCategoria,$offset, $limit){
			//$parametros = array($offset, 10);
			//$place_holders = implode(',', array_fill(0, count($parametros), '?'));
			$limit = " limit $offset,$limit ";
			$param = array(':id_categoria' => $idCategoria);

			return $this->query($this->sql_getAllByCategoria . $limit,$param);


		}

		public function count($id){
			$param = array(':id_categoria'=>$id);
			$count = $this->query($this->sql_count,$param);
			return isset($count[0]['count']) ? $count[0]['count'] : 0;
		}
	}

?>