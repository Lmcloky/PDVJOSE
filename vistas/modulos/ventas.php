<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Ventas
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Ventas</li>
      </ol>
    </section>


    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3> -->
          
          <a href="crear-venta">
            <button class="btn btn-primary">            
              Agregar Venta            
            </button>
          </a>

          <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            
              <span>
                <i class="fa fa-calendar"></i> Rango de Fecha
              </span>

              <i class="fa fa-caret-down"></i>

          </button>
          
        </div>
        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th >Código Factura</th>
                  <th >Cliente</th>
                  <th >Vendedor</th>
                  <th >Forma de pago</th>
                  <th >Total</th>
                  <th >Total Pagado</th>
                  <th >Estado</th>
                  <th >Fecha</th>
                  <th >Acciones</th>

                </tr>
              </thead>
              
              <tbody>

                <?php 

                    if (isset($_GET["fechaInicial"])) {
                      
                      $fechaInicial = $_GET["fechaInicial"];
                      $fechaFinal = $_GET["fechaFinal"];

                    }else{

                      $fechaInicial = null;
                      $fechaFinal = null;

                    }

                    $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

                    foreach ($respuesta as $key => $value) {
           
                     echo '<tr>

                            <td>'.$value["id"].'</td>

                            <td>'.$value["codigo"].'</td>';

                            $itemCliente = "id";
                            $valorCliente = $value["id_cliente"];

                            $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                            echo '<td>'.$respuestaCliente["nombre"].'</td>';

                            $itemUsuario = "id";
                            $valorUsuario = $value["id_vendedor"];

                            $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                            echo '<td>'.$respuestaUsuario["nombre"].'</td>

                            <td>'.$value["metodo_pago"].'</td>

                            <td>$ '.number_format($value["total"],2).'</td>

                            <td>$ '.number_format($value["total_pagado"],2).'</td>';

                              if ($value["estado"] != 0) {
                                echo '<td> <button class="btn btn-success btn-xs" estado="0"> Pagado </button> </td>';
                              }else{
                                echo '<td> <button class="btn btn-danger btn-xs" estado="1"> Adeudo </button> </td>';
                              };

                            echo '<td>'.$value["fecha"].'</td>

                            <td>

                              <div class="btn-group">
                                  
                                <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">
                                <i class="fa fa-print"></i>
                                </button>';

                                if($_SESSION["perfil"] == "Administrador"){

                                echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button> 

                                <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                              }

                              echo '</div>

                            </td>

                          </tr>';
                      }


                 ?>
                
              </tbody>
            </table>

            <?php

            $eliminarVenta = new ControladorVentas();
            $eliminarVenta -> ctrEliminarVenta();

            ?>
          
        </div>

      </div>

    </section>
  </div>

