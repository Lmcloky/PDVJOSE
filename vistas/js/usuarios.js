/*==============================================
=             Subiendo foto             =
==============================================*/
$(".nuevaFoto").change(function(){
	var imagen = this.files[0];
	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
		$(".nuevaFoto").val("");
		  swal({
		  	title: "Error al subir la imagen",
		  	text: "¡La imagen debe de estar en formato JPG O PNG!",
		  	type: "error",
		  	confirmButtonText: "Cerrar"
		  });
	}else if (imagen["size"] > 6000000) {
		$(".nuevaFoto").val("");
			swal({
				title: "Error al subir la imagen",
				text: "¡La imagen NO debe pesar mas de 6MB!",
				type: "error",
				confirmButtonText: "Cerrar"
			});
	}else{
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load", function(event){
			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src", rutaImagen);
		})
	} 
})

/*==============================================
=             Editar usuario             =
==============================================*/

$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#fotoActual").val(respuesta["foto"]);

			$("#passwordActual").val(respuesta["password"]);

			if (respuesta["foto"] != "") {

				$(".previsualizar").attr("src", respuesta["foto"]);
			}
		}

	});

})

/*==============================================
=             Activar usuario             =
==============================================*/
$(document).on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
	datos.append("activarId", idUsuario);
	datos.append("activarUsuario", estadoUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType:false,
		processData:false,
		success: function(respuesta){

				if(window.matchMedia("(max-width:767px)").matches){

	      		 swal({
			      title: "El usuario ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "usuarios";

			        }


				})

	      	}

		}
	})
	if (estadoUsuario == 0){

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario',1)
	}else{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario',0)
	}

})

/*==============================================
=             Revisar Nombre de usuario             =
==============================================*/

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType:false,
		processData:false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				$("#nuevoUsuario").parent().after('<div class="alert alert-warning"> Este usuario ya existe, porfavor poner otro nick name</div>')
				$("#nuevoUsuario").val("");
			}

		}
	})
})
/*==============================================
=             Eliminar Usuario             =
==============================================*/

$(document).on("click", ".btnEliminarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");

	swal({

		title: '¿Esta seguro de eliminar el Usuario?',
		text: "¡Puede cancelar esta acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtontext: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario!'
	}).then((result)=>{
		if (result.value){

			window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;

		}
	})

})