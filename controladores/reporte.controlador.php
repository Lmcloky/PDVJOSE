<?php 

class ControladorReporte{

	/*========================================
	=            Crear Reportes            =
	========================================*/


	static public function ctrCrearReporte(){

		if (isset($_POST["nuevaCantidad"])) {
			
			if (preg_match('/^[0-9 ]+$/', $_POST["nuevaCantidad"])) { 

					$tabla = "reportes";

				   	$datos = $_POST["nuevaCantidad"];

				   	$respuesta = ModeloReporte::mdlIngresarReporte($tabla, $datos);

				   	if($respuesta == "ok"){

						echo'<script>

						swal({
							  type: "success",
							  title: "El saldo guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "reporte";

										}
									})

						</script>';

					}
				
			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El campo no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "reporte";

							}
						})

			  	</script>';

			}
		}
	}
	/*========================================================
	=            CREAR A LOS CLIENTES BLA BLA  BLA           =
	========================================================*/
	static public function ctrMostrarReporte($item, $valor){

		$tabla = "reportes";
		$respuesta = ModeloReporte::mdlMostrarReporte($tabla, $item, $valor);

		return $respuesta;
	}

}