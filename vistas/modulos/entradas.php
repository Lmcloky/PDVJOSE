<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar La Entrada De Productos
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar La Entrada De Productos</li>
      </ol>
    </section>


    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3> -->
          
          <a href="crear-entrada">
            <button class="btn btn-primary">            
              Agregar Producto         
            </button>
          </a>

          <!-- <button type="button" class="btn btn-default pull-right" id="daterange-btn4">
            
              <span>
                <i class="fa fa-calendar"></i> Rango de Fecha
              </span>

              <i class="fa fa-caret-down"></i>

          </button> -->
          
        </div>
        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th >Código</th>
                  <th >Usuario</th>
                  <th >Neto</th>
                  <th >Total</th>
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

                    $respuesta = ControladorEntradas::ctrRangoFechasEntradas($fechaInicial, $fechaFinal);

                    foreach ($respuesta as $key => $value) {
           
                     echo '<tr>

                            <td>'.$value["id"].'</td>

                            <td>'.$value["codigo"].'</td>';

                            $itemUsuario = "id";
                            $valorUsuario = $value["id_vendedor"];

                            $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                            echo '<td>'.$respuestaUsuario["nombre"].'</td>

                            <td>$ '.number_format($value["neto"],2).'</td>

                            <td>$ '.number_format($value["total"],2).'</td>

                            <td>'.$value["fecha"].'</td>

                            <td>

                              <div class="btn-group">
                                  
                                <button class="btn btn-info btnImprimirEntrada" codigoEntrada="'.$value["codigo"].'">
                                <i class="fa fa-print"></i>
                                </button>';

                                if($_SESSION["perfil"] == "Administrador"){

                                echo '
                                <button class="btn btn-danger btnEliminarEntrada" idEntrada="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                              }

                              echo '</div>  

                            </td>

                          </tr>';
                      }


                 ?>
                
              </tbody>
            </table>

            <?php

            $eliminarEntrada = new ControladorEntradas();
            $eliminarEntrada -> ctrEliminarEntrada();

            ?>
          
        </div>

      </div>

    </section>
  </div>

