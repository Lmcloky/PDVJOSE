$(".tabla").on("click", ".btnImprimirReporte", function(){

	var idReporte = $(this).attr("idReporte");

	window.open("extensiones/tcpdf/pdf/reporte.php?Id="+idReporte, "_blank");

})