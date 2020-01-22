<?php 

	require_once "conexion.php";

	class ModeloPagos{

		/*=============================================
		=            Section comment block            =
		=============================================*/
		
		static public function mdlMostrarPagos($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;

	}

	static public function mdlMostrarPagosHoy($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  where date(fecha) = CURDATE()");
			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;

	}

		/*=============================================
		=            Registrar Usuarios           =
		=============================================*/

	static public function mdlIngresarPago($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_venta, abono, metodo_pago) VALUES (:id_venta, :abono, :metodo_pago)");

		$stmt->bindParam(":id_venta", $datos["id_venta"], PDO::PARAM_INT);
		$stmt->bindParam(":abono", $datos["abono"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
		/*=============================================
		=            Editar Usuarios           =
		=============================================*/

		static public function mdlEditarUsuario($tabla, $datos){

			$stmt = Conexion::conectar()->prepare("update $tabla set nombre = :nombre, password = :password, perfil = :perfil, foto = :foto where usuario = :usuario");

			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);			
			$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);


			if ($stmt -> execute()) {				
				return "ok";
			}else{
				return "error";
			}
			$stmt -> close();

			$stmt = null;
		}
		/*=============================================
		=            Actualizar Usuarios           =
		=============================================*/

		static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

			$stmt = Conexion::conectar()->prepare("update $tabla set $item1 = :$item1 where $item2 = :$item2");

			$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			if ($stmt -> execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt -> close();
			$stmt = null;

		}

		/*=============================================
		=            Borrar Usuarios           =
		=============================================*/

		static public function mdlBorrarPago($tabla, $datos){

			$stmt = Conexion::conectar()->prepare("delete from $tabla where id = :id");

			$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
			
			if ($stmt -> execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt -> close();
			$stmt = null;
		}

	}