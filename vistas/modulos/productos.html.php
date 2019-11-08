<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Productos
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Productos</li>
      </ol>
    </section>


    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3> -->
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
            
            Agregar Producto
          </button>
          
        </div>
        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th style="width: 40px;">Imagen</th>
                  <th>Codigo</th>
                  <th>Descripción</th>
                  <th>Categoría</th>
                  <th style="width: 50px;">Stock</th>
                  <th style="width: 100px;">Precio Compra</th>
                  <th style="width: 100px;">Precio Venta</th>
                  <th>Agregado</th>
                  <th>Acciones</th>
  
                </tr>
              </thead>
              
              <tbody>
                
                <tr>
                  <td>1</td>
                  <td> <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"> </td>
                  <td>0000001</td>
                  <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </td>
                  <td>Lorem Ipsum</td>
                  <td>20</td>
                  <td>5.00</td>
                  <td>10.00</td>
                  <td>2017-12-11 12:05:32</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>1</td>
                  <td> <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"> </td>
                  <td>0000001</td>
                  <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </td>
                  <td>Lorem Ipsum</td>
                  <td>20</td>
                  <td>5.00</td>
                  <td>10.00</td>
                  <td>2017-12-11 12:05:32</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>1</td>
                  <td> <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"> </td>
                  <td>0000001</td>
                  <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </td>
                  <td>Lorem Ipsum</td>
                  <td>20</td>
                  <td>5.00</td>
                  <td>10.00</td>
                  <td>2017-12-11 12:05:32</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
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


 <!--=================================
 =          ###Modal Agregar Productos###            =
 ==================================-->
 

<div id="modalAgregarProducto" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post" enctype="multipart/form-data"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Producto</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">
              
              <!-- Entrada para el Codigo -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-code"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Código" required="">
                </div>
              </div>

              <!-- Entrada para la descripción -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-product-hunt"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required="">
                </div>
              </div>

              <!-- entrada para la categoria -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                  <select class="form-control input-lg" name="nuevaCategoria">
                    <option value="">Seleccionar categoría</option>
                    <option value="Taladros">Taladros</option>
                    <option value="Andamios">Andamios</option>
                    <option value="Equipos de construcción">Equipos de construcción</option>
                  </select>
                </div>
              </div>

              <!-- Entrada para el Stock -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-check"></i> </span>
                  <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Cantidad disponible" required="">
                </div>
              </div>

              <!-- Entrada para el precio de compra -->
              <div class="form-group row">
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-arrow-up"></i> </span>
                    <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0" placeholder="Precio de compra" required="">
                  </div>
                </div>
              <!-- Entrada para el precio de venta -->
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-arrow-down"></i> </span>
                    <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0" placeholder="Precio de venta" required="">
                  </div>
                  <br>
                  <!-- CHECKBOX PARA PORCENTAJE -->
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar Porcentaje
                      </label>
                    </div>
                  </div>
                  <!-- RNTRADA PARA PORCENTAJE -->
                  <div class="col-xs-6" style="padding: 0">
                    <div class="input-group">
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- entrada para subir imagen -->
              <div class="form-group">
                <div class="panel">SUBIR IMAGEN</div>
                <input type="file" class="nuevaImagen" name="nuevaImagen">
                <p class="help-block">Peso máximo de la Imagen 6MB</p>
                <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary"> Guardar Producto</button>
        </div>


      </form>
    </div>
    
  </div>
</div>

<!--=================================
 =          ###Modal Editar Usuario###            =
 ==================================-->
 

<div id="modalEditarUsuario" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post" enctype="multipart/form-data"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">
              
              <!-- Entrada para el nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                  <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required="">
                </div>
              </div>


          </div>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary"> Guardar Cambios</button>
        </div>


      </form>
    </div>
    
  </div>
</div>
