<?php 

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirReporte{

public $Id;

public function traerImpresionReporte(){


//TRAEMOS LA INFORMACION DEL REPORTE

$itemReporte = "Id";
$valorReporte = $this->Id;

$respuestaReporte = ControladorClientes::ctrMostrarReportes($itemReporte, $valorReporte);

$fecha = substr($respuestaReporte["fecha"],0);
$saldo_inicial = number_format($respuestaReporte["saldo_inicial"],2);
$ventas = number_format($respuestaReporte["ventas"]);
$dinero = number_format($respuestaReporte["dinero"],2);
$retiros = number_format($respuestaReporte["retiros"]);
$gastos = number_format($respuestaReporte["gastos"],2);
$saldo = number_format($respuestaReporte["saldo"],2);


//TRAEMOS LA INFORMACIÓN DE LOS RETIROS

$itemRetiro = null;
$valorRetiro = null;

$respuestaRetiro = ControladorCategorias::ctrMostrarRetiros($itemRetiro, $valorRetiro);

//TRAEMOS LA INFORMACIÓN DE LAS VENTAS DE HOY

$itemVentas = null;
$valorVentas = null;

$respuestaVentas = ControladorCategorias::ctrMostrarVentasHoy($itemVentas, $valorVentas);

//TRAEMOS LA INFORMACIÓN DE LAS VENTAS CANCELADAS

$itemVentasCanceladas = null;
$valorVentasCanceladas = null;

$respuestaVentasCanceladas = ControladorCategorias::ctrMostrarVentasCanceladas($itemVentasCanceladas, $valorVentasCanceladas);

//TRAEMOS LA INFORMACIÓN DE LAS VENTAS EDITADAS

$itemVentasEditadas = null;
$valorVentasEditadas = null;

$respuestaVentasEditadas = ControladorCategorias::ctrMostrarVentasEditadas($itemVentasEditadas, $valorVentasEditadas);


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

/*====================================================================================================================
=            **************************************BLOQUE 1 CABEZERA*************************************            =
====================================================================================================================*/

$bloque1 = <<<EOF

	<br><br>

	<table>
		
		<tr>

			<td style="width:80px"><img src="images/construrama.png"></td>
				
			<td style=" background-color:white; text-align:center; width:340px">
				REPORTE DE VENTA DIARIO 
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br><br> Fecha: $fecha</td>
		</tr>
		
	</table>
	
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');


/*=====   **************************************BLOQUE 2 *************************************  ======*/

$bloque2 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">	

		<tr>		
			<td style=" background-color:white; width:540px">
				REPORTE DEL DÍA 
			</td>
		</tr>

	</table>



EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');

/*=====   **************************************BLOQUE 3 *************************************  ======*/

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Saldo Inicial</td>
		<td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Ventas Realizadas</td>
		<td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Total de ventas</td>
		<td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Total de retiros</td>
		<td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Total de gastos</td>
		<td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">Saldo Disponible</td>

		</tr>

	</table>


EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

/*=====   **************************************BLOQUE 4 *************************************  ======*/



$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ $saldo_inicial
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ventas
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ $dinero
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">$retiros
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ $gastos
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ $saldo
			</td>

		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');

/*=====   **************************************BLOQUE 5 *************************************  ======*/

$bloque5 = <<<EOF

	<table>		
		<tr>			
			<td style="width:140px"><img src="images/back.jpg"></td>
		</tr>
	</table>

	<table style="font-size:10px; padding:5px 10px;">	

		<tr>		
			<td style="background-color:white; width:170px">
				Ventas Canceladas 
			</td>
			<td style="background-color:white; width:140px">
				Cambio Agregado 
			</td>
			<td style="background-color:white; width:200px; text-align:center">
				Ventas Realizadas
			</td>
		</tr>
		
			
		

	</table>

EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');

/*=====   **************************************BLOQUE 6 *************************************  ======*/

$bloque6 = <<<EOF

	<br>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		<td style="background-color:white; width:3px;"></td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">Nº Nota</td>
		<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Cantidad</td>
		<td style="background-color:white; width:40px;"></td>

		<td style="border: 1px solid #666; background-color:white; width:30px; text-align:center">id</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cambio</td>
		<td style="background-color:white; width:40px;"></td>


		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">Nº Nota</td>
		<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Cantidad</td>

		
		</tr>



	</table>


EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');

/*=====   **************************************BLOQUE 7 *************************************  ======*/


//TRAEMOS LA INFORMACIÓN DE LAS VENTAS CANCELADAS

$itemVentasCanceladas = null;
$valorVentasCanceladas = null;

$respuestaVentasCanceladas = ControladorCategorias::ctrMostrarVentasCanceladas($itemVentasCanceladas, $valorVentasCanceladas);

foreach ($respuestaVentasCanceladas as $key => $item2) {

$valorTotal = number_format($item2["total"], 2);

// create columns content
$bloque8 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">
<tr>

<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
	$item2[codigo]
</td>

<td style="border: 1px solid #666; color:#333; background-color:white; width:70px; text-align:center">$ 
	$valorTotal
</td>
<td style="background-color:white; width:40px;"></td>

</tr>
</table>

EOF;

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(999, 999, 999);

// set color for text
$pdf->SetTextColor(000, 000, 000);

// write the first column
$pdf->writeHTMLCell(50, '', '', $y, $bloque8, 0, 1, 1, true, 0, true);
}


//TRAEMOS LA INFORMACIÓN DEL CAMBIO

$itemCambio = null;
$valorCambio = null;

$respuestaCambio = ControladorCategorias::ctrMostrarCambio($itemCambio, $valorCambio);

foreach ($respuestaCambio as $key => $item1) {

$valorCambio = number_format($item1["cambio"], 2);

// create columns content
$bloque7 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">
<tr>

<td style="border: 1px solid #666; color:#333; background-color:white; width:30px; text-align:center">
	$item1[id]
</td>

<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$ 
	$valorCambio
</td>
<td style="background-color:white; width:40px;"></td>

</tr>
</table>

EOF;

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// get current vertical position

// set color for background
$pdf->SetFillColor(999, 999, 999);

// set color for text
$pdf->SetTextColor(000, 000, 000);

// write the first column
$pdf->writeHTMLCell(50, '', 70, '', $bloque7, 0, 1, 1, true, '', true);
}

/*=====   **************************************BLOQUE 8 *************************************  ======*/

/*=====   **************************************BLOQUE 8 *************************************  ======*/

//TRAEMOS LA INFORMACIÓN DE LAS VENTAS DE HOY
$itemVentas = null;
$valorVentas = null;

$respuestaVentas = ControladorCategorias::ctrMostrarVentasHoy($itemVentas, $valorVentas);

foreach ($respuestaVentas as $key => $item4) {

$valorVenta = number_format($item4["total"], 2);

// create columns content
$bloque12 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">
<tr>

<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
	$item4[codigo]
</td>

<td style="border: 1px solid #666; color:#333; background-color:white; width:70px; text-align:center">$ 
	$valorVenta
</td>
<td style="background-color:white; width:40px;"></td>

</tr>
</table>

EOF;

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// set color for background
$pdf->SetFillColor(999, 999, 999);

// set color for text
$pdf->SetTextColor(000, 000, 000);

// write the first column
$pdf->writeHTMLCell(50, '', 124, '', $bloque12, 0, 1, 1, true, '', true);
}

$bloque10 = <<<EOF

	<br><br><br><br><br>

	<table style="font-size:10px; padding:5px 10px;">	

		<tr>		
			<td style="background-color:white; width:270px">
				Ventas Editadas
			</td>
			<td style="background-color:white; width:170px">
				Retiros 
			</td>
		</tr>
		
	</table>


EOF;
$pdf->writeHTML($bloque10, false, false, false, false, '');


/*=====   **************************************BLOQUE 11 *************************************  ======*/

$bloque11 = <<<EOF

<br>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		<td style="background-color:white; width:3px;"></td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">Nº Nota</td>
		<td style="border: 1px solid #666; background-color:white; width:85px; text-align:center">Pago Anterior</td>
		<td style="border: 1px solid #666; background-color:white; width:75px; text-align:center">Pago Actual</td>
		<td style="background-color:white; width:3px;"></td>
			<td style="background-color:white; width:40px;"></td>

		<td style="border: 1px solid #666; background-color:white; width:32px; text-align:center">Id</td>
		<td style="border: 1px solid #666; background-color:white; width:70px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Razón</td>

		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque11, false, false, false, false, '');

/*=====   **************************************BLOQUE 12 *************************************  ======*/


//TRAEMOS LA INFORMACIÓN DE LAS VENTAS EDITADAS

$itemVentasEditadas = null;
$valorVentasEditadas = null;

$respuestaVentasEditadas = ControladorCategorias::ctrMostrarVentasEditadas($itemVentasEditadas, $valorVentasEditadas);

foreach ($respuestaVentasEditadas as $key => $item3) {

$valorTotalv = number_format($item3["total_viejo"], 2);
$valorTotaln = number_format($item3["total_nuevo"], 2);

// create columns content
$bloque9 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">
<tr>

<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
	$item3[codigo]
</td>

<td style="border: 1px solid #666; color:#333; background-color:white; width:85px; text-align:center">$ 
	$valorTotalv
</td>

<td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">$ 
	$valorTotaln
</td>

</tr>
</table>

EOF;

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(999, 999, 999);

// set color for text
$pdf->SetTextColor(000, 000, 000);

// write the first false
$pdf->writeHTMLCell(50, '', '', $y, $bloque9, 0, 1, 0, false, '', false);
}



/*=====   **************************************BLOQUE 13 *************************************  ======*/


//TRAEMOS LA INFORMACIÓN DE LOS RETIROS

$itemRetiro = null;
$valorRetiro = null;

$respuestaRetiro = ControladorCategorias::ctrMostrarRetiros($itemRetiro, $valorRetiro);

foreach ($respuestaRetiro as $key => $item5) {

$valorRetiro = number_format($item5["retiro"], 2);

// create columns content
$bloque13 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">
<tr>

<td style="border: 1px solid #666; color:#333; background-color:white; width:32px; text-align:center">
	$item5[Id]
</td>

<td style="border: 1px solid #666; color:#333; background-color:white; width:70px; text-align:center">$ 
	$valorRetiro
</td>

<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
	$item5[descripcion]
</td>

</tr>
</table>

EOF;

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// set color for background
$pdf->SetFillColor(999, 999, 999);

// set color for text
$pdf->SetTextColor(000, 000, 000);

// write the first column
$pdf->writeHTMLCell(50, '', 103, '', $bloque13, 0, 1, 1, true, '', true);
}

// ---------------------------SALIDA DEL ARCHIVO----------------------------
// ---------------------------SALIDA DEL ARCHIVO----------------------------

$pdf->Output('reporte.pdf');

}

}

$reporte = new imprimirReporte();
$reporte -> Id = $_GET["Id"];
$reporte -> traerImpresionReporte();

?>