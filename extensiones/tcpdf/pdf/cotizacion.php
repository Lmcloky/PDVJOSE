<?php 

require_once('../../Vendor/luecano/numero-a-letras/src/NumeroALetras.php');

require_once "../../../controladores/cotizaciones.controlador.php";
require_once "../../../modelos/cotizaciones.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirCotizacion{

public $codigo;

public function traerImpresionCotizacion(){


//TRAEMOS LA INFORMACION DE LA VENTA

$itemCotizacion = "codigo";
$valorCotizacion = $this->codigo;

$respuestaCotizacion = ControladorCotizaciones::ctrMostrarCotizaciones($itemCotizacion, $valorCotizacion);

$fecha = substr($respuestaCotizacion["fecha"],0);
$productos = json_decode($respuestaCotizacion["productos"], true);
$neto = number_format($respuestaCotizacion["neto"],2);
$descuento = number_format($respuestaCotizacion["descuento"],2);
$total = number_format($respuestaCotizacion["total"],2);
$totalLetras = NumeroALetras::convert($respuestaCotizacion["total"], 'MXN');

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaCotizacion["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaCotizacion["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

/*====================================================================================================================
=            **************************************BLOQUE 1 CABEZERA*************************************            =
====================================================================================================================*/
$bloque1 = <<<EOF
	<table style="font-size:8px;">
		
		<tr>

			<td style="width:60px"><img src="images/construrama.png"></td>
			
			<td style="width:20px"></td>

			<td style="background-color:white; width:300px">
				<div style="font-style:helvetica; font-size:8.5px; text-align:center; font-size:16px; line-height:10px;">
					
					<br><br>
					<font face="courier"><b>FERREMATERIALES LA CASCADA</b></font>

				</div>
			</td>
			<td style="width:20px"></td>

			<td style="background-color:white; width:140px; text-align:center; color:#212f3c">
				<div style="font-size:8px; text-align:right; line-height:10px;">

					<br>
					<font face="times"><b>
					Santa Maria Pipioltepec, entrada las<br> Carmelitas, la cascada  Valle de Bravo,<br> Estado de México C.P. 51200

					<br>
					Tel: 01 726 110 12 14-
					Cel: 7221837283</b></font>
				</div>

			</td>

		</tr>
		
	</table>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');



/*=====   **************************************BLOQUE 2 *************************************  ======*/

$bloque2 = <<<EOF


	<table style="font-size:8px; padding:5px 10px;">	


		<tr>		

			<td style=" background-color:white; width:390px">
				Cliente: $respuestaCliente[nombre]
			</td>
			<td style=" background-color:white; width:150px; text-align:center; color:red">
			Cotización N° $valorCotizacion
			</td>
		</tr>

		<tr>		
			<td style=" background-color:white; width:390px">Vendedor: $respuestaVendedor[nombre]</td>
			<td style=" background-color:white; width:150px; text-align:center">			
				Fecha: $fecha
			</td>
		</tr>

		<tr>		
		<td style="border-bottom: .3px solid #666; background-color:white; width:540px"></td>
		</tr>

	</table>



EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');

/*=====   **************************************BLOQUE 3 *************************************  ======*/

$bloque3 = <<<EOF

	<table style="font-size:8px; padding:4px;">

		<tr>

		<td style="border: .4px solid #666; background-color:white; width:80px; text-align:center">CANTIDAD</td>
		<td style="border: .4px solid #666; background-color:white; width:260px; text-align:center">PRODUCTO</td>
		<td style="border: .4px solid #666; background-color:white; width:100px; text-align:center">VALOR UNITARIO.</td>
		<td style="border: .4px solid #666; background-color:white; width:100px; text-align:center">VALOR TOTAL</td>

		</tr>

	</table>


EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

/*=====   **************************************BLOQUE 4 *************************************  ======*/

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:7px; padding:5px;">
		<tr>
			<td style=" color:#333; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style=" color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style=" color:#333; background-color:white; width:100px; text-align:center">$ 
				$item[precio]
			</td>

			<td style=" color:#333; background-color:white; width:100px; text-align:center">$ 
				$precioTotal
			</td>

		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');
}

$right_column = '';


// write the second column
$pdf->writeHTMLCell(1, '', 200, 240, $right_column, 1, 1, 1, true, 'J', true);
/*=====   **************************************BLOQUE 5 *************************************  ======*/

$bloque5 = <<<EOF

	<table style="font-size:8px; padding:3px;">

		<tr>
		<td style=" color:#333; background-color:white; width:50px; text-align:center">
			</td>		
			<td style=" color:#333; background-color:white; width:300px; text-align:center">
				($totalLetras )
			</td>
			<td style=" background-color:white; width:40px; text-align:center">
				TOTAL:
			</td>			
			<td style="border-bottom: .8px solid #666; color:#333; background-color:white; width:90px; text-align:center">
				$ $total
			</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------SALIDA DEL ARCHIVO----------------------------
// ---------------------------SALIDA DEL ARCHIVO----------------------------

$pdf->Output('cotizacions.pdf');

}

}



$cotizacions = new imprimirCotizacion();
$cotizacions -> codigo = $_GET["codigo"];
$cotizacions -> traerImpresionCotizacion();

 ?>