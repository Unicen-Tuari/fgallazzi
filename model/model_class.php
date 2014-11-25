<?php 
	

	/**
	* Clase Padre Model
	*/
	class Model 
	{
		/**
		 * Contructor
		 **/
		function __construct()
		{
			
		}
		//abstract function getTabla();

		/**
		 * Atributos
		 **/

		private $db = "trastos_db";
		private $user = "root";
		private $pass = "debianfran";
		private $host = "localhost";
		protected $conn = null;
		private $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		/**
		 * Metodos
		 */

		/**
		* Inicia la conneccion con la base de datos
		*/
		protected function coneccion()	{
			try{
				$this->conn = new PDO("mysql:host=$this->host;dbname=$this->db",$this->user,$this->pass,$this->opciones);
			}catch(PDOException $pe){
				die('Error de conexion, Mensaje: ' -$pe->getMessage());
			}
			
		}

		/**
		 * Devuelve la coneccion establecida
		 */
		private function conectar(){
			if (!$this->conn ){
				$this->coneccion();
			}
			return $this->conn;
		}

		/**
		*Ejecuta un Query SQL
		* @param $sql Tipo String, Contiene el SQL a ejecutar en la base.
		* @param $param Tipo Array, Contiene los parametros del SQL.
		*        formato array(':id' => $id);
		* @return Etorna un arreglo con todas las filas obtenidas.
		*/
		public function query($sql,$param=false){
			$conn = $this->conectar();

            if (!$param){
				$q = $conn->query($sql);
			} else if ($param) {
				$q = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				
				$q->execute($param);
			}
			if(!$q){
			  die("Error al ejecutar una consulta, Mensaje: ". $conn->errorInfo() . $sql);
			}
			return $q->fetchAll(PDO::FETCH_ASSOC);
		}

		function insert($sql, $param = false){
			$conn = $this->conectar();
			//Ejecucion
			if (!$param){
				$q	 = $conn->query($sql);
			} else if ($param) {
				$q = $conn->prepare($sql);
				$q->execute($param);
				 
			}
			//Si es null, hubo un error
			if(!$q)
			{
			  die("Error al ejecutar una consulta, Mensaje: ". $conn->errorInfo());
			}
			/* Si fue exitoso retorna el ID */
			return $conn->lastInsertId();
		}

		function nowDB(){
			$sql = "select current_timestamp() as now ";
			$now = $this->query($sql);
			return $now[0]['now'];
		}

		/**
		 * TODO 
		 * Tratar las excepciones
		 */

	}

 ?>