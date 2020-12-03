<?php
$Titulo = "listarRoles.php";
include_once("../estructura/cabecera.php");


?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3 ">
  <!--contenedor de titulo-->
  <div class="nav bg-light shadow mb-4 rounded">
    <h4 class="text-primary p-1"><i class="far fa-edit"></i> Trabajo Entregable/Entrega 5- Lista de Roles</h4>
  </div>
  <!--contenedor de la información-->
  <div class="nav shadow mb-5 rounded  m-3 p-3 justify-content-center"">
     
   <!--Datos-->
   <div class="row col-12 justify-content-center">
   <div class="my-custom-scrollbar my-custom-scrollbar-primary ">
   <div class="row col-12 justify-content-center" id="contenidoCargado" name="contenidoCargado" >
    
        <!--fila 1 tabla-->
        <div class="force-overflow justify-content-center ">
          <div class="table-responsive-md">
            <table class="table table-hover table-striped table-light table-sm m-3 jsut">
              <thead class="table-dark ">
                <tr clas= "p-3 m-3" align="center" valign="bottom">
                  <th clas= "p-3 m-3" scope="col">idrol</th>
                  <th clas= "p-3 m-3"scope="col">Descripción</th>
                 </tr>
              </thead>
              <tbody>
                <?php
              //primero verifico que los archivos que tienen fecha vencida de compartir pasen a no compartidos
              $objAbmRol = new AbmRol();
            //armo la lista de roles
            $listaRoles=[];
                $listaRoles = $objAbmRol->buscar(null);
                //print_r( $listaRoles);
               if(count( $listaRoles)>0){
                  foreach ( $listaRoles as $rol) {
               
                        echo '<tr align="center" valign ="bottom" > <td>'
                        .$rol->getIdrol() . '</td>';
                        echo '<td>' .$rol->getRodescripcion() . '</td></tr>';
                       
                        
                        }
                    }
                    else {
                      echo '<tr align="center" valign ="bottom" > <td> No hay  datos para mostrar</td></tr>';
                    }
                ?>
            </table>
          </div>
        </div>
        
        <button class="btn btn-warning btn-lg btn-block" name="ingresar" id="ingresar" data-toggle="modal" data-target="#nuevorol">Agregar rol</a> </button>
   
    </div>
    </div>
    </div>
    </div>
  </div>
     <!-- Modal /se abre con un botón/ -->
  <div class="modal fade" id="nuevorol" tabindex="-1" role="dialog" aria-labelledby="ModalInicioSesion" aria-hidden="true">
    <!-- para que el modal se centre verticalmetne en la pantalla "modal-dialog modal-dialog-centered-->
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="container shadow p-3 mb-5 bg-secondary rounded ">
      <div class="modal-content ">
       <div class="modal-header">
        <div class="container ">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title text-center"  id="exampleModalLabel">Descripción nuevo rol</h4>
         </div>
        </div>
    <div class="modal-body">
        <!--Formulario-->
    <form class= "needs-validation" id="login" name="login" method="POST" action= "../accion/actionRolnuevo.php" novalidate>
       
        <div class="form-group">
           <!--para colocar el icono dentro del recuadro de texto-->
            <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text icon-user"></span>
              </div>
                <input type="text" class="form-control" id="rodescripcion" name="rodescripcion" placeholder="nombre del rol" required>
                <input type="hidden" class="form-control font-weight-light " id="idrol" name="idrol" value="">
                <div class="valid-feedback">Luce bien!</div> 
                <div class="invalid-feedback">Completá el campo. Sólo letras</div> 
            </div>  
        </div>  
         <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
        </form>
    </div>
    </div> 
      </div>
      </div>
        </div>
      
      </div>




<?php

include_once("../estructura/pie.php");
?>