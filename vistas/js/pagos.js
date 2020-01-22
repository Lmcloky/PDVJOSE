/*==============================================
=             Eliminar Pago             =
==============================================*/

$(document).on("click", ".btnEliminarPago", function(){

	var idPago = $(this).attr("idPago");

	swal({

		title: '¿Esta seguro de eliminar el Pago?',
		text: "¡Puede cancelar esta acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtontext: 'Cancelar',
		confirmButtonText: 'Si, borrar pago!'
	}).then((result)=>{
		if (result.value){

			window.location = "index.php?ruta=pagos&idPago="+idPago;

		}
	})

})