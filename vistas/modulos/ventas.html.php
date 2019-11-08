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
                  <th >Neto</th>
                  <th >Total</th>
                  <th >Fecha</th>
                  <th >Acciones</th>

                </tr>
              </thead>
              
              <tbody>

                <tr>
                  <td>1</td>
                  <td>21548754</td>
                  <td>juan villegas</td>
                  <td>julio gómez</td>
                  <td>tc-090923452376</td>
                  <td>$ 1,000.00</td>
                  <td>$ 1,190.00</td>
                  <td>2017-05-05 12:05:05</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-info"><i class="fa fa-print"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </div>
                  </td>
                </tr>
                
              </tbody>
            </table>
          
        </div>

      </div>

    </section>
  </div>

