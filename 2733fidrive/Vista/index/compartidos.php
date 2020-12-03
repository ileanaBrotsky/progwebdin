<?php
$Titulo = "compartidos.php";
include_once("../estructura/cabecera.php");


?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
  <!--contenedor de titulo-->
  <div class="nav bg-light shadow mb-4 rounded">
    <h4 class="text-primary p-1"><i class="far fa-edit"></i> Trabajo Entregable/Entrega 5- Archivos Compartidos</h4>
  </div>
  <!--contenedor de la información-->
  <div class="nav shadow mb-5 rounded  m-3  p-3 justify-content-center">
       
    <!--Datos-->
    <div class="my-custom-scrollbar my-custom-scrollbar-primary">
     <div class="row col-12 " id="contenidoCompartidos" name="contenidoCompartidos">
        <!--fila 1 tabla-->
        <div class="force-overflow">
          <div class="table-responsive-md">
            <table class="table table-hover table-striped table-light table-sm m-3 jsut">
              <thead class="table-dark ">
                <tr align="center" valign="bottom">
                  <th scope="col">ID</th>
                  <th scope="col">NOMBRE</th>
                  <th scope="col">TIPO</th>
                  <th scope="col">USUARIO</th>
                  <th scope="col">DESCRIPCIÓN</th>
                  <th scope="col">CODIGO COMPARTIR</th>
                  <th scope="col" colspan="2">ACCIONES</th>
                </tr>
              </thead>
              <tbody>
                <?php
                //primero verifico que los archivos que tienen fecha vencida de compartir pasen a no compartidos
                $objAbmArchivoCargado = new AbmArchivoCargado();
               // $objAbmArchivoCargado->chequearCaducidadCompartir();
                //armo la lista de los archivos que tienen estado compartido
                $objAbmArchivoCargadoEstado = new AbmArchivoCargadoEstado();
                //arme un array con un dato porque uso la misma funcion con dos ides para contenidos asi que la aproveché
                $idusuario= $_SESSION['idusuario'];
                $ide=[2, "",$idusuario];
                $listaArchivos = $objAbmArchivoCargadoEstado->filtrar($ide);
               if(count($listaArchivos)>0){
                  foreach ($listaArchivos as $objArchivo) {
                    
                        echo '<tr align="center" valign ="bottom" > <td>' . $objArchivo->getACId() . '</td>';
                        echo '<td>' . $objArchivo->getACNombre() . '</td>';
                        echo '<td>' . $objArchivo->getACIcono() . '</td>';
                        echo '<td>' . ucwords($objArchivo->getObjUsuario()->getUsnombre()." ". $objArchivo->getObjUsuario()->getUsapellido().  '</td>');
                        echo '<td>' . $objArchivo->getACDescrip() . '</td>';
                        echo '<td>' . $objArchivo->getACLink(). '</td>';
                        /* botón dejar de compartir archivo*/
                        echo '<td><button type="button" class="btn btn-primary m-3"><a href="dejardecompartir.php?idarchivocargado=' . $objArchivo->getACId() . '">No Compartir</button></td>';
                        echo '<td><button type="button" class="btn btn-secondary m-3"><a href="eliminararchivo.php?idarchivocargado=' . $objArchivo->getACId() . '">Eliminar</button></td></tr>';
                     }
                    }
                    else {
                      echo '<tr align="center" valign ="bottom" > <td> No hay  datos para mostrar</td></tr>';
                    }
                ?>
                </tbody>
            </table>
          </div>
        </div>
    
     </div>
  </div>
    
    
  </div>
  </div>

  


<?php

include_once("../estructura/pie.php");
?>