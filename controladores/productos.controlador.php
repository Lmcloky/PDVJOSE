<?php 

class ControladorProductos{

	/*=============================================
	=            Mostrar Los Productos            =
	=============================================*/
	
		static public function ctrMostrarProductos($item, $valor, $orden){

			$tabla = "productos";
			$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

			return $respuesta;

		}

		/*=============================================
		=            Crear  Los  Productos            =
		=============================================*/

		static public function ctrCrearProducto(){

			if (isset($_POST["nuevaDescripcion"])) {
				if (preg_match('/^[()\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) && 
					preg_match('/^[0-9.]+$/', $_POST["nuevoStock"]) && 
					preg_match('/^[0-9.]+$/', $_POST["nuevoStockMinimo"]) && 
					preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) && 
					preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){

						$ruta = "vistas/img/productos/default/anonymous.png";

						if (isset($_FILES["nuevaImagen"]["tmp_name"])){

						list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

						$nuevoAncho = 500;
						$nuevoAlto = 500;

						/*=========================================================
						=     Directorio para guardar la imagen            =
						=========================================================*/
						
						$directorio = "vistas/img/productos/".$_POST["nuevaDescripcion"];

						mkdir($directorio, 0755);
							
						/*=========================================================
						=     Subir imagen de acuerdo a sus propiedades           =
						=========================================================*/

						if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

							// Guardamos la imagen
							$aleatorio = mt_rand(100,999);
							$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";
							$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);

						}

						if ($_FILES["nuevaImagen"]["type"] == "image/png") {

							// Guardamos la imagen
							$aleatorio = mt_rand(100,999);
							$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";
							$origen = imagecreatefrompng($_FILES["nuevoCodigo"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

						}
					}

						$tabla = "productos";
						$datos = array("id_categoria" => $_POST["nuevaCategoria"],
										"codigo" => $_POST["nuevoCodigo"],
										"descripcion" => $_POST["nuevaDescripcion"],
										"stock" => $_POST["nuevoStock"],
										"stock_minimo" => $_POST["nuevoStockMinimo"],
										"precio_compra" => $_POST["nuevoPrecioCompra"],
										"precio_venta" => $_POST["nuevoPrecioVenta"],
										"imagen" => $ruta);

						$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

						if ($respuesta == "ok") {
							
							echo '<script>
						
							swal({

								type: "success",
								title: "El producto ha sido guardado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then(function(result){

									if(result.value){

										window.location = "productos";
									}

								});

						 </script> ';
						}


				}else{
					echo '<script>
						
						swal({

							type: "error",
							title: "El producto no puede ir vacío o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "productos";
								}

							});

					 </script> ';
				}

			}
		}

		/*=============================================
		=            Editar  Los  Productos            =
		=============================================*/

		static public function ctrEditarProducto(){

			if (isset($_POST["editarDescripcion"])) {
				if (preg_match('/^[()\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) && 
					preg_match('/^[0-9.]+$/', $_POST["editarStock"]) && 
					preg_match('/^[0-9.]+$/', $_POST["editarStockMinimo"]) && 
					preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) && 
					preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){

						$ruta = $_POST["imagenActual"];
						/*=========================================================
						=     				Validar la imagen  		              =
						=========================================================*/

						if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

						list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

						$nuevoAncho = 500;
						$nuevoAlto = 500;

						/*=========================================================
						=     Directorio para guardar la imagen            =
						=========================================================*/
						
						$directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];

						/*=========================================================
						=        Preguntar si existe imagen en la bd             =
						=========================================================*/

						if (!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png") {
							
							unlink($_POST["imagenActual"]);
						}else{
							mkdir($directorio, 0755);
						}
							
						/*=========================================================
						=     Subir imagen de acuerdo a sus propiedades           =
						=========================================================*/

						if ($_FILES["editarImagen"]["type"] == "image/jpeg") {

							// Guardamos la imagen
							$aleatorio = mt_rand(100,999);
							$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";
							$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);

						}

						if ($_FILES["editarImagen"]["type"] == "image/png") {

							// Guardamos la imagen
							$aleatorio = mt_rand(100,999);
							$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".png";
							$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

						}
					}

						$tabla = "productos";
						$datos = array("id_categoria" => $_POST["editarCategoria"],
										"codigo" => $_POST["editarCodigo"],
										"descripcion" => $_POST["editarDescripcion"],
										"stock" => $_POST["editarStock"],
										"stock_minimo" => $_POST["editarStockMinimo"],
										"precio_compra" => $_POST["editarPrecioCompra"],
										"precio_venta" => $_POST["editarPrecioVenta"],
										"imagen" => $ruta);

						$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

						if ($respuesta == "ok") {
							
							echo '<script>
						
							swal({

								type: "success",
								title: "El producto ha sido editado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								}).then(function(result){

									if(result.value){

										window.location = "productos";
									}

								});

						 </script> ';
						}


				}else{
					echo '<script>
						
						swal({

							type: "error",
							title: "El producto no puede ir vacío o llevar caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							}).then(function(result){

								if(result.value){

									window.location = "productos";
								}

							});

					 </script> ';
				}

			}
		}

	/*==============================================================
	=            		Eliminar  PRODUCTO  			           =
	==============================================================*/

	static public function ctrEliminarProducto(){

		if (isset($_GET["idProducto"])) {
			
			$tabla = "productos";
			$datos = $_GET["idProducto"];

			if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png") {
			
			unlink($_GET["imagen"]);
			rmdir('vistas/img/productos/'.$get["descripcion"]);
			
			}

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if ($respuesta == "ok") {
							
				echo '
					
					<script>
				
					swal({

						type: "success",
						title: "El producto ha sido eliminado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

						}).then(function(result){

							if(result.value){

								window.location = "productos";
							}

						});

				 </script>';
			}
		}
	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

		/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}


}