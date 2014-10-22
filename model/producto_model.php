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

		private $sql_validarId = "SELECT count(1) as count from producto where id_producto=:id_producto";

		private $sql_getById = "SELECT * from view_producto where id_producto=:id_producto";

		private $sql_getCaracteristicasByProducto   = "SELECT cxp.v_valor, c.v_nombre from caracteristica_x_producto cxp
															JOIN caracteristica c ON c.id_caracteristica = cxp.id_caracteristica
															WHERE id_producto = :id_producto ";

		private $sql_insert = " INSERT INTO producto (v_nombre,v_descripcion, f_precio, v_img_path, id_categoria, id_usuario) 
							    VALUES (:v_nombre, :v_descripcion, :f_precio, :v_img_path, :id_categoria, :id_usuario) ";

		private $sql_insertCaracteriscaXProducto =  "INSERT INTO caracteristica_x_producto (id_producto,id_caracteristica,v_valor) 
													   VALUES (:id_producto, :id_caracteristica, :v_valor) ";

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
	}

?>