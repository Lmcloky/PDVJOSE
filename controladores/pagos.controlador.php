<?php 

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
	
	class ControladorPagos{

		/*=============================================
		=            iNGRESO DE USUARIOS            =
		=============================================*/

		static public function ctrCrearPago(){

			if (isset($_POST["abono"])) {
				if (preg_match('/^[0-9.]+$/', $_POST["abono"])){

						$tabla = "pagos";
						$datos = array("id_venta" => $_POST["nuevoPago"],
										"abono" => $_POST["abono"],
										"metodo_pago" => $_POST["metodoPago"]);

						$respuesta = ModeloPagos::mdlIngresarPago($tabla, $datos);

						if ($respuesta == "ok") {

											$impresora = "epsontm";

								$conector = new WindowsPrintConnector($impresora);

								$printer = new Printer($conector);

								$printer -> setJustification(Printer::JUSTIFY_CENTER);

								$printer -> text(date("Y-m-d H:i:s")."\n");//Fecha de la factura

								$printer -> feed(1); //Alimentamos el papel 1 vez*/

								$printer -> text("**FERREMATERIALES LA CASCADA**"."\n");//Nombre de la empresa

								$printer -> text("Abono A Cuenta"."\n");//Teléfono de la empresa

								$printer -> text("Cuenta N°.".$_POST["nuevoPago"]."\n");//Número de pago
								$printer -> feed(1); //Alimentamos el papel 1 vez*/

								$printer->setJustification(Printer::JUSTIFY_LEFT);

								$printer -> text("Cantidad que se a abonado"."\n");

									$printer->setJustification(Printer::JUSTIFY_LEFT);								

									$printer->text("$ ".number_format($value["abono"],2)."\n");

								$printer -> feed(1); //Alimentamos el papel 1 vez*/			

								$printer->text("Muchas gracias por su preferencia"); //Podemos poner también un pie de página

								$printer -> feed(2); //Alimentamos el papel 3 veces*/

								$printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

								$printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón monedero

								$printer -> close();
							
							echo '<script>
						
							swal({

								type: "success",
								title: "El pago ha sido guardado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then(function(result){

									if(result.value){

										window.location = "pagos";
									}

								});

						 </script> ';
						}


				}else{
					echo '<script>
						
						swal({

							type: "error",
							title: "El pago no puede ir vacío o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "pagos";
								}

							});

					 </script> ';
				}

			}
		}
		/*=============================================
		=            Mostrar Uusarios            =
		=============================================*/
		
		static public function ctrMostrarPagos($item, $valor){


			$tabla ="pagos";
			$respuesta = ModeloPagos::MdlMostrarPagos($tabla, $item, $valor);

			return $respuesta;

		}

		static public function ctrMostrarPagosHoy($item, $valor){


			$tabla ="pagos";
			$respuesta = ModeloPagos::MdlMostrarPagosHoy($tabla, $item, $valor);

			return $respuesta;

		}

		/*=============================================
		=            BORRAR PAGOS            =
		=============================================*/


		static public function ctrBorrarPago(){

			if (isset($_GET["idPago"])) {
				
				$tabla = "pagos";
				$datos = $_GET["idPago"];

				$respuesta = ModeloPagos::mdlBorrarpago($tabla, $datos);

				if ($respuesta == "ok") {
						
						echo '
							
							<script>
						
							swal({

								type: "success",
								title: "El pago ha sido eliminado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then(function(result){

									if(result.value){

										window.location = "pagos";
									}

								});

						 </script>';
					}
			}

		}

		static public function ctrMostrarVentasHoy($item, $valor){

		$tabla = "pagos";
		$respuesta = ModeloPagos::mdlMostrarPagosHoy($tabla, $item, $valor);

		return $respuesta;
	}


	}