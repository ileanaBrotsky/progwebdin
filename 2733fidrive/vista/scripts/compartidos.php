<?php
$Titulo = "compartidos.php";
include_once("../estructura/cabecera.php");
?>

<?php
$obj = new control_contenido();
$arregloArchivos = $obj->obtenerFiles();
//print_r($arregloArchivos);
?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h2 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- Archivos Compartidos</h2>
    </div>
    <!--contenedor de la información-->
    <div class="nav shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 " id="contenidoformulario" name="contenidoformulario" method="POST" action="" novalidate>
            <!--fila 1 archivos-->
             <div class="row  justify-content-center mb-3">
                    <label class="control-label font-weight-bold" for="SelectorArchivos">Archivos cargados:</label>
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
               
            
            <!--fila 2 -->
            <div class="row col-12 justify-content-center mb-3">
                <div class="row col-12 justify-content-center m-3">
                    <h3>Elija el archivo que desea sacar de compartidos</h3>
                </div>
            <!--fila 3 boton oculto QUE aparece al seleccionar archivo existente-->
                <div class="row col-12 justify-content-center mb-3" id="filaBotones" name="filaBotones" >
                <!-- botón abre modal dejar de compartir archivo-->
                     <button type="button" class="btn btn-secondary m-3 btn-block" onclick="cargarModalDC()" data-toggle="modal" data-target="#modalDejarCompartir" >DEJAR DE COMPARTIR</button>
                  
                </div>
      </form>

  
 <!-- ------------------------------------------------------------------------------------------------- -->
   <!-- Modal DEJAR DE COMPARTIR ARCHIVO/se abre con un botón/ -->
   <div class="modal fade" id="modalDejarCompartir" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <!-- para que el modal se centre verticalmetne en la pantalla "modal-dialog modal-dialog-centered-->
<div class="modal-dialog modal-dialog-centered " role="document">
  <div class="container shadow p-3 mb-5 bg-secondary rounded ">
    <div class="modal-content ">
     <div class="modal-header">
      <div class="container ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title text-center"  >El archivo que dejará de compartir es:</h4>
       </div>
      </div>
  <div class="modal-body">
      <!--Formulario-->
  <form class= "" id="formModalDejarCompartir" name="formModalDejarCompartir" method="POST" action= "eliminararchivocompartido.php" >
         <div class="form-group">
         <!--para colocar el icono dentro del recuadro de texto-->
          <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
            <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
            </svg></span>
            </div>
              <input type="text" readonly class="form-control" id="nombreArchivoModalDC" name="nombreArchivoModalDC" >
          
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