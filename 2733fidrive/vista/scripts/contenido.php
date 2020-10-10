<?php
$Titulo = "contenido.php";
include_once("../estructura/cabecera.php");
?>

<?php
$obj = new control_contenido();
$arregloArchivos = $obj->obtenerFiles();
$arregloCarpetas = $obj->obtenerCarpetas();
//print_r($arregloArchivos);
?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h2 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- Contenido.php</h2>
    </div>
    <!--contenedor de la información-->
    <div class="nav shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 " id="contenidoformulario" name="contenidoformulario" method="POST" action="" novalidate>
            <!--fila 1 % en 2 col-->
            <div class="row col-12  mb-3">
                <!-- columna 1 archivos -->
                <div class="row col-6 justify-content-center mb-3">
                    <label class="control-label font-weight-bold" for="SelectorArchivos"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg> Archivos cargados:</label>
                    <?php
                    if (count($arregloArchivos) > 0) {
                        echo "<div class='row col-12'>";
                        $i = 0;
                        echo "<select class='custom-select' size='10' multiple onclick='mostrarBotones()' name='SelectorArchivos' id='SelectorArchivos'>";
                        while ($i < count($arregloArchivos)) {
                            $archivo = $arregloArchivos[$i];
                            echo " <option value='$archivo'>$archivo</option>";
                            $i++;
                        }
                        echo " </select>";
                        echo "</div>";
                    } else {
                        echo "No hay archivos cargados";
                    }

                    ?>
                </div>
                <!--columna 2 carpetas-->
                <div class="row col-6 justify-content-center mb-3">
                    <label class="control-label font-weight-bold" for="SelectorCarpetas"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                    <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
                    </svg> Carpetas cargadas:</label>
                    <?php
                    if (count($arregloCarpetas) > 0) {
                        echo "<div class='row col-12'>";
                        $i = 2;
                        echo "<select class='custom-select' size='10' multiple name='SelectorCarpetas' id='SelectorCarpetas'>";
                        while ($i < count($arregloCarpetas)) {

                            $archivo = $arregloCarpetas[$i];
                            echo " <option value='$archivo'>$archivo</option>";

                            $i++;
                        }
                        echo " </select>";
                        echo "</div>";
                    } else {
                        echo "No hay carpetas cargadas";
                    }

                    ?>

                </div>
            </div>
            <!--fila 2 botones visibles-->
            <div class="row col-12 justify-content-center mb-3">
                <div class="row col-12 justify-content-center m-3">
                    <h3>Elija una acción o seleccione un archivo para más opciones</h3>
                </div>
            <!-- botón cargar archivo nuevo-->
                <div class="row m-3">
                        <button class="btn btn-primary mr-2 btn-block"><a class="text-decoration-none" href="amarchivo.php">CARGAR NUEVO ARCHIVO </a></button>
                </div>
            <!-- botón abre modal cargar carpeta nueva-->
                    <div class="row m-3">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#crearCarpetaModal">CARGAR NUEVA CARPETA</button>
                    </div>
            </div>
  

                <!--fila 3 botones ocultos QUE aparecen als eleccionar archivo existente-->
                <div class="row col-12 justify-content-center mb-3" id="filaBotones" name="filaBotones" >
                     <!-- botón abre modal modificar archivo-->
                     
                     <button type="button" class="btn btn-secondary m-3 btn-block" onclick="cargarModalM()" data-toggle="modal" data-target="#modalModificar" >MODIFICAR ARCHIVO</button>
                     
                    
                     <!-- botón eliminar archivo-->
                     <button type="button" class="btn btn-secondary m-3 btn-block" onclick="cargarModalE()" data-toggle="modal" data-target="#modalEliminar" >ELIMINAR ARCHIVO</button>
                    
                     <!-- botón compartir archivo-->
                     <button type="button" class="btn btn-secondary m-3 btn-block" onclick="cargarModalC()" data-toggle="modal" data-target="#modalCompartir" >COMPARTIR ARCHIVO</button>
                    
                </div>
      </form>
<!-- ------------------------------------------------------------------------------------------------- -->
      <!-- Modal CREAR CARPETA/se abre con un botón/ -->
<div class="modal fade" id="crearCarpetaModal" tabindex="-1" role="dialog" aria-labelledby="ModalInicioSesion" aria-hidden="true">
  <!-- para que el modal se centre verticalmetne en la pantalla "modal-dialog modal-dialog-centered-->
<div class="modal-dialog modal-dialog-centered " role="document">
  <div class="container shadow p-3 mb-5 bg-secondary rounded ">
    <div class="modal-content ">
     <div class="modal-header">
      <div class="container ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center"  id="exampleModalLabel">Crear carpeta</h4>
       </div>
      </div>
  <div class="modal-body">
      <!--Formulario-->
  <form class= "needs-validation" id="crearCarpeta" name="crearCarpeta" method="POST" action= "actioncrearcarpeta.php" novalidate>
        <!--data-toggle="validator" novalidate-->
      <div class="form-group">
         <!--para colocar el icono dentro del recuadro de texto-->
          <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5v-9zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7z"/>
            </svg></span>
            </div>
              <input type="text" class="form-control" id="nombreCarpetaNueva" name="nombreCarpetaNueva" pattern= "/^[a-z0-9][a-z0-9_-.]+$/i" placeholder="Nombre de la nueva carpeta" required>
              <!-- mensajes de validacion -->
              <div class="valid-feedback">Luce bien!</div> 
              <div class="invalid-feedback">Completá el campo. El primer carácter sólo puede ser una letra o número, el resto pueden tener
                guiones bajos, medios y puntos</div> 
          </div>  
      </div>  
          <button type="submit" class="btn btn-success btn-lg btn-block">Crear</button>
  </form>
  </div>
  </div>
  </div>
  </div>
  </div>
<!-- ------------------------------------------------------------------------------------------------- -->
   <!-- Modal MODIFICAR ARCHIVO/se abre con un botón/ -->
<div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <!-- para que el modal se centre verticalmetne en la pantalla "modal-dialog modal-dialog-centered-->
<div class="modal-dialog modal-dialog-centered " role="document">
  <div class="container shadow p-3 mb-5 bg-secondary rounded ">
    <div class="modal-content ">
     <div class="modal-header">
      <div class="container ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center"  >El archivo que modificará es:</h4>
       </div>
      </div>
  <div class="modal-body">
      <!--Formulario-->
  <form class= "" id="formModalModificar" name="formModalModificar" method="POST" action= "amarchivo.php" >
         <div class="form-group">
         <!--para colocar el icono dentro del recuadro de texto-->
          <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
            <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
            </svg></span>
            </div>
              <input type="text" readonly class="form-control " id="nombreArchivoModalM" name="nombreArchivoModalM" >
              </div>  
      </div>
              <!-- columna 2 -clave archivo-->
            <div class="form-group col-md-6">
                    <!--  <label class="control-label font-weight-bold" for="clave">Clave del archivo:</label> -->
                    <input type="hidden" class="form-control font-weight-light " id="clave" name="clave" value="1">
                    <!--   <div class="small form-text text-muted" for="decargasposibles"> 0 = Alta / 1= Modificación</div>-->
                </div>
   
          <button type="submit" class="btn btn-success btn-lg btn-block">Confirmar</button>
  </form>
    </div>
    </div>
    </div>
    </div>
    </div>
 <!-- ------------------------------------------------------------------------------------------------- -->
   <!-- Modal ELIMINAR ARCHIVO/se abre con un botón/ -->
   <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <!-- para que el modal se centre verticalmetne en la pantalla "modal-dialog modal-dialog-centered-->
<div class="modal-dialog modal-dialog-centered " role="document">
  <div class="container shadow p-3 mb-5 bg-secondary rounded ">
    <div class="modal-content ">
     <div class="modal-header">
      <div class="container ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center"  >El archivo que eliminará es:</h4>
       </div>
      </div>
  <div class="modal-body">
      <!--Formulario-->
  <form class= "" id="formModalEliminar" name="formModalEliminar" method="POST" action= "eliminararchivo.php" >
         <div class="form-group">
         <!--para colocar el icono dentro del recuadro de texto-->
          <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
            <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
            </svg></span>
            </div>
              <input type="text" readonly class="form-control" id="nombreArchivoModalE" name="nombreArchivoModalE" >
          
          </div>  
      </div>  
          <button type="submit" class="btn btn-success btn-lg btn-block">Confirmar</button>
  </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- ------------------------------------------------------------------------------------------------- -->
  
   <!-- Modal COMPARTIR ARCHIVO/se abre con un botón/ -->
   <div class="modal fade" id="modalCompartir" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <!-- para que el modal se centre verticalmetne en la pantalla "modal-dialog modal-dialog-centered-->
<div class="modal-dialog modal-dialog-centered " role="document">
  <div class="container shadow p-3 mb-5 bg-secondary rounded ">
    <div class="modal-content ">
     <div class="modal-header">
      <div class="container ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center"  >El archivo que compartirá es:</h4>
       </div>
      </div>
  <div class="modal-body">
      <!--Formulario-->
  <form class= "" id="formModalCompartir" name="formModalCompartir" method="POST" action= "compartirarchivo.php" >
         <div class="form-group">
         <!--para colocar el icono dentro del recuadro de texto-->
          <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
            <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
            </svg></span>
            </div>
              <input type="text" readonly class="form-control" id="nombreArchivoModalC" name="nombreArchivoModalC" >
          
          </div>  
      </div>  
          <button type="submit" class="btn btn-success btn-lg btn-block">Confirmar</button>
  </form>
    </div>
    </div>
    </div>
    </div>
    </div>
 <!-- ----------------------------------------------------------------------------------------------------------------- -->   
</div>
</div>
<?php

include_once("../estructura/pie.php");
?>