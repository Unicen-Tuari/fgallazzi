<?php 
	include_once "model_class.php";
	/**
	 * Clase Usuario Model
	 */
	class UsuarioModel extends Model
	{
		private $tabla = "usuario";

		private $sql_getById = "SELECT * from usuario where id_usuario=:id_usuario";
		
		public function getTabla(){
			return $this->tabla;
		}
		
		public function getById($id){
			$param = array(':id_usuario'=>$id);
			return $this->query($this->sql_getById,$param);
		}

	}

?>