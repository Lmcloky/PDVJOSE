<?php

require_once "../../controladores/cotizaciones.controlador.php";
require_once "../../modelos/cotizaciones.modelo.php";
require_once "../../controladores/ventas.controlador.php";
require_once "../../modelos/ventas.modelo.php";
require_once "../../controladores/productos.controlador.php";
require_once "../../modelos/productos.modelo.php";
require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

$cotizacion = new ControladorCotizaciones();
$cotizacion -> ctrImprimirReporteCotizacion();