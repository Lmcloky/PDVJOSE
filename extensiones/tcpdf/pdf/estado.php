<?php 

require_once('../../Vendor/luecano/numero-a-letras/src/NumeroALetras.php');

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/pagos.controlador.php";
require_once "../../../modelos/pagos.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";



class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){


//TRAEMOS LA INFORMACION DE LA VENTA

$itemVenta = "id_cliente";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentasCliente($itemVenta, $valorVenta);

// $fecha = substr($respuestaVenta["fecha"],0,-8);
// $productos = json_decode($respuestaVenta["productos"], true);
// $neto = number_format($respuestaVenta["neto"],2);
// $impuesto = number_format($respuestaVenta["impuesto"],2);
// $total = number_format($respuestaVenta["total"],2);
// $estado = number_format($respuestaVenta["estado"]);
// $totalpagado = number_format($respuestaVenta["total_pagado"],2);
// $totalLetras = NumeroALetras::convert($respuestaVenta["total"], 'MXN');

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $this->codigo;

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR
date_default_timezone_set('America/Mexico_City');

$fecha = date('Y-m-d');

$hora = date('H:i:s');

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
				<div style="font-size:8.5px; text-align:center; font-size:16px; line-height:10px;">
					
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
	<table style="font-size:8px; padding:1px ;">	
		<tr>		
			<td style=" background-color:white; width:210px; face:times">
				Cliente: <b> $respuestaCliente[nombre]  </b> 
			</td>
			<td style=" background-color:white; width:100px; face:times">
				
			</td>
			<td style=" background-color:white; width:210px; face:times; text-align:rigth">
				$fecha $hora  
			</td>

		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');

/*=====   **************************************BLOQUE 3 *************************************  ======*/
/*====================================================================================================================
=            **************************************BLOQUE 1 CABEZERA*************************************            =
====================================================================================================================*/
/*====================================================================================================================
=            **************************************BLOQUE 1 CABEZERA*************************************            =
====================================================================================================================*/
/*====================================================================================================================
=            **************************************BLOQUE 1 CABEZERA*************************************            =
====================================================================================================================*/

foreach ($respuestaVenta as $key => $item) {
$resta = $item["total"]-$item["total_pagado"];

$itemPago = "id_venta";
$valorPago = $item["id"];
$respuestaPagos = ControladorPagos::ctrMostrarPagosClientes($itemPago, $valorPago);


$bloque3 = <<<EOF

	<table style="font-size:7px; padding:3px ;">
	<tr>		
		<td style="border-bottom: .3px solid #666; background-color:white; width:530px"></td>
		</tr>

		<tr>
		<td style=" background-color:white; width:80px; text-align:center">PEDIDO</td>
		<td style="border: .5px solid #666; background-color:white; width:80px; text-align:center">CODIGO</td>
		<td style="border: .5px solid #666; background-color:white; width:120px; text-align:center">TOTAL</td>		
		<td style="border: .5px solid #666; background-color:white; width:120px; text-align:center">TOTAL PAGADO</td>
		<td style="border: .5px solid #666; background-color:white; width:120px; text-align:center">RESTA</td>

		</tr>

	</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
/*=====   **************************************BLOQUE 4 *************************************  ======*/
$bloque4 = <<<EOF

	<table style="font-size:7px; padding:2px 10px;">
		<tr>
		<td style=" color:#333; background-color:white; width:80px; text-align:center">
				
			</td>
			<td style=" color:#333; background-color:white; width:80px; text-align:center">
				$item[codigo]
			</td>

			<td style=" color:#333; background-color:white; width:150px; text-align:center">
				$item[total]
			</td>

			<td style=" color:#333; background-color:white; width:95px; text-align:center">$ 
				$item[total_pagado]
			</td>
			<td style=" color:#333; background-color:white; width:95px; text-align:center">$ 
				$resta
			</td>
		</tr>


	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

foreach ($respuestaPagos as $key => $value) {
$bloque4 = <<<EOF
	<table style="font-size:6px; padding:3px ;">

		<tr>
		<td style=" background-color:white; width:80px; text-align:center">PAGOS</td>
		<td style="border: .5px solid #666; background-color:white; width:80px; text-align:center">ID</td>
		<td style="border: .5px solid #666; background-color:white; width:120px; text-align:center">ABONO</td>

		</tr>
		

	</table>
	<table style="font-size:6px; padding:2px;">
		<tr>
		<td style=" color:#333; background-color:white; width:80px; text-align:center">
				
			</td>
			<td style=" color:#333; background-color:white; width:80px; text-align:center">
				$value[id]
			</td>

			<td style=" color:#333; background-color:white; width:150px; text-align:center">
				$value[abono]
			</td>
		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
}
}
/*=====   **************************************BLOQUE 5 *************************************  ======*/



/*=====   **************************************BLOQUE 4 *************************************  ======*/

/*====================================================================================================================
=            **************************************BLOQUE 1 CABEZERA*************************************            =
====================================================================================================================*/

/*====================================================================================================================
=            **************************************BLOQUE 1 CABEZERA*************************************            =
====================================================================================================================*/

// ---------------------------SALIDA DEL ARCHIVO----------------------------
// 

// ---------------------------SALIDA DEL ARCHIVO----------------------------

$pdf->Output('factura.pdf');

}

}



$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

 ?>