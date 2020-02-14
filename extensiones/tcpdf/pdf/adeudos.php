<?php 

require_once('../../Vendor/luecano/numero-a-letras/src/NumeroALetras.php');

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){


//TRAEMOS LA INFORMACION DE LA VENTA
//
$itemVenta = null;
$valorVenta = null;

$respuestaVenta = ControladorVentas::ctrMostrarVentasPendientes($itemVenta, $valorVenta);

date_default_timezone_set('America/Mexico_City');

$fecha = date('Y-m-d');

$hora = date('H:i:s');


// $fecha = substr($respuestaVenta["fecha"],0,-8);
// $productos = json_decode($respuestaVenta["productos"], true);
// $neto = number_format($respuestaVenta["neto"],2);
// $impuesto = number_format($respuestaVenta["impuesto"],2);
// $total = number_format($respuestaVenta["total"],2);
// $estado = number_format($respuestaVenta["estado"]);
// $totalpagado = number_format($respuestaVenta["total_pagado"],2);
// $totalLetras = NumeroALetras::convert($respuestaVenta["total"], 'MXN');

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

// $itemCliente = "id";
// $valorCliente = $respuestaVenta["id_cliente"];

// $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

// //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

// $itemVendedor = "id";
// $valorVendedor = $respuestaVenta["id_vendedor"];

// $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF
//
// $resta = $respuestaVenta["total"] - $respuestaVenta["total_pagado"];

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

$bloque2 = <<<EOF


	<table style="font-size:9px; padding:5px;">	


		<tr>		

			<td style=" background-color:white; width:390px">
				****REPORTE DE ADEUDOS****
			</td>
			<td style=" background-color:white; width:70px">
				$fecha 
			</td>
			<td style=" background-color:white; width:70px">
				$hora 
			</td>
		</tr>
		<tr>			
		<td style="border-bottom: .3px solid #666; background-color:white; width:540px"></td>
		</tr>

	</table>



EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');


$bloque3 = <<<EOF

	<table style="font-size:9px; padding:2px 10px;">
		<tr>
			<td style="border: .8px solid #666; color:#333; background-color:white; width:66px; text-align:center">
				Codigo
			</td>

			<td style="border: .8px solid #666; color:#333; background-color:white; width:122px; text-align:left">
				Nombre Del Cliente
			</td>
			<td style="border: .8px solid #666; color:#333; background-color:white; width:122px; text-align:left">
				Nombre Opcional
			</td>
				
			<td style="border: .8px solid #666; color:#333; background-color:white; width:80px; text-align:left">
			Total A Pagar
			</td>
			<td style="border: .8px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				Abonado
			</td>

			<td style="border: .8px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				Resta
			</td>

		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

/*=====   **************************************BLOQUE 4 *************************************  ======*/
foreach ($respuestaVenta as $key => $value) {

$itemCliente = "id";
$valorCliente = $value["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

$resta = $value["total"]-$value["total_pagado"];

$bloque4 = <<<EOF

	<table style="font-size:8px; padding:5px;">
		<tr>
			<td style="border: .5px solid #666; color:#333; background-color:white; width:66px; text-align:center">
				$value[codigo]
			</td>

			<td style="border: .5px solid #666; color:#333; background-color:white; width:122px; text-align:left">
				$respuestaCliente[nombre]
			</td>
			<td style="border: .5px solid #666; color:#333; background-color:white; width:122px; text-align:left">
				$value[nombre]
			</td>
				
			<td style="border: .5px solid #666; color:#333; background-color:white; width:80px; text-align:left">$ 
				$value[total]
			</td>

			<td style="border: .5px solid #666; color:#333; background-color:white; width:80px; text-align:center">$
				$value[total_pagado]
			</td>
			<td style="border: .5px solid #666; color:#333; background-color:white; width:80px; text-align:left">$ 
				$resta
			</td>
		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');
}
$right_column = '';

// write the second column
$pdf->writeHTMLCell(1, '', 198, 120, $right_column, 1, 1, 1, true, 'J', true);
/*=====   **************************************BLOQUE 5 *************************************  ======*/



/*====================================================================================================================
=            **************************************BLOQUE 1 CABEZERA*************************************            =
====================================================================================================================*/


// ---------------------------SALIDA DEL ARCHIVO----------------------------
// 
// $pdf->SetFont('times', '', 9);
// $pdf->SetTextColor(150);
// $pdf->SetDrawColor(150);
// $pdf->StartTransform();
// $pdf->Rotate(90, 80, 120);
// $pdf->Rect(70, 44, 70, 4, 'D');
// $pdf->Text(72, 44, 'Total Abonado:  $'.$totalpagado.' MXN.  Resta: $'.$resta.' MXN.');
// // Stop Transformation
// $pdf->StopTransform();
// $pdf->SetDrawColor(0);
// $pdf->SetTextColor(0);
// $pdf->SetTextColor(150);
// $pdf->SetDrawColor(150);
// $pdf->StartTransform();
// $pdf->Rotate(90, 146, 186);
// $pdf->Rect(70, 44, 70, 4, 'D');
// $pdf->Text(72, 44, 'Total Abonado:  $'.$totalpagado.' MXN.  Resta: $'.$resta.' MXN.');
// // Stop Transformation
// $pdf->StopTransform();
// $pdf->SetDrawColor(0);
// $pdf->SetTextColor(0);

// ---------------------------SALIDA DEL ARCHIVO----------------------------

$pdf->Output('factura.pdf');

}

}



$factura = new imprimirFactura();
// $factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

 ?>