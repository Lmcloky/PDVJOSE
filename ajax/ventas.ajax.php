<?php 

	require_once "../controladores/ventas.controlador.php";
	require_once "../modelos/ventas.modelo.php";

	class AjaxVentas{


		/*========================================
		=            eActivar Usuarios            =
		========================================*/

		public $activarId;
		public $activarVenta;

		public function ajaxActivarVenta(){

			$tabla = "ventas";

			$item1 = "ver";
			$valor1 = $this->activarVenta;

			$item2 = "id";
			$valor2 = $this->activarId;

			$respuesta = ModeloVentas::mdlActualizarVenta($tabla, $item1, $valor1, $item2, $valor2);


		}


	}
	/*========================================
		=            eActivar Usuarios            =
		========================================*/

if(isset($_POST["activarVenta"])) {
	
	$activarVenta = new AjaxVentas();
	$activarVenta -> activarVenta = $_POST["activarVenta"];
	$activarVenta -> activarId = $_POST["activarId"];
	$activarVenta -> ajaxActivarVenta();
}
