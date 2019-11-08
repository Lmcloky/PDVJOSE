  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Crear Venta
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Crear Venta</li>
      </ol>
    </section>

    <section class="content">
      
      <div class="row">

        <!--==========================================
        =            LLENAR EL FORMULARIO            =
        ===========================================-->
        <div class="col-lg-5 col-xs-12">
          
          <div class="box box-success">
            
            <div class="box-header with-border"> </div>

            <form role="form" method="post" class="formularioVenta">
  
              <div class="box-body">
    
                <div class="box">

                  <!--==========================================
                  =            ENTRADA DEL VENDEDOR            =
                  ===========================================-->
                  
                  
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-user"></i> </span>
                      <input type="text" class="form-control" id="nuevoVendedor" value=" <?php echo $_SESSION["nombre"] ?> " readonly>
                      <input type="hidden" name="idVendedor" value=" <?php echo $_SESSION["id"] ?> ">
                    </div>
                  </div>

                   <!--==========================================
                  =            ENTRADA DEl CODIGO DE VENTA            =
                  ===========================================-->
                  
                  
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-key"></i> </span>
  
                        <?php 

                          $item = null;
                          $valor = null;
                          $orden = "id";

                          $ventas = ControladorVentas::ctrMostrarVentas($item, $valor, $orden);

                          if (!$ventas) {
                            
                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="100001" readonly>';

                          }else{

                            foreach ($ventas as $key => $value) {
                              
                            }

                            $codigo = $value["codigo"] + 1;

                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';

                          }


                         ?>
 
                    </div>
                  </div>

                  <!--==========================================
                  =            ENTRADA DEL CLIENTE            =
                  ===========================================-->
                  
                  
                  <div class="form-group">
                    
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-users"></i> </span>
                      <select class="form-control" name="seleccionarCliente" id="seleccionarCliente" required>
                        <option value="">Seleccionar Cliente</option>

                        <?php

                          $item = null;
                          $valor = null;

                          $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                           foreach ($categorias as $key => $value) {

                             echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                           }

                        ?>

                      </select>

                      <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>
 
                    </div>
                  </div>

                  <!--==========================================
                  =            ENTRADA DEL PRODUCTO            =
                  ===========================================-->
                  
                  <div class="form-group row nuevoProducto"> 

                  </div>

                    
                    <input type="hidden" id="listaProductos" name="listaProductos">
                      
                      <!-- AGREGAR PRODUCTOS -->
                      <button type="button" class="btn btn-default hidden-lg btnAgregarProducto"> Agregar Productos</button>

                      <hr>

                      <div class="row">
                        <div class="col-xs-8 pull-right">
                          
                          <table class="table">
                            
                            <thead>
                              
                              <tr>
                                <th>Impuesto</th>
                                <th>Total</th>
                              </tr>

                            </thead>

                            <tbody>
                              
                              <tr>
                                <td style="width: 50%">
                                  <div class="input-group">
                                    
                                    <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" placeholder="0" required>
                                    <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                                    <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                  </div>
                                </td>
                                <td style="width: 50%">
                                  
                                  <div class="input-group">
                                    
                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                    <input type="text" class="form-control input-lg" min="0" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                                    <input type="hidden" name="totalVenta" id="totalVenta">

                                  </div>

                                </td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                      <hr>

                      <!--==========================================
                      =            FORMA DE PAGO            =
                      ===========================================-->

                      <div class="form-group row">

                        <div class="col-xs-4" style="padding-right: 0px;">
                          <div class="input-group">
                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                              <option value="">Seleccione método de pago</option>
                              <option value="Efectivo">Efectivo</option>
                              <option value="TC">Tarjeta de Crédito</option>
                              <option value="TD">Tarjeta De Débito</option>
                            </select>
                          </div>
                        </div>

                        <div class="cajasMetodoPago">
                          
                        </div>

                        <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                      </div>
                  <br>
                </div>

              </div>
              
              <div class="box-footer">
                
                <button type="submit" class="btn btn-primary pull-right">Guardar Venta</button>

              </div>

            </form>

            <?php 

              $guardarVenta = new ControladorVentas();
              $guardarVenta -> ctrCrearVenta();

             ?>

          </div>

        </div>

        <!--======================================================================================================================
        =                                              TABLA DE PRODUCTOS                                                      =
        =======================================================================================================================-->
        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
          
          <div class="box box-warning">
            
            <div class="box-header with-border"> </div>
            <div class="box-body">
              
              <table class="table table-bordered table-striped dt-responsive tablaVentas">
                <thead>
                  <tr>
                    <td style="width: 10px;">#</td>
                    <td>Imagen</td>
                    <td>Código</td>
                    <td>Descripción</td>
                    <td>Stock</td>
                    <td>Acciones</td>
                  </tr>
                </thead>
                
               <!--  <tbody>
                
                <tr>
                  <td>1</td>
                  <td> <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"> </td>
                  <td>0000001</td>
                  <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </td>
                  <td>20</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary"> Agregar </button>
                    </div>
                  </td>
                </tr>

              </tbody> -->
              </table>

            </div>
          </div>
        </div>


      </div>
    </section>
  </div>

  <!--============================================================================================================================================
 =                                                          ###Modal Agregar CLIENTE###                                                        =
 =============================================================================================================================================-->
 

<div id="modalAgregarCliente" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Categoria</h4>

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
                  <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar Documento" required="">
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