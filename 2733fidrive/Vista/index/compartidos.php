<?php
$Titulo = "compartidos.php";
include_once("../estructura/cabecera.php");
include_once("../../Control/AbmArchivoCargado.php");
include_once("../../Control/AbmArchivoCargadoEstado.php");

?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
  <!--contenedor de titulo-->
  <div class="nav bg-light shadow mb-4 rounded">
    <h2 class="  text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 4</h2>
  </div>
  <!--contenedor de la información-->
  <div class="nav shadow mb-5 rounded  m-5  p-3">
        <div class="row col-12 ">
        <h4 class="text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg> Archivos que están actualmente compartidos:</h4>
      </div>
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
                $ide=[2, ""];
                $listaArchivos = $objAbmArchivoCargadoEstado->filtrar($ide);
               if(count($listaArchivos)>0){
                  foreach ($listaArchivos as $objArchivo) {
                    
                        echo '<tr align="center" valign ="bottom" > <td>' . $objArchivo->getACId() . '</td>';
                        echo '<td>' . $objArchivo->getACNombre() . '</td>';
                        echo '<td>' . $objArchivo->getACIcono() . '</td>';
                        echo '<td>' . $objArchivo->getIdUsuario() . '</td>';
                        echo '<td>' . $objArchivo->getACDescrip() . '</td>';
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