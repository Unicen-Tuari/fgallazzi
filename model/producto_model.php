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

		private $sql_count = "SELECT count(1) as count from producto ";

		private $sql_validarId = "SELECT count(1) as count from producto where id_producto=:id_producto";

		private $sql_getById = "SELECT * from view_producto where id_producto=:id_producto";

		private $sql_getCaracteristicasByProducto   = "SELECT cxp.v_valor, c.v_nombre from caracteristica_x_producto cxp
															JOIN caracteristica c ON c.id_caracteristica = cxp.id_caracteristica
															WHERE id_producto = :id_producto ";

		private $sql_insert = " INSERT INTO producto (v_nombre,v_descripcion, f_precio, v_img_path, id_categoria, id_usuario) 
							    VALUES (:v_nombre, :v_descripcion, :f_precio, :v_img_path, :id_categoria, :id_usuario) ";

		private $sql_insertCaracteriscaXProducto =  "INSERT INTO caracteristica_x_producto (id_producto,id_caracteristica,v_valor) 
													   VALUES (:id_producto, :id_caracteristica, :v_valor) ";

		private $sql_getAll = "select * from producto ";

		private $sql_where = " (v_nombre like :texto or 
				           	    v_descripcion like :texto or 
				                f_precio like  :texto )";

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

		public function count($id=false, $txt_buscar = false){
			$sql_count_where = "";
			$param = false;
			if ($id){
				$sql_count_where =  $this->sql_count . " where id_categoria = :id_categoria";
				$param = array(':id_categoria'=>$id);
			}else if ($id == false && $txt_buscar){
				$sql_count_where =  $this->sql_count . $this->generateWhereBuscador($txt_buscar);
				$param = $this->generateParamBuscador($txt_buscar);

			}
			
			
			$count = $this->query($sql_count_where,$param);
			return isset($count[0]['count']) ? $count[0]['count'] : 0;
		}

		public function verificarId($id){
			$param = array(':id_producto'=>$id);
			$count = $this->query($this->sql_validarId,$param);
			return (isset($count[0]['count']) && $count[0]['count'] > 0) ? true : false;
		}

		public function getById($id){
			$param = array(':id_producto'=>$id);
			return $this->query($this->sql_getById,$param);
		}

		public function getCaracteristicasByProducto($id){
			$param = array(':id_producto'=>$id);
			return $this->query($this->sql_getCaracteristicasByProducto,$param);
		}

		public function add($data){
			$param = array(':v_nombre' => $data['v_nombre'], 
						   ':v_descripcion' => $data['v_descripcion'],
						   ':f_precio' => $data['f_precio'],
						   ':v_img_path' => $data['v_img_path'],
						   ':id_categoria' => $data['id_categoria'],
						   ':id_usuario' => $data['id_usuario']);

			return $this->insert($this->sql_insert,$param);
		}

		public function addCaracteristicaXProducto($data){
			$param = array(':id_producto' => $data['id_producto'], 
				           ':id_caracteristica' => $data['id_caracteristica'],
				           ':v_valor' => $data['v_valor']);
			return $this->insert($this->sql_insertCaracteriscaXProducto,$param);
		}

		public function getAll($texto=false,$offset=false,$limit=false){

			$limit =($limit) ? " limit $offset,$limit " : " ";
			$where = $this->generateWhereBuscador($texto);
			$param = $this->generateParamBuscador($texto);
			$sql_getAll = $this->sql_getAll . $where . $limit;
			return $this->query($sql_getAll,$param);
		}

		private function generateWhereBuscador($texto=false){
			$where = " ";
			if (is_string($texto)){
				$where = "where " . $this->sql_where;
			}if (is_array($texto)){
				$where = "where ";
				for ($i = 0 ; $i < count($texto);$i++){
					$where .= $this->sql_where . " OR ";
					$where = str_ireplace(":texto", ":text_".$i, $where);
				}
				$where = substr($where, 0,strlen($where) - 4);
			}
			return $where;

		}

		private function generateParamBuscador($texto){
			$param = false;
			if (is_string($texto)){
				$param = array(':texto' =>  '%'.$texto.'%');
			}if (is_array($texto)){
				$param = array();
				for ($i = 0 ; $i < count($texto);$i++){
					$param[':text_'.$i] = '%'.$texto[$i].'%';
				}
			}
			return $param;
		}
	}

?>