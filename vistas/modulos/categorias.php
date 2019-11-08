<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Categorias
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Categorias</li>
      </ol>
    </section>


    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3> -->
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
            
            Agregar Categoria
          </button>
          
        </div>
        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Categoria</th>
                  <th>Acciones</th>

                </tr>
              </thead>
              
              <tbody>

                <?php 

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


                  foreach ($categorias as $key => $value) {
                    
                    echo'
                    <tr>

                      <td>'.$value["id"].'</td>
                      <td>'.$value["categoria"].'</td>
                      
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>';
                          if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                          
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
 =     ###Modal Agregar Categoria###  =
 ==================================-->
 

<div id="modalAgregarCategoria" class="modal fade" role="dialog" >
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
                  <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                  <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar Categoría" required="">
                </div>
              </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary"> Guardar Categoría</button>
        </div>

        <?php 

          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();


         ?>


      </form>
    </div>
    
  </div>
</div>

<!--=================================
 =          ###Modal Editar Categoria###            =
 ==================================-->
 

<div id="modalEditarCategoria" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <div class="modal-content">
      
      <form role="form" method="post" enctype="multipart/form-data"> 

        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Categoría</h4>

        </div>
        <div class="modal-body">

          <div class="box-body">
              
              <!-- Entrada para el nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-th"></i> </span>
                  <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" required="">
                  <input type="hidden" id="idCategoria" name="idCategoria" required="">
                </div>
              </div>


          </div>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary"> Guardar Cambios</button>
        </div>
        
        <?php 

          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

         ?>

      </form>
    </div>
  </div>
</div>

<?php

  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>