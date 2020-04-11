<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Pagos
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Pagos</li>
      </ol>
    </section>


    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3> -->
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
            
            Agregar Pago
          </button>

          <button class="btn btn-success btnImprimirAdeudos" style="float: right;"> Reporte de Adeudos

          </button>

        </div>

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th style="width: 120px;">Codigo de Venta</th>
                  <th>Metodo de Pago</th>
                  <th>Abono</th>

                  <th>Fecha</th>
                  <th>Acciones</th>

                </tr>
              </thead>
              
              <tbody>
                
                <?php 

                  $item = null;
                  $valor = null;

                  $pagos = ControladorPagos::ctrMostrarPagos($item, $valor);

                  foreach ($pagos as $key => $value){
                   
                    echo '
                      <tr>
                        <td>'.$value["id"].'</td>
                        <td>'.$value["codigo_venta"].'</td>
                        <td>'.$value["metodo_pago"].'</td>
                        <td>'.$value["abono"].'</td>
                        <td>'.$value["fecha"].'</td>
                        <td>';

                                if($_SESSION["perfil"] == "Administrador"){

                                echo '

    
                            <button class="btn btn-danger btnEliminarPago" idPago="'.$value["id"].'"> <i class="fa fa-times"></i> </button>';
                              }

                              echo '

                          </div>

                        </td>

                      </tr>
  
                    ';
                  }

                 ?>
              </tbody>
            </table>
          
        </div>

      </div>

    </section>
  </div>


 <!--=================================
 =          ###Modal Agregar Usuarios###            =
 ==================================-->
 

<div id="modalAgregarUsuario" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post" enctype="multipart/form-data"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Pago</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-chain"></i></span> 

                <select class="form-control input-lg select2" style="width: 100%; height: 300px;" id="nuevoPago" name="nuevoPago" required>
                  
                  <option value="">Selecionar código de venta</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $ventas = ControladorVentas::ctrMostrarVentasPendientes($item, $valor);

                  foreach ($ventas as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">';

                        $itemCliente = "id";
                        $valorCliente = $value["id_cliente"];

                        $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                        $resta = $value["total"]-$value["total_pagado"];

                    echo 'Venta '.$value["codigo"].' Cliente: '.$respuestaCliente["nombre"].' Resta: '.$resta.' </option>';
                  }

                  ?>
  
                </select>
              </div>
            </div>
              
              <!-- entrada para el usuario -->
              <div class="form-group">              
                <div class="input-group">              
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span> 
                  <input type="number" class="form-control input-lg" name="abono" step="any" min="0" placeholder="Cantidad a abonar" required>
                </div>
              </div>

              <div class="form-group">

                        <!-- <div class="col-xs-4" style="padding-right: 0px;"> -->
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span> 
                            <select class="form-control select2 input-lg" style="width: 100%" id="metodoPago" name="metodoPago" required>
                              <option value="Efectivo">Efectivo</option>
                              <option value="TC">Tarjeta de Crédito</option>
                              <option value="TD">Tarjeta De Débito</option>
                              <option value="TRANSFERENCIA">Transferencia</option>
                            </select>
                          </div>
                        <!-- </div> -->

                </div>
          </div>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary"> Guardar Pago</button>
        </div>

        <?php 

          $crearPago = new ControladorPagos();
          $crearPago -> ctrCrearPago();
          
         ?>

      </form>
    </div>
    
  </div>
</div>

<?php 
    
    $borrarPago = new ControladorPagos();
    $borrarPago -> ctrBorrarPago();


 ?>