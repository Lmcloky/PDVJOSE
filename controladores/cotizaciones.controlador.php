<?php 

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorCotizaciones{

	/*==============================================================================
	=                               MOSTRAR LAS VENTAS                             =
	==============================================================================*/
	
	static public function ctrMostrarCotizaciones($item, $valor){

		$tabla = "cotizaciones";

		$respuesta = ModeloCotizaciones::mdlMostrarCotizaciones($tabla, $item, $valor);

		return $respuesta;
	}
	
	/*==============================================================================
	=                               MOSTRAR LAS VENTAS                             =
	==============================================================================*/

	static public function ctrCrearCotizacion(){

		if (isset($_POST["nuevaCotizacion"])) {
			
			/*================================================================================================================================
		    	               ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			================================================================================================================================*/

			$clistaProductos = json_decode($_POST["clistaProductos"], true);

			$totalProductosComprados = array();

			foreach ($clistaProductos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);

				$tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "cotizaciones";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaCotizacion"],
						   "productos"=>$_POST["clistaProductos"],
						   "descuento"=>$_POST["nuevoPrecioDescuento"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);

			$respuesta = ModeloCotizaciones::mdlIngresarCotizacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La cotización se ha creado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "cotizaciones";

								}
							})

				</script>';

			}

		}

	}

		/*==============================================================================
	=                               EDITAR LAS VENTAS                             =
	==============================================================================*/

	static public function ctrEditarCotizacion(){

		if (isset($_POST["editarCotizacion"])) {

			/*================================================================================================================================
		    	               FORMATEAR LA TABLA                      AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			================================================================================================================================*/


			$tabla = "cotizaciones";

			$item = "codigo";
			$valor = $_POST["editarCotizacion"];

			$traerCotizacion = ModeloCotizaciones::mdlMostrarCotizaciones($tabla, $item, $valor);


			if($_POST["clistaProductos"] == ""){

				$clistaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$clistaProductos = $_POST["clistaProductos"];
				$cambioProducto = true;
			}


			if($cambioProducto){	

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

						array_push($totalProductosComprados, $value["cantidad"]);
						
						$tablaProductos = "productos";

						$item = "id";
						$valor = $value["id"];
						$orden = "id";

						$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					}

					$tablaClientes = "clientes";

					$itemCliente = "id";
					$valorCliente = $_POST["seleccionarCliente"];

					$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				
					/*================================================================================================================================
				    	               ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
					================================================================================================================================*/

					$clistaProductos_2 = json_decode($clistaProductos, true);

					$totalProductosComprados_2 = array();

					foreach ($clistaProductos_2 as $key => $value) {

						array_push($totalProductosComprados_2, $value["cantidad"]);

						$tablaProductos_2 = "productos";

					    $item_2 = "id";
					    $valor_2 = $value["id"];
					    $orden = "id";

					    $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					}

					$tablaClientes_2 = "clientes";

					$item_2 = "id";
					$valor_2 = $_POST["seleccionarCliente"];

					$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

					$item1a_2 = "compras";
					$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$tabla = "cotizaciones";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarCotizacion"],
						   "productos"=>$_POST["clistaProductos"],
						   "descuento"=>$_POST["nuevoPrecioDescuento"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);

			$respuesta = ModeloCotizaciones::mdlEditarCotizacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La cotización ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "cotizaciones";

								}
							})

				</script>';

			}

		}

	}

		/*==========================================================================================================================
			                                          		ELIMINAR VENTA                                    
		==========================================================================================================================*/


		static public function ctrEliminarCotizacion(){

		if (isset($_GET["idCotizacion"])) {
			
			$tabla = "Cotizaciones";
			$datos = $_GET["idCotizacion"];

			$respuesta = ModeloCotizaciones::mdlBorrarCotizacion($tabla, $datos);

			if ($respuesta == "ok") {
				
				echo '<script>
						
						swal({

							type: "success",
							title: "La cotización ha sido eliminada exitosamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "cotizaciones";
								}

							});

					 </script> ';

			}
		}

	}
	/*=============================================
	RANGO FECHAS
	=============================================*/	
	static public function ctrRangoFechasCotizaciones($fechaInicial, $fechaFinal){

		$tabla = "cotizaciones";

		$respuesta = ModeloCotizaciones::mdlRangoFechasCotizaciones($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	/*=============================================
	Descargar excel
	=============================================*/	
	// public $codigo;

	public function ctrImprimirReporteCotizacion(){

		if (isset($_GET["cotizacion"])) {

			$tabla = "cotizaciones";

			$item = "codigo";
			$valor = $_GET["codigo"];

			$cotizaciones = ModeloCotizaciones::mdlMostrarCotizaciones($tabla, $item, $valor);

			$fecha = substr($cotizaciones["fecha"],0);
			$productos = json_decode($cotizaciones["productos"], true);
			$neto = number_format($cotizaciones["neto"],2);
			$descuento = number_format($cotizaciones["descuento"],2);
			$total = number_format($cotizaciones["total"],2);


			//TRAEMOS LA INFORMACIÓN DEL CLIENTE

			$itemCliente = "id";
			$valorCliente = $cotizaciones["id_cliente"];

			$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

			//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

			$itemVendedor = "id";
			$valorVendedor = $cotizaciones["id_vendedor"];

			$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);
			/*=============================================
			Crear archivo excel
			=============================================*/

			$Name = $cotizaciones["codigo"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr>
						<td style='width:20px; height:20px;'></td>
					</tr>


					<tr>
						<td></td>
						<td style='font-weight:bold; width:80px; height:80px;'> <img src='http://localhost/PuntoDeVentaJose/vistas/img/plantilla/construrama.png' width='70' height='70'> <br><br></td> 
						<td style='font-size:28px; text-align:right; width:420px;'>FERREMATERIALES LA CASCADA <td/>
						<td style=' font-size:10px; font-weight:times; width:180px;'>Santa Maria Pipioltepec, entrada las Carmelitas, la cascada Valle de Bravo, Estado de México C.P. 51200 Tel: 01 726 110 12 14- Cel: 7221837283</td>
					</tr>

					<tr>
						<td></td>
						<td>Cliente: </td>
						<td>".$respuestaCliente['nombre']."</td>
						<td style='text-align:right;'>Cotización:</td>
						<td style='text-align:left;'>".$cotizaciones['codigo']."</td>
					<tr/>


					<tr> 
					<td> </td>
					<td style='font-weight:bold; border:1px solid #eee; width:80px;'>CANTIDAD</td>
					<td style='font-weight:bold; text-align:center; border:1px solid #eee; width:320px;'>PRODUCTO</td>
					<td style='font-weight:bold; border:1px solid #eee; width:180px;'>VALOR UNITARIO</td>
					<td style='font-weight:bold; border:1px solid #eee; width:180px;'>VALOR TOTAL</td>
					</tr>");

				foreach ($productos as $key => $item) {

				$itemProducto = "descripcion";
				$valorProducto = $item["descripcion"];
				$orden = null;

				$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

				$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

				$precioTotal = number_format($item["total"], 2);
			 			
			 			echo utf8_decode("<tr> <td></td> 

			 		<td style='border:1px solid #eee; height:35px'>".$item["cantidad"]."<br>
			 		<td style='border:1px solid #eee; text-align:center;'>".$item["descripcion"]."<br>
			 		<td style='border:1px solid #eee; text-align:center;'>".$item["precio"]."<br>
			 		<td style='border:1px solid #eee; text-align:center;'>".$precioTotal."<br>

			 		</td></tr>");
			 		}

			 	// echo utf8_decode();	

		 		// foreach ($productos as $key => $valueProductos) {

			 			
		 		// 	echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		// }

		 		echo utf8_decode("
		 			<tr> <td></td> 

			 		<td style='border:1px solid #eee; height:35px'><br>
			 		<td style='border:1px solid #eee; text-align:center;'><br>
			 		<td style='border:1px solid #eee; text-align:center;'><br>
			 		<td style='border:1px solid #eee; text-align:center;'><br>

			 		</td></tr>
		 			<tr> 
		 				<td></td> 
		 			</tr>
		 			<tr> 
		 				<td></td> 
		 			</tr>
		 			<tr>
		 			<td> </td><td> </td><td> </td>
					<td style='text-align:right;'> Total: </td>	
					<td style='text-align:center;'>$ ".number_format($cotizaciones["total"],2)."</td>
		 			</tr>");


			echo "</table>";
		}

	}

}