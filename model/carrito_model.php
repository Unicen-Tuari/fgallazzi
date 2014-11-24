<?php 
	include_once "model_class.php";
	/**
	 * Clase Carrito Model
	 */
	class CarritoModel extends Model
	{
		private $tabla = "carrito";
		
		private $sql_getCarritoActivo = "SELECT id_carrito, id_usuario, ts_creado, ts_actualizado, current_timestamp() as now FROM carrito where id_usuario=:id_usuario and b_habilitado ";
		
		
		private $sql_getProductosXCarrito = "SELECT pxc.id_carrito, pxc.id_producto, pxc.n_cantidad, pxc.f_precio_unidad , 
													p.v_nombre as v_nombre_producto,
													concat(u.v_apellido, ', ',u.v_nombre) as v_usuario
												from producto_x_carrito pxc 
												join producto p on p.id_producto = pxc.id_producto
												join usuario  u on u.id_usuario = p.id_usuario
												where pxc.id_carrito = :id_carrito";

		private $sql_nuevoCarrito = "INSERT INTO carrito (id_usuario) VALUES (:id_usuario)";

		private $sql_bajaCarrito = "UPDATE carrito set b_habilitado = false where id_carrito = :id_carrito";

		private $sql_insertProductoXCarrito = "INSERT INTO producto_x_carrito (id_producto, id_carrito, n_cantidad,f_precio_unidad)
													VALUES (:id_producto, :id_carrito, :n_cantidad, :f_precio_unidad)";

		private $sql_getProductoXCarritoById = "SELECT * FROM producto_x_carrito 
													WHERE id_producto = :id_producto and id_carrito = :id_carrito ";											
		
		private $sql_updateProductoXCarritoById = "UPDATE producto_x_carrito set n_cantidad = :n_cantidad
														WHERE id_producto = :id_producto and id_carrito = :id_carrito ";											
		
		private $sql_deleteProductoXCarritoById = "DELETE FROM producto_x_carrito 
													WHERE id_producto = :id_producto and id_carrito = :id_carrito ";											
													
		private $sql_confirmarCarrito = "UPDATE carrito set b_confirmado = true, b_habilitado = false where id_carrito = :id_carrito and id_usuario = :id_usuario";

		public function getTabla(){
			return $this->tabla;
		}

		public function getCarritoActivo($id_usuario){
			$param = array(":id_usuario" => $id_usuario);
			return $this->query($this->sql_getCarritoActivo,$param);
		}

		public function getProductosXCarrito($id_carrito){
			$param = array(":id_carrito" => $id_carrito);
			return $this->query($this->sql_getProductosXCarrito,$param);
		}

		public function nuevoCarrito($id_usuario){
			$param = array(":id_usuario" => $id_usuario);
			return $this->insert($this->sql_nuevoCarrito,$param);
		}

		public function bajaCarrito($id_carrito){
			$param = array(":id_carrito" => $id_carrito);
			$this->query($this->sql_bajaCarrito,$param);
		}

		public function insertProductoXCarrito($param){
			$this->query($this->sql_insertProductoXCarrito,$param);
		}

		public function getProductoXCarritoById($id_producto,$id_carrito){
			$param = array(':id_producto' => $id_producto,
				           ':id_carrito' => $id_carrito);
			return $this->query($this->sql_getProductoXCarritoById,$param);
		}

		public function updateProductoXCarritoById($id_producto,$id_carrito,$n_cantidad){
			$param = array(':id_producto' => $id_producto,
				           ':id_carrito' => $id_carrito,
				           ':n_cantidad' => $n_cantidad);
			return $this->query($this->sql_updateProductoXCarritoById,$param);
		}

		public function deleteProductoXCarritoById($id_producto,$id_carrito){
			$param = array(':id_producto' => $id_producto,
				           ':id_carrito' => $id_carrito);
			return $this->query($this->sql_deleteProductoXCarritoById,$param);
		}

		public function confirmarCarrito($id_carrito,$id_usuario){
			$param = array(':id_carrito' => $id_carrito,
						   ':id_usuario' => $id_usuario);
			return $this->query($this->sql_confirmarCarrito,$param);
		}
		
	}

?>