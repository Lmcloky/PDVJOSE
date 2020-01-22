<?php 

require_once('../../Vendor/luecano/numero-a-letras/src/NumeroALetras.php');

require_once "../../../controladores/translados.controlador.php";
require_once "../../../modelos/translados.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirTranslado{

public $codigo;

public function traerImpresionTranslado(){


//TRAEMOS LA INFORMACION DE LA VENTA

$itemTranslado = "codigo";
$valorTranslado = $this->codigo;

$respuestaTranslado = ControladorTranslados::ctrMostrarTranslados($itemTranslado, $valorTranslado);

$fecha = substr($respuestaTranslado["fecha"],0);
$productos = json_decode($respuestaTranslado["productos"], true);
$neto = number_format($respuestaTranslado["neto"],2);
$descuento = number_format($respuestaTranslado["descuento"],2);
$total = number_format($respuestaTranslado["total"],2);
$totalLetras = NumeroALetras::convert($respuestaTranslado["total"], 'MXN');

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaTranslado["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaTranslado["id_vendedor"];

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
			<td style=" background-color:white; width:150px; text-align:center; color:green">
			Codigo de Translado de mercancia N° $valorTranslado
			</td>
		</tr>

		<tr>		
			<td style=" background-color:white; width:390px">

			Usuario: $respuestaVendedor[nombre]</td>

		</tr>

		<tr>		
		<td style="border-bottom: .3px solid #666; background-color:white; width:520px"></td>
		</tr>

	</table>



EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');

/*=====   **************************************BLOQUE 3 *************************************  ======*/

$bloque3 = <<<EOF

	<table style="font-size:8px; padding:4px;">

		<tr>

		<td style="border: .4px solid #666; background-color:white; width:260px; text-align:center">CANTIDAD</td>
		<td style="border: .4px solid #666; background-color:white; width:260px; text-align:center">PRODUCTO</td>

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
			<td style=" color:#333; background-color:white; width:260px; text-align:center">
				$item[cantidad]
			</td>

			<td style=" color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

		</tr>
	</table>

EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');
}

$right_column = '';


// write the second column
$pdf->writeHTMLCell(1, '', 200, 248, $right_column, 1, 1, 1, true, 'J', true);

$bloque2 = <<<EOF


	<table style="font-size:8px; padding:5px 10px;">	

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
/*=====   **************************************BLOQUE 5 *************************************  ======*/

// ---------------------------SALIDA DEL ARCHIVO----------------------------
// ---------------------------SALIDA DEL ARCHIVO----------------------------

$pdf->Output('translado.pdf');

}

}



$translado = new imprimirTranslado();
$translado -> codigo = $_GET["codigo"];
$translado -> traerImpresionTranslado();

 ?>