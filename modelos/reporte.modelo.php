<?php 

require_once "conexion.php";

class ModeloReporte{

	/*=======================================
	=            Crear Reportes            =
	=======================================*/
	
	static public function mdlIngresarReporte($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(saldo_inicial, ventas, retiros, gastos, saldo) VALUES (:saldo_inicial, 0, 0, 0, :saldo_inicial)");

		$stmt-> bindParam(":saldo_inicial", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=========================================================
						MOSTRAR Reportes
	=========================================================*/

	static public function mdlMostrarReporte($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where fecha = curdate()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

}
