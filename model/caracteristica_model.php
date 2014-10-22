<?php 
	include_once "model_class.php";
	/**
	 * Clase Categoria Model
	 */
	class CaracteristicaModel extends Model
	{
		private $tabla = "caracteristica";
		
		private $sql_getAllByCategoria = "SELECT * FROM caracteristica where id_categoria=:id_categoria";

		
		function __construct()
		{
			
		}

		public function getTabla(){
			return $this->tabla;
		}

		public function getAllByCategoria($id){
			$param = array(":id_categoria" => $id);

			return $this->query($this->sql_getAllByCategoria,$param);

		}
		
	}

?>