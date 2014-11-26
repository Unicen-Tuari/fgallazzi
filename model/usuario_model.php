<?php 
	include_once "model_class.php";
	/**
	 * Clase Usuario Model
	 */
	class UsuarioModel extends Model
	{
		private $tabla = "usuario";

		private $columns = array(
				1 => 'id_usuario',
				2 => 'v_nombre',
				3 => 'v_apellido',
				4 => 'v_telefono',
				5 => 'v_clave',
				6 => 'v_email'
			);

		private $sql_getById = "SELECT * from usuario where id_usuario=:id_usuario";
		
		private $sql_insert = "INSERT INTO usuario (v_nombre,v_apellido,v_telefono,v_clave,v_email)
										VALUES 	(:v_nombre,:v_apellido,:v_telefono,:v_clave,:v_email)";
		
		private $sql_isUsuario = "SELECT count(1) as count FROM usuario WHERE v_email = :v_email and v_clave = :v_clave ";

		private $sql_getByUsuarioPass = "SELECT id_usuario, v_nombre, v_apellido, b_admin FROM usuario 
		                                   		WHERE v_email = :v_email and v_clave = :v_clave ";
		
		private $sql_listAllUsuarios = "SELECT * from usuario ";

		private $sql_nombreUsuarioDisponible = "SELECT count(1) as count FROM usuario WHERE v_email = :v_email ";

		public function getTabla(){
			return $this->tabla;
		}

		public function getColumns(){
			return $this->columns;
		}
		
		public function getById($id){
			$param = array(':id_usuario'=>$id);
			return $this->query($this->sql_getById,$param);
		}

		public function add($params){
			return $this->insert($this->sql_insert,$params);
		}

		public function isUsuario($params){
			$c = $this->query($this->sql_isUsuario, $params);
			return (isset($c[0]['count']) && $c[0]['count'] == 1 ) ? true : false;
		}

		public function getByUsuarioPass($params){
			return $this->query($this->sql_getByUsuarioPass,$params);
		}

		public function nombreUsuarioDisponible($v_email){
			$param = array(':v_email'=>$v_email);
			$r =  $this->query($this->sql_nombreUsuarioDisponible,$param);
			return (isset($r[0]['count']) && $r[0]['count'] == 0 ) ? true : false;
			
		}

		/**
		 * FUNCIONES ADMIN
		 * */
		public function listAllUsuarios($offset = 0, $limit =0){
			return $this->query($this->sql_listAllUsuarios);
		}
	}

?>