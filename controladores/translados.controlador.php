<?php 

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorTranslados{

	/*==============================================================================
	=                               MOSTRAR LAS VENTAS                             =
	==============================================================================*/
	
	static public function ctrMostrarTranslados($item, $valor){

		$tabla = "traslados";

		$respuesta = ModeloTranslados::mdlMostrarTranslados($tabla, $item, $valor);

		return $respuesta;
	}
	
	/*==============================================================================
	=                               MOSTRAR LAS VENTAS                             =
	==============================================================================*/

	static public function ctrCrearTranslado(){

		if (isset($_POST["nuevoTranslado"])) {
			
			/*================================================================================================================================
		    	               ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			================================================================================================================================*/

			$tlistaProductos = json_decode($_POST["tlistaProductos"], true);

			$totalProductosComprados = array();

			foreach ($tlistaProductos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);

				$tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

			    $item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "traslados";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevoTranslado"],
						   "productos"=>$_POST["tlistaProductos"],
						   "descuento"=>$_POST["nuevoPrecioDescuento"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);

			$respuesta = ModeloTranslados::mdlIngresarTranslado($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "El registro se ha creado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "translados";

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


			if($_POST["tlistaProductos"] == ""){

				$tlistaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$tlistaProductos = $_POST["tlistaProductos"];
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

					$tlistaProductos_2 = json_decode($tlistaProductos, true);

					$totalProductosComprados_2 = array();

					foreach ($tlistaProductos_2 as $key => $value) {

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
						   "productos"=>$_POST["tlistaProductos"],
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


		static public function ctrEliminarTranslado(){

		if (isset($_GET["idTranslado"])) {
			
			$tabla = "traslados";
			$datos = $_GET["idTranslado"];

			$respuesta = ModeloTranslados::mdlBorrarTranslado($tabla, $datos);

			if ($respuesta == "ok") {
				
				echo '<script>
						
						swal({

							type: "success",
							title: "El Registro ha sido eliminada exitosamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "translados";
								}

							});

					 </script> ';

			}
		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasTranslados($fechaInicial, $fechaFinal){

		$tabla = "traslados";

		$respuesta = ModeloTranslados::mdlRangoFechasTranslados($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}


	/*============================================
	Descargar excel
	=============================================*/	

	static public function ctrDescargarReporte(){

		if (isset($_GET["reporte"])) {
			
			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}

			/*=============================================
			Crear archivo excel
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

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
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";
		}
	}

}