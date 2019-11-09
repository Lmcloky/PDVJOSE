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
            
            Agregar Saldo

          </button>
          
        </div>
        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Saldo Inicial</th>
                  <th>Total de Ventas</th>
                  <th>Total de retiros</th>
                  <th>Gastos De Hoy</th>
                  <!-- <th>Descripción</th> -->
                  <th>Saldo Disponible</th>
                  <th>Acciones</th>

                </tr>
              </thead>
              
              <tbody>

                    <tr>

                      <td>ID</td>
                      <td>$ 850</td>
                      <td>5</td>
                      <td>2</td>
                      <td>$ 320</td>
                      <!-- <th>Descripcion</th> -->
                      <td>$ 530</td>
                      
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-info btnRetirarSaldo" data-toggle="modal" data-target="#modalRetirarSaldo"><i class="fa fa-hand-lizard-o"></i></button>
                          
                        </div>
                      </td>

                    </tr>

                
              </tbody>
            </table>
          
        </div>

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
                  <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevaCantidad" placeholder="Ingresa La Cantidad" required>
                </div>
              </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Guardar Saldo</button>
        </div>

      </form>
    </div>
    
  </div>
</div>

<!--=================================
 =          ###Modal Retirar Saldo ###            =
 ==================================-->
 

<div id="modalRetirarSaldo" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Retirar Saldo</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">
              
              <!-- Entrada para el retiro -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-usd"></i> </span>
                  <input type="text" class="form-control input-lg" id="editarReporte" name="editarReporte" required="">
                  <input type="hidden" id="idReporte" name="idreporte" required="">
                </div>
              </div>


          </div>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary"> Retirar</button>
        </div>
        

      </form>
    </div>
  </div>
</div>