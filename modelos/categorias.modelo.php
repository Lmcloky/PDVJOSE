<?php 

require_once "conexion.php";

class ModeloCategorias{

	/*=======================================
	=            Crear Categoria            =
	=======================================*/
	
	static public function mdlIngresarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("insert into $tabla(categoria) values (:categoria)");

		$stmt-> bindParam(":categoria", $datos, PDO::PARAM_STR);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			return  "error";

		}

		$stmt->close();
		$stmt = null;
	}

	/*=======================================
	=            Mostrar Categoria            =
	=======================================*/

	static public function mdlMostrarCategorias($tabla, $item, $valor){

		if ($item != null) {
			
			$stmt = Conexion::conectar()->prepare("select *from $tabla where $item = :$item");
			$stmt ->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();
			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("select *from $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt -> null;
	}

	/*=======================================
	=            Editar Categoria            =
	=======================================*/
	
	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set categoria = :categoria where id = :id");

		$stmt-> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt-> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			return  "error";

		}

		$stmt->close();
		$stmt = null;
	}

	/*=======================================
	=            Borrar Categoria            =
	=======================================*/

	static public function mdlBorrarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("delete from $tabla where id = :id");

		$stmt-> bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			return  "error";

		}

		$stmt->close();
		$stmt = null;

	}

		static public function mdlIngresarRetiro($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(retiro, descripcion, fecha) VALUES (:retiro, :descripcion, now())");

		$stmt->bindParam(":retiro", $datos["retiro"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

		static public function mdlMostrarRetiros($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where fecha = CURDATE()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarVentasCanceladas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where date(fecha) = CURDATE()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarVentasEditadas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where fecha_nueva = CURDATE()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarVentasHoy($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where date(fecha) = CURDATE()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

		static public function mdlIngresarCambio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cambio, fecha) VALUES (:cambio,now())");

		$stmt->bindParam(":cambio", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "else";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=========================================================
						MOSTRAR Reportes
	=========================================================*/

	static public function mdlMostrarCambio($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where fecha = CURDATE()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
}
