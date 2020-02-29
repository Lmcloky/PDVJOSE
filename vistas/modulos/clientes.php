<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Clientes
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Clientes</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3> -->
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
            
            Agregar Clientes
          </button>
          
        </div>
        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Nombre De cliente</th>
                  <th>CURP</th>
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Dirección</th>
                  <th>Fecha de Nacimiento</th>
                  <th>Total De Compras</th>
                  <th>Ultima Compra</th>
                  <th>Ingreso Al Sistema</th>
                  <th>Acciones</th>

                </tr>
              </thead>
              
              <tbody>

                <?php 

                $item = null;
                $valor = null;

                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                foreach ($clientes as $key => $value) {
            

            echo '<tr>

                    <td>'.$value["id"].'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["documento"].'</td>
                    <td>'.$value["email"].'</td>
                    <td>'.$value["telefono"].'</td>
                    <td>'.$value["direccion"].'</td>
                    <td>'.$value["fecha_nacimiento"].'</td>             
                    <td>'.$value["compras"].'</td>
                    <td>'.$value["ultima_compra"].'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>
                      <div class="btn-group">                         

                      <button class="btn btn-info btnImprimirEstado" codigoCliente="'.$value["id"].'">
                                <i class="fa fa-print"></i>
                                </button>

                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){
                        echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                      }

                      echo '</div>  
                    </td>

                  </tr>';
          
            }

                 ?>
                
              </tbody>
            </table>
          
        </div>

      </div>

    </section>
  </div>


 <!--=================================
 =     ###Modal Agregar CLIENTE###  =
 ==================================-->
 

<div id="modalAgregarCliente" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Cliente</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">
              
              <!-- Entrada para el nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar Nombre" required="">
                </div>
              </div>

              <!-- Entrada para el Documento id -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-clipboard"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar CURP" required="">
                </div>
              </div>

              <!-- Entrada para el EMAIL -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-envelope"></i> </span>
                  <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresa Email" required="">
                </div>
              </div>
              
              <!-- Entrada para el TELEFONO -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-phone"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresa Telefono" data-inputmask="'mask' : '(999) 999-9999'" data-mask required="">
                </div>
              </div>

              <!-- Entrada para la direccion-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-map-marker"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresa la Direccion" required="">
                </div>
              </div>

              <!-- Entrada para la dfecha de nacimiento-->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresa fecha de nacimiento" data-inputmask="'alias' : 'yyyy/mm/dd'" data-mask  required="">
                </div>
              </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary"> Guardar Cliente</button>
        </div>

        <?php 

          $crearCliente = new ControladorClientes();
          $crearCliente -> ctrCrearCliente();

         ?>

      </form>
    </div>
    
  </div>
</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog"> 
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar cliente</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                <input type="hidden" id="idCliente" name="idCliente">
              </div>
            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">             
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion"  required>
              </div>
            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento"  data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

      </form>

      <?php

        $editarCliente = new ControladorClientes();
        $editarCliente -> ctrEditarCliente();

      ?>

    

    </div>

  </div>

</div>

<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>

