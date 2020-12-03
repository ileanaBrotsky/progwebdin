<?php
$Titulo = " dejardecompartirarchivo.php";
include_once("../estructura/cabecera.php");

?>
<?php 
$objAbmArchivoCargado = new AbmArchivoCargado();
$datos = data_submitted();

//print_r($datos);
if (isset($datos['idarchivocargado'])) {
    $listaArchivos = $objAbmArchivoCargado->buscar($datos);
    //   print_r($listaArchivos);
    if (count($listaArchivos) == 1) {
        $objArchivo = $listaArchivos[0];
      //   print_r($objArchivo);
        $nombre = $objArchivo->getACNombre();
        $clave = 4;
        $id = $datos['idarchivocargado'];
        $cantidadCompartida=$objArchivo->getACCantUsada();
     }
}

?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-3 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Entrega 5- Dejar de compartir archivo</h4>
    </div>
     <!--contenedor del Formulario-->
    <div class="container shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 align-center" id="dejarformulario" name="dejarformulario" method="POST" action="../accion/actionArchivoCargado.php" novalidate>

            <!--Fila 1 % en 3 col-->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-md-3 ">
                <input type="hidden" class="form-control font-weight-light " id="idarchivocargado" name="idarchivocargado" value="<?php echo $id ?>">
                    <label class="control-label font-weight-bold" for="acnombre">Nombre del archivo:</label>
                    <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded pl-2" id="acnombre" name="acnombre" value="<?php echo $nombre ?>">

                </div>
                <!-- columna 2 -cantidad de veces que se ha compartido-->
                <div class="form-group  col-md-3 ">
                <label class="control-label font-weight-bold" for="cantcompartida">Cantidad de veces compartido:</label>
                    <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded pl-2" id="cantcompartida" name="cantcompartida" value="<?php echo $cantidadCompartida ?>">
                                     
                </div>
                <!-- columna 3 tipo de usuario -->
                <div class="form-group col-md-6">
                    <label class="control-label font-weight-bold" for="idusuario">Usuario:</label>
                    <select class='custom-select' id='idusuario' name='idusuario' required>"
                        <option value="">Elija Usuario</option>
                        <?php
                        $select = new AbmUsuario();
                        $objSelect = $select->buscar(null);

                        foreach ($objSelect as $unObjeto) {
                            if($unObjeto->getUslogin()==$_SESSION["login"]){
                            echo  " <option value='" . $unObjeto->getIdusuario() . "'selected='selected'>" .ucfirst($unObjeto->getUsnombre())." ". ucfirst($unObjeto->getUsapellido()) . "</option>";
                        } 
                    }
                        ?>
                    </select>
                    <!-- mensajes para validacion select -->
                    <div class="invalid-feedback" for="idusuario"><br>Elija un usuario.</div>
                    <div class="valid-feedback" for="idusuario"> Perfecto!</div>
                </div>
            </div>
            <!--Fila 2 Motivo de eliminación-->
            <div class="form-row ">
                <div class="form-group col-12">
                    <label class="control-label font-weight-bold" for="acdescripcion">Motivo por el que deja de compartir: </label>
                    <textarea class="form-control font-weight-light text-wrap" rows="3" id="acdescripcion" name="acdescripcion" required></textarea>
                    <div class="valid-feedback" for="descripcionelim"> Perfecto!</div>
                    <div class="invalid-feedback" for="descripcionelim">Debe completar el campo.</div>
                </div>
            </div>
            <!--Fila 3 grupo de botones y etiquetas ocultas-->
            <div class="form-row">
          
            <input type="hidden" class="form-control font-weight-light " id="clave" name="clave" value="<?php echo $clave ?>">
                <div class="btn-group col-md-1 justify-content-between mb-3" role="group">
                    <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                    <button type="reset" class="btn btn-secondary mr-2">Borrar</button>
                    <button class="btn btn-info"> <a class="text-decoration-none text-white " href="contenido.php">Volver</a></button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once("../estructura/pie.php");
?>