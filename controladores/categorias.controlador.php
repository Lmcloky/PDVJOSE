<?php 

class ControladorCategorias{

	/*========================================
	=            Crear Categorias            =
	========================================*/
	
	static public function ctrCrearCategoria(){

		if (isset($_POST["nuevaCategoria"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {
				
				$tabla = "categorias";

				$datos = $_POST["nuevaCategoria"];

				$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>
						
						swal({

							type: "success",
							title: "La categoría ha sido guardada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "categorias";
								}

							});

					 </script> ';
				}

			}else{

				echo '<script>
						
						swal({

							type: "error",
							title: "La categoria no puede ir vacía o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "categorias";
								}

							});

					 </script> ';

			}
		}
	}
	
	/*========================================
	=            Mostrar Categorias            =
	========================================*/

	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;
	}

	/*========================================
	=            Editar Categorias            =
	========================================*/

	static public function ctrEditarCategoria(){

		if (isset($_POST["editarCategoria"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])) {
				
				$tabla = "categorias";

				$datos = array("categoria" => $_POST["editarCategoria"], "id" => $_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>
						
						swal({

							type: "success",
							title: "La categoría ha sido editada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "categorias";
								}

							});

					 </script> ';
				}

			}else{

				echo '<script>
						
						swal({

							type: "error",
							title: "La categoria no puede ir vacía o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "categorias";
								}

							});

					 </script> ';

			}
		}
	}

	/*========================================
	=            Borrar Categorias            =
	========================================*/

	static public function ctrBorrarCategoria(){

		if (isset($_GET["idCategoria"])) {
			
			$tabla = "Categorias";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if ($respuesta == "ok") {
				
				echo '<script>
						
						swal({

							type: "success",
							title: "La categoría ha sido eliminada exitosamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "categorias";
								}

							});

					 </script> ';

			}
		}

	}

	static public function ctrCrearRetiro(){

		if (isset($_POST["cantidad"])) {
			
			if (preg_match('/^[0-9]+$/', $_POST["cantidad"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])
			    ) { 
					$tabla = "retiros";

				   	$datos = array("retiro"=>$_POST["cantidad"],
						           "descripcion"=>$_POST["descripcion"]);

				   	$respuesta = ModeloCategorias::mdlIngresarRetiro($tabla, $datos);

				   	if($respuesta == "ok"){

						echo'<script>

						swal({
							  type: "success",
							  title: "La transacción se ha realizado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "reporte";

										}
									})

						</script>';

					}
				
			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El campo no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "reporte";

							}
						})

			  	</script>';

			}
		}
	}
}