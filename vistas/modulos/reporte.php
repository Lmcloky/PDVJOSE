<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reporte Diario
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar El Reporte del dia</li>
      </ol>
    </section>


    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3> -->
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSaldo">
            
            Agregar Saldo Inicial

          </button>

          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCambio">
            
            Agregar Cambio

          </button>

            <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarRetiro">

              Retirar Saldo
            </button>
        </div>


        <div class="box-body">
          <div class="row">
            <div class="col-md-12 col-xs-12">

              <div class="box-header with-border">  
                  <h3 class="box-title"> Reporte Del Día </h3>
                </div>
              
              <table class="table table-bordered table-striped dt-responsive tabla">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Saldo Inicial</th>
                  <th>Total de Ventas</th>
                  <th>Ventas</th>
                  <th>Total de retiros</th>
                  <th>Gastos De Hoy</th>
                  <!-- <th>Descripción</th> -->
                  <th>Saldo Disponible</th>
                  <th>Imprimir</th>

                </tr>
              </thead>
              
              <tbody>
                <?php 

                $item = null;
                $valor = null;

                $reportes = ControladorClientes::ctrMostrarReportes($item, $valor);

                foreach ($reportes as $key => $value) {
            

              echo '<tr>

                      <td>'.$value["Id"].'</td>
                      <td>$ '.number_format($value["saldo_inicial"],2).'</td>
                      <td>'.$value["ventas"].'</td>
                      <td>$ '.number_format($value["dinero"],2).'</td>
                      <td>'.$value["retiros"].'</td>
                      <td>$ '.number_format($value["gastos"],2).'</td>
                      <!-- <th>Descripcion</th> -->
                      <td>$ '.number_format($value["saldo"],2).'</td>

                      <td>
                          
                          <div class="btn-group">
                                  
                                <button class="btn btn-info btnImprimirReporte" idReporte="'.$value["Id"].'">
                                <i class="fa fa-print"></i>
                                </button>

                          </div>
                      </td>

                    </tr>';
                  }

                ?>

                
              </tbody>
            </table>
              
            </div>

            <div class="col-md-2 col-xs-12">

                <div class="box-header with-border">  
                  <h3 class="box-title"> Cambio agragado </h3>
                </div>
              
                  <table class="table table-bordered table-striped dt-responsive">
                    <thead>
                      <tr>
                        <th style="width: 10px;">#</th>
                        <th>Cantidad</th>
                        
                      </tr>
                    </thead>
                    
                    <tbody>
                      
                      <?php 

                      $item = null;
                      $valor = null;

                      $reportes = ControladorCategorias::ctrMostrarCambio($item, $valor);

                      foreach ($reportes as $key => $value) {
                  

                    echo '<tr>

                            <td>'.$value["id"].'</td>
                            <td>$ '.number_format($value["cambio"],2).'</td>
              
                          </tr>';
                        }

                      ?>
                      
                    </tbody>
                  </table>
                
              </div>

            <div class="col-md-2 col-xs-12">

                <div class="box-header with-border">  
                  <h3 class="box-title"> Retiros </h3>
                </div>
              
                  <table class="table table-bordered table-striped dt-responsive">
                    <thead>
                      <tr>
                        <th style="width: 10px;">#</th>
                        <th>Cantidad</th>
                        <th>Razón</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      
                      <?php 

                      $item = null;
                      $valor = null;

                      $reportes = ControladorCategorias::ctrMostrarRetiros($item, $valor);

                      foreach ($reportes as $key => $value) {
                  

                    echo '<tr>

                            <td>'.$value["Id"].'</td>
                            <td>$ '.number_format($value["retiro"],2).'</td>
                            <td>'.$value["descripcion"].'</td>
              
                          </tr>';
                        }

                      ?>
                      
                    </tbody>
                  </table>
                
              </div>

              <!-- <div class="col-md-1">
                
              </div> -->
              <div class="col-md-2 col-xs-12">

                <div class="box-header with-border">  
                  <h3 class="box-title"> Ventas Realizadas </h3>
                </div>
              
                  <table class="table table-bordered table-striped dt-responsive">
                    <thead>
                      <tr>
                        <th style="width: 10px;">#</th>
                        <th>N° De Nota</th>
                        <th>Cantidad</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      
                      <?php 

                      $item = null;
                      $valor = null;

                      $reportes = ControladorCategorias::ctrMostrarVentasHoy($item, $valor);

                      foreach ($reportes as $key => $value) {
                  

                    echo '<tr>

                            <td>'.$value["id"].'</td>
                            <td>'.$value["codigo"].'</td>
                            <td>$ '.number_format($value["total"],2).'</td>
                            
              
                          </tr>';
                        }

                      ?>
                      
                    </tbody>
                  </table>
                
              </div>

              <!-- <div class="col-md-1">
                
              </div> -->

              <div class="col-md-2 col-xs-12">

                <div class="box-header with-border">  
                  <h3 class="box-title"> Ventas Canceladas </h3>
                </div>
              
                  <table class="table table-bordered table-striped dt-responsive">
                    <thead>
                      <tr>
                        <th style="width: 10px;">#</th>
                        <th>N° de Nota</th>
                        <th>Cantidad</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      
                      <?php 

                      $item = null;
                      $valor = null;

                      $reportes = ControladorCategorias::ctrMostrarVentasCanceladas($item, $valor);

                      foreach ($reportes as $key => $value) {
                  

                    echo '<tr>

                            <td>'.$value["id"].'</td>
                            <td>'.$value["codigo"].'</td>
                            <td>$ '.number_format($value["total"],2).'</td>
                            
                          </tr>';
                        }

                      ?>
                      
                    </tbody>
                  </table>
                
              </div>
              <!-- <div class="col-md-1">
                
              </div> -->

              <div class="col-md-3 col-xs-12">

                <div class="box-header with-border">  
                  <h3 class="box-title"> Ventas Editadas </h3>
                </div>
              
                  <table class="table table-bordered table-striped dt-responsive">
                    <thead>
                      <tr>
                        <th style="width: 10px;">#</th>
                        <th>N° de Nota</th>
                        <th>Pago Anterior</th>
                        <th>Pago Actual</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      
                      <?php 

                      $item = null;
                      $valor = null;

                      $reportes = ControladorCategorias::ctrMostrarVentasEditadas($item, $valor);

                      foreach ($reportes as $key => $value) {
                  
                    echo '<tr>

                            <td>'.$value["id"].'</td>
                            <td>'.$value["codigo"].'</td>
                            <td>$ '.number_format($value["total_viejo"],2).'</td>
                            <td>$ '.number_format($value["total_nuevo"],2).'</td>
              
                          </tr>';
                        }

                      ?>
                      
                    </tbody>
                  </table>
              </div>
            

          </div>
            
            
          
        </div> <br>

        

      </div>

    </section>
  </div>

<!--=================================
=     ###Modal Agregar Saldo###  =
==================================-->
 
<div id="modalAgregarSaldo" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post">

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Saldo</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">
              
              <!-- Entrada para el saldo -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-usd"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevaCantidad" step="any" placeholder="Ingresa La Cantidad" required>
                </div>
              </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Guardar Saldo</button>
        </div>

        <?php 

          $crearReporte = new ControladorClientes();
          $crearReporte -> ctrCrearReporte();

         ?>

      </form>
    </div>
    
  </div>
</div>


<!--=================================
 =          ###Modal Agregar Retiro ###            =
 ==================================-->
 
 
<div id="modalAgregarRetiro" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Retirar Saldo</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">
              
              <!-- Entrada para el saldo -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-usd"></i> </span>
                  <input type="text" class="form-control input-lg" name="cantidad" step="any" placeholder="Ingresa La Cantidad" required>
                </div>
              </div>

              <!-- Entrada para la descripcion -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-file-text-o"></i> </span>
                  <input type="text" class="form-control input-lg" name="descripcion" placeholder="Ingresa la descripción" required="">
                </div>
              </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Retirar Saldo</button>
        </div>

        <?php 

          $crearRetiro = new ControladorCategorias();
          $crearRetiro -> ctrCrearRetiro();

         ?>

      </form>
    </div>
    
  </div>
</div>

<!--=================================
 =          ###Modal Agregar Cambio ###            =
 ==================================-->
 
 
<div id="modalAgregarCambio" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Cambio</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">
              
              <!-- Entrada para el saldo -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-usd"></i> </span>
                  <input type="text" class="form-control input-lg" name="cantidadSaldo" step="any" placeholder="Ingresa La Cantidad" required>
                </div>
              </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Agregar Cambio</button>
        </div>

        <?php 

          $crearCambio = new ControladorCategorias();
          $crearCambio -> ctrCrearCambio();

         ?>

      </form>
    </div>
    
  </div>
</div>