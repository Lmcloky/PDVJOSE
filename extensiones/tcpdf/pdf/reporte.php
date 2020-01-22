<?php 

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/pagos.controlador.php";
require_once "../../../modelos/pagos.modelo.php";

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
	<table style="font-size:8px;">
		
		<tr>

			<td style="width:60px"><img src="images/construrama.png"></td>
			
			<td style="width:20px"></td>

			<td style="background-color:white; width:300px">
				<div style=" font-size:8.5px; text-align:center; font-size:16px; line-height:10px;">
					
					<br><br>
					<font face="courier"><b>FERREMATERIALES LA CASCADA</b></font>

				</div>
			</td>

		</tr>
		
	</table>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');


/*=====   **************************************BLOQUE 2 *************************************  ======*/

$bloque2 = <<<EOF
		

	<table style="font-size:10px; padding:5px 10px;">	
		<tr>		
			<td style=" background-color:white; width:540px">
				<font face="courier"><b>Reporte del día</b></font>
			</td>
		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');

/*=====   **************************************BLOQUE 3 *************************************  ======*/

$bloque3 = <<<EOF

	<table style="font-size:8px; padding:5px;">

		<tr>
		
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Saldo Inicial</td>
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Ventas Realizadas</td>
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Total de ventas</td>
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Total de retiros</td>
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Total de gastos</td>
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Saldo Disponible</td>

		</tr>

	</table>


EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

/*=====   **************************************BLOQUE 4 *************************************  ======*/



$bloque4 = <<<EOF

	<table style="font-size:7px; padding:5px ;">
		<tr>
			
			<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ $saldo_inicial
			</td>

			<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ventas
			</td>

			<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ $dinero
			</td>

			<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$retiros
			</td>
			<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ $gastos
			</td>
			<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ $saldo
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

	<table style="font-size:9px; padding:5px;">	

		<tr>

			<td  style="background-color:white; width:15px; text-align:center">
			</td>	

			<td style="background-color:white; width:250px; text-align:left">
				<font face="courier"><b>Ventas del Día</b></font>
			</td>
		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');
			
		

	

/*=====   **************************************BLOQUE 6 *************************************  ======*/

$bloque6 = <<<EOF

	<br>

	<table style="font-size:8px; padding:4px;">

		<tr>

		<td style=" background-color:white; width:15px; text-align:center"></td>

		<td style="border: .6px solid #666; background-color:white; width:45px; text-align:center">Id</td>
		<td style="border: .6px solid #666; background-color:white; width:65px; text-align:center">Nº Nota</td>
		<td style="border: .6px solid #666; background-color:white; width:100px; text-align:center">Metodo De Pago</td>
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Total</td>
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Total Pagado</td>
	
		</tr>

	</table>


EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');



/*=====   **************************************BLOQUE 8 *************************************  ======*/

//TRAEMOS LA INFORMACIÓN DE LAS VENTAS DE HOY
$itemVentas = null;
$valorVentas = null;

$respuestaVentas = ControladorCategorias::ctrMostrarVentasHoy($itemVentas, $valorVentas);

foreach ($respuestaVentas as $key => $item4) {

$valorVenta = number_format($item4["total"], 2);
$valorPagado = number_format($item4["total_pagado"], 2);

// create columns content
$bloque12 = <<<EOF

<table style="font-size:7px; padding:3px;">
<tr>

<td style=" background-color:white; width:15px; text-align:center">

</td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:45px; text-align:center">
	$item4[id]
</td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:65px; text-align:center">
	$item4[codigo]
</td>
<td style="border: .3px solid #666; color:#333; background-color:white; width:100px; text-align:center">
	$item4[metodo_pago]
</td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ 
	$valorVenta
</td>
<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ 
	$valorPagado
</td>
<td style="background-color:white; width:40px;"></td>

</tr>
</table>

EOF;

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// write the first column
$pdf->writeHTML($bloque12, false, false, false, false, '');
}
$bloque5 = <<<EOF

	<table style="font-size:9px; padding:5px;">	

		<tr>

			<td  style="background-color:white; width:15px; text-align:center">
			</td>	

			<td style="background-color:white; width:250px; text-align:left">
				<font face="courier"><b>Abonos a Ventas a Credito</b></font>
			</td>
		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');
			
		

	

/*=====   **************************************BLOQUE 6 *************************************  ======*/

$bloque6 = <<<EOF

	<br>

	<table style="font-size:8px; padding:4px;">

		<tr>

		<td style=" background-color:white; width:15px; text-align:center"></td>

		<td style="border: .6px solid #666; background-color:white; width:45px; text-align:center">Id</td>
		<td style="border: .6px solid #666; background-color:white; width:65px; text-align:center">Nº Nota</td>
		<td style="border: .6px solid #666; background-color:white; width:100px; text-align:center">Metodo De Pago</td>
		<td style="border: .6px solid #666; background-color:white; width:90px; text-align:center">Cantidad</td>

	
		</tr>

	</table>


EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');



/*=====   **************************************BLOQUE 8 *************************************  ======*/

//TRAEMOS LA INFORMACIÓN DE LAS VENTAS DE HOY
$itemPagos = null;
$valorPagos = null;

$respuestaPagos = ControladorPagos::ctrMostrarPagosHoy($itemPagos, $valorPagos);

foreach ($respuestaPagos as $key => $item4) {

$valorPago = number_format($item4["abono"], 2);

// create columns content
$bloque12 = <<<EOF

<table style="font-size:7px; padding:3px;">
<tr>

<td style=" background-color:white; width:15px; text-align:center">

</td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:45px; text-align:center">
	$item4[id]
</td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:65px; text-align:center">
	$item4[codigo_venta]
</td>
<td style="border: .3px solid #666; color:#333; background-color:white; width:100px; text-align:center">
	$item4[metodo_pago]
</td>
<td style="border: .3px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ 
	$valorPago
</td>
<td style="background-color:white; width:40px;"></td>

</tr>
</table>

EOF;

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// write the first column
$pdf->writeHTML($bloque12, false, false, false, false, '');
}


$bloque5 = <<<EOF

	<table style="font-size:9px; padding:5px;">	

		<tr>

			<td  style="background-color:white; width:15px; text-align:center">
			</td>	

			<td style="background-color:white; width:250px; text-align:left">
				<font face="courier"><b>Retiro de $ del sistema</b></font>
			</td>
		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');


/*=====   **************************************BLOQUE 11 *************************************  ======*/

$bloque11 = <<<EOF

<br>

	<table style="font-size:8px; padding:4px;">

		<tr>
		<td style=" background-color:white; width:15px; text-align:center"></td>

		<td style="border: .6px solid #666; background-color:white; width:45px; text-align:center">Id</td>
		<td style="border: .6px solid #666; background-color:white; width:100px; text-align:center">Cantidad</td>
		<td style="border: .6px solid #666; background-color:white; width:155px; text-align:center">Razón</td>

		</tr>

	</table>

EOF;
$pdf->writeHTML($bloque11, false, false, false, false, '');

/*=====   **************************************BLOQUE 12 *************************************  ======*/


/*=====   **************************************BLOQUE 13 *************************************  ======*/


//TRAEMOS LA INFORMACIÓN DE LOS RETIROS

$itemRetiro = null;
$valorRetiro = null;

$respuestaRetiro = ControladorCategorias::ctrMostrarRetiros($itemRetiro, $valorRetiro);

foreach ($respuestaRetiro as $key => $item5) {

$valorRetiro = number_format($item5["retiro"], 2);

// create columns content
$bloque13 = <<<EOF

<table style="font-size:8px; padding:4px;">
<tr>

<td style=" background-color:white; width:15px; text-align:center"></td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:45px; text-align:center">
	$item5[Id]
</td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
	$valorRetiro
</td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:155px; text-align:center">
	$item5[descripcion]
</td>

</tr>
</table>

EOF;


// write the first column
$pdf->writeHTML($bloque13, false, false, false, false, '');
}

/*=====   **************************************BLOQUE 5 *************************************  ======*/

$bloque5 = <<<EOF

	<table style="font-size:9px; padding:5px;">	

		<tr>

			<td  style="background-color:white; width:15px; text-align:center">
			</td>	

			<td style="background-color:white; width:250px; text-align:left">
				<font face="courier"><b>Cambio Agregado</b></font>
			</td>
		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');
			



$bloque6 = <<<EOF

	<br>

	<table style="font-size:8px; padding:4;">

		<tr>
		<td style=" background-color:white; width:15px; text-align:center"></td>
		<td style="border: .px solid #666; background-color:white; width:45px; text-align:center">id</td>
		<td style="border: .px solid #666; background-color:white; width:100px; text-align:center">Cambio</td>
		<td style="background-color:white; width:40px;"></td>
		
		</tr>



	</table>


EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');	

//TRAEMOS LA INFORMACIÓN DEL CAMBIO

$itemCambio = null;
$valorCambio = null;

$respuestaCambio = ControladorCategorias::ctrMostrarCambio($itemCambio, $valorCambio);

foreach ($respuestaCambio as $key => $item1) {

$valorCambio = number_format($item1["cambio"], 2);

// create columns content
$bloque7 = <<<EOF

<table style="font-size:7px; padding:4">
<tr>

<td style=" background-color:white; width:15px; text-align:center"></td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:45px; text-align:center">
	$item1[id]
</td>

<td style="border: .3px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
	$valorCambio
</td>
<td style="background-color:white; width:40px;"></td>

</tr>
</table>

EOF;



// write the first column
$pdf->writeHTML($bloque7, false, false, false, false, '');	
}

$right_column = '';


// write the second column
$pdf->writeHTMLCell(1, '', 200, 248, $right_column, 1, 1, 1, true, 'J', true);

$bloque2 = <<<EOF


	<table style="font-size:8px; padding:5px 10px;">	
		<tr>		
			<td style=" background-color:white; width:390px">
				
			</td>
			<td style=" background-color:white; width:150px; text-align:center; color:green">
			
			</td>
		</tr>

		<tr>		
			<td style=" background-color:white; width:390px">
				
			</td>
			<td style=" background-color:white; width:150px; text-align:center">			
				Fecha: $fecha
			</td>
		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------SALIDA DEL ARCHIVO----------------------------
// ---------------------------SALIDA DEL ARCHIVO----------------------------

$pdf->Output('reporte.pdf');

}

}

$reporte = new imprimirReporte();
$reporte -> Id = $_GET["Id"];
$reporte -> traerImpresionReporte();

?>