<?php
$Titulo = " amarchivo.php";
include_once("../estructura/cabecera.php");

?>
<?php
$objAbmArchivoCargado = new AbmArchivoCargado();
$datos = data_submitted();
//print_r($datos);
//chequeo si se enviaron datos , para saber si es modificación o alta e archivo
// si hay datos los cargo en formulario, para modificacion
$objArchivo = NULL;
if (isset($datos['idarchivocargado'])) {
    $listaArchivos = $objAbmArchivoCargado->buscar($datos);
      // print_r($listaArchivos);
    if (count($listaArchivos) == 1) {
        $objArchivo = $listaArchivos[0];
           //print_r($objArchivo);
        $nombre = $objArchivo->getACNombre();
        $icono = $objArchivo->getACIcono();
        $usuario = $objArchivo->getObjUsuario()->getIdUsuario();
        $descrip = $objArchivo->getACDescrip();
        $clave = 1;
        $idArchivo = $datos['idarchivocargado'];
       
    }
} else {
    $clave = 0;
    $nombre = "";
    $icono = "";
    $usuario = "";
    $descrip = "Esta es una desccripción genérica, si quiere puede cambiarla";
    $idArchivo ="";
}
?>

<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 4- Alta o modificación de archivo</h3>
    </div>

    <!--contenedor del Formulario-->
    <div class="nav shadow mb-5 rounded justify-content-center mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 " id="amformulario" name="amformulario" method="POST" action="../accion/actionArchivoCargado.php" enctype="multipart/form-data" novalidate>
            <!--Fila 1 subir archivo-->
            <div class="form-row ">
                <input type="file" class=" col-4" id="archivo" onchange="setearNombre()" name="archivo" accept="image/*,.zip,.pdf,.doc,.docx,.xls,.xlsx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
            </div>
            <!--Fila 2 % en 2 col-->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-md-6">
                    <label class="control-label font-weight-bold" for="acnombre">Nombre del archivo:</label>
                    <input type="text" class="form-control font-weight-light" id="acnombre" name="acnombre" value="<?php echo $nombre ?>" onchange="sugerirRadio()" readonly>
                </div>
                <!-- columna 2 tipo de usuario -->
                <div class="form-group col-md-6">
                    <label class="control-label font-weight-bold" for="idusuario">Seleccione el tipo de Usuario:</label>
                    <select class='custom-select' id='idusuario' name='idusuario' required>"
                        <option value="">Elija Usuario</option>
                        <?php
                        $select = new AbmUsuario();
                        $objSelect = $select->buscar(null);

                        foreach ($objSelect as $unObjeto) {
                            echo  " <option value='" . $unObjeto->getIdusuario() . "'>" . $unObjeto->getUsapellido() . "</option>";
                        } 
                        ?>
                    </select>
                    <!-- mensajes para validacion select -->
                    <div class="invalid-feedback" for="idusuario"><br>Elija un usuario.</div>
                    <div class="valid-feedback" for="idusuario"> Perfecto!</div>
                </div>

            </div>
            <!-- Fila 2 % en 2 ol -->
            <div class="form-row ">
                <!-- columna 1 tipo de archivos -->
                <div class="form-group col-md-6 ">
                    <p class=font-weight-bold>Seleccione el tipo de archivo</p>
                    <!--grupo radio-button 1 imagen-->
                    <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="imagen" name="acicono" value="Imagen" class="custom-control-input"<?php if($icono!=""&&$icono=="Imagen"):?>checked=' <? = echo "checked"?>  <?php endif; ?>'required>
                        <label class="custom-control-label" for="imagen">Imagen</label>
                    </div>
                    <!--grupo radio-button 2 Zip-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="Zip" name="acicono" value="Zip" class="custom-control-input"<?php if($icono!=""&&$icono=="Zip"):?>checked=' <? = echo "checked"?>  <?php endif; ?>'required>
                        <label class="custom-control-label" for="Zip">Zip</label>
                    </div>
                    <!--grupo radio-button 3 PDF-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="PDF" name="acicono" value="PDF" class="custom-control-input" <?php if($icono!=""&&$icono=="PDF"):?>checked=' <? = echo "checked"?>  <?php endif; ?>'required>
                        <label class="custom-control-label" for="PDF">PDF</label>
                    </div>
                    <!--grupo radio-button 4 DOC-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="DOC" name="acicono" value="DOC" class="custom-control-input" <?php if($icono!=""&&$icono=="DOC"):?> checked='<? = echo "checked"?>  <?php endif; ?>'required>
                        <label class="custom-control-label" for="DOC">DOC</label>
                    </div>
                    <!--grupo radio-button 5 XLS-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="XLS" name="acicono" value="XLS" class="custom-control-input" <?php if($icono!=""&&$icono=="XLS"):?>checked=' <? = echo "checked"?>  <?php endif; ?>'required>
                        <label class="custom-control-label" for="XLS">XLS</label>
                    </div>
                    <!-- mensajes para validacion radio button -->
                    <div class="invalid-feedback" for="acicono"><br>Debe completar al menos un campo.</div>
                    <div class="valid-feedback" for="acicono"> Perfecto!</div>
                </div>
                <!-- columna 2 -clave archivo y datos en vacio para cargar archivo-->
                <div class="form-group col-md-6">
                    <!--  <label class="control-label font-weight-bold" for="clave">Clave del archivo:</label> -->
                    <input type="hidden" class="form-control font-weight-light " id="idarchivocargado" name="idarchivocargado" value="<?php echo $idArchivo ?>">
                    <input type="hidden" class="form-control font-weight-light " id="clave" name="clave" value="<?php echo $clave ?>">
                    <input type="hidden" class="form-control font-weight-light " id="aclinkacceso" name="aclinkacceso" value="">
                    <input type="hidden" class="form-control font-weight-light " id="accantidaddescarga" name="accantidaddescarga" value="">
                    <input type="hidden" class="form-control font-weight-light " id="accantidadusada" name="accantidadusada" value="">
                    <input type="hidden" class="form-control font-weight-light " id="acfechainiciocompartir" name="acfechainiciocompartir" value="">
                    <input type="hidden" class="form-control font-weight-light " id="acefechafincompartir" name="acefechafincompartir" value="">
                    <input type="hidden" class="form-control font-weight-light " id="acprotegidoclave" name="acprotegidoclave" value="">
                    <!--   <div class="small form-text text-muted" for="decargasposibles"> 0 = Alta / 1= Modificación</div>-->
                </div>

            </div>
            <!--Fila 3 descripcion archivo-->
            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label class="control-label font-weight-bold" for="acdescripcion">Descripción del archivo: </label>
                    <!--  del editor enriqeucido-->
                    <textarea name="acdescripcion">

                        <p><?php echo $descrip ?></p>
                        </textarea>
                </div>
                <div class="valid-feedback" for="acdescripcion"> Perfecto!</div>
                <div class="invalid-feedback" for="acdescripcion">Debe completar el campo.</div>
            </div>



            <!--Fila 4 grupo de botones-->
            <div class="form-row">
                <div class="btn-group col-md-1 justify-content-between" role="group">
                    <button type="submit" class="btn btn-primary mr-2" name="boton-enviaram" id="boton-enviaram">Enviar</button>
                    <button type="reset" class="btn btn-secondary mr-2" name="boton-borraram" id="boton-borraram">Borrar</button>
                    <button class="btn btn-info" name="boton-volver" id="boton-volver"><a class="text-decoration-none" href="contenido.php">Volver</a> </button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php

include_once("../estructura/pie.php");
?>