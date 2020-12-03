<?php
$Titulo = "listarUsuario.php";
include_once("../estructura/cabecera.php");



?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3 ">
  <!--contenedor de titulo-->
  <div class="nav bg-light shadow mb-4 rounded">
    <h4 class="text-primary p-1"><i class="far fa-edit"></i> Trabajo Entregable/Entrega 5- Lista de Usuarios</h4>
  </div>
  <!--contenedor de la información-->
  <div class="nav shadow mb-5 rounded  m-3 p-3 justify-content-center"">
     
   <!--Datos-->
   <div class="row col-12 justify-content-center">
   <div class="my-custom-scrollbar my-custom-scrollbar-primary ">
   <div class="row col-12 justify-content-center" id="contenidoCargado" name="contenidoCargado" >
    
        <!--fila 1 tabla-->
        <div class="force-overflow ">
          <div class="table-responsive-md">
            <table class="table table-hover table-striped table-light table-sm m-3 jsut">
              <thead class="table-dark ">
                <tr clas= "p-3 m-3" align="center" valign="bottom">
                  <th clas= "p-3 m-3" scope="col">idsuario</th>
                  <th clas= "p-3 m-3"scope="col">Nombre</th>
                  <th clas= "p-3 m-3"scope="col">Apellido</th>
                  <th clas= "p-3 m-3"scope="col">Usuario</th>
                  <th clas= "p-3 m-3"scope="col">Password</th>
                  <th clas= "p-3 m-3"scope="col">Roles</th>
                  <th clas= "p-3 m-3"scope="col"colspan=2>Acciones</th>
                
                 </tr>
              </thead>
              <tbody>
                <?php
              //primero verifico que los archivos que tienen fecha vencida de compartir pasen a no compartidos
              $objAbmUsuario = new AbmUsuario();
            //armo la lista de personas
                $listaUsuarios = $objAbmUsuario->listarUsuarios();
                //print_r($listaPersonas);
               if(count($listaUsuarios)>0){
                  foreach ($listaUsuarios as $datosUsuario) {
                  //$datosUsuario [0]= objUsuario $datosUsuario [1]= array de roles
                  $roles="";
                  foreach($datosUsuario [1] as $rol){

                    $roles=$roles." ". $rol. ' - ' ;
                    } 
                  
                   
                        echo '<tr align="center" valign ="bottom" > <td>'
                        . $datosUsuario [0]->getIdusuario() . '</td>';
                        echo '<td>' . ucfirst($datosUsuario [0]->getUsnombre()) . '</td>';
                        echo '<td>' .ucfirst( $datosUsuario [0]->getUsapellido()) . '</td>';
                        echo '<td>' . $datosUsuario [0]->getUslogin(). '</td>';
                        echo '<td>' . $datosUsuario [0]->getUsclave() . '</td>';
                        echo '<td>'.$roles. '</td>';
                      
                     
                       /*botón abre modal modificar archivo*/
                        echo '<td><button type="button" class="btn btn-info m-3"><a href="actualizarlogin.php?idusuario=' . $datosUsuario [0]->getIdusuario() . '&roles='.$roles.'" >ACTUALIZAR</a></button></td>';
                         /*botón abre modal modificar archivo*/
                         echo '<td><button type="button" class="btn btn-warning m-3" name="eliminarusuario" id="eliminarusuario"><a href="eliminarUsuario.php?idusuario=' . $datosUsuario [0]->getIdusuario() . '" >ELIMINAR</a> </button></td>';
                        }
                    }
                    else {
                      echo '<tr align="center" valign ="bottom" > <td> No hay  datos para mostrar</td></tr>';
                    }
                ?>
            </table>
          </div>
        </div>
    </div>
   
    </div>
    </div>
    </div>
  </div>
   




<?php

include_once("../estructura/pie.php");
?>