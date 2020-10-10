<?php
$Titulo = " amarchivo.php";
include_once("../estructura/cabecera.php");

?>
<?php 
$datos = data_submitted();
//print_r($datos);
if ($datos!=null){
    $clave= $datos["clave"];
    $nombre=$datos['nombreArchivoModalM'];
    
}else{
    $clave=0;
    $nombre="";

}
?>

<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- Alta o Modificación de archivo</h3>
    </div>

    <!--contenedor del Formulario-->
    <div class="nav shadow mb-5 rounded justify-content-center mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 " id="amformulario" name="amformulario" method="POST" action="actionAMarchivo.php" enctype="multipart/form-data"  novalidate>
            <!--Fila 1 subir archivo-->
            <div class="form-row ">
                <input type="file" class=" col-4" id="archivo" onchange="setearNombre()" name="archivo" accept="image/*,.zip,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"> 
            </div> 
            <!--Fila 2 % en 2 col-->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-md-6">
                    <label class="control-label font-weight-bold" for="nombrearchivo">Nombre del archivo:</label>
                    <input type="text" class="form-control font-weight-light" id="nombrearchivo"  name="nombrearchivo"  value="<?php echo $nombre ?>" onchange="sugerirRadio()" readonly>
                 </div>
                <!-- columna 2 tipo de usuario -->
                <div class="form-group col-md-6">
                <label class="control-label font-weight-bold" for="usuario">Seleccione el tipo de Usuario:</label>
                    <select class="custom-select" id="usuario" name="usuario" required>
                        <option value="">Elija Usuario</option>
                        <option value="Ileana Brotsky">Ileana Brotsky</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Invitado">Invitado</option>
                    </select>
                    <!-- mensajes para validacion select -->
                    <div class="invalid-feedback" for="usuario"><br>Elija un usuario.</div>
                    <div class="valid-feedback" for="usuario"> Perfecto!</div>
                </div>

            </div>
            <!-- Fila 2 % en 2 ol -->
            <div class="form-row ">
                <!-- columna 1 tipo de archivos -->
                <div class="form-group col-md-6 ">
                    <p class=font-weight-bold>Seleccione el tipo de archivo</p>
                    <!--grupo radio-button 1 imagen-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="imagen" name="tipoarchivo" value="Imagen" class="custom-control-input" required>
                        <label class="custom-control-label" for="imagen">Imagen</label>
                    </div>
                    <!--grupo radio-button 2 Zip-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="Zip" name="tipoarchivo" value="Zip" class="custom-control-input" required>
                        <label class="custom-control-label" for="Zip">Zip</label>
                    </div>
                    <!--grupo radio-button 3 PDF-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="PDF" name="tipoarchivo" value="PDF" class="custom-control-input" required>
                        <label class="custom-control-label" for="PDF">PDF</label>
                    </div>
                    <!--grupo radio-button 4 DOC-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="DOC" name="tipoarchivo" value="DOC" class="custom-control-input" required>
                        <label class="custom-control-label" for="DOC">DOC</label>
                    </div>
                    <!--grupo radio-button 5 XLS-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="XLS" name="tipoarchivo" value="XLS" class="custom-control-input" required>
                        <label class="custom-control-label" for="XLS">XLS</label>
                    </div>
                    <!-- mensajes para validacion radio button -->
                    <div class="invalid-feedback" for="tipoarchivo"><br>Debe completar al menos un campo.</div>
                    <div class="valid-feedback" for="tipoarchivo"> Perfecto!</div>
                </div>
                <!-- columna 2 -clave archivo-->
                <div class="form-group col-md-6">
                    <!--  <label class="control-label font-weight-bold" for="clave">Clave del archivo:</label> -->
                    <input type="hidden" class="form-control font-weight-light " id="clave" name="clave" value="<?php echo $clave ?>">
                    <!--   <div class="small form-text text-muted" for="decargasposibles"> 0 = Alta / 1= Modificación</div>-->
                </div>

            </div>
            <!--Fila 3 descripcion archivo-->
            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label class="control-label font-weight-bold" for="descripcion">Descripción del archivo: </label>
                    <!--  del editor enriqeucido-->
                    <textarea name="editor1">
                        
                        <p>Esta es una descripción genérica, si quiere puede cambiarla.</p>
                        </textarea>
                    </div>
                    <div class="valid-feedback" for="descripcion"> Perfecto!</div>
                    <div class="invalid-feedback" for="descripcion">Debe completar el campo.</div>
                </div>
            


            <!--Fila 4 grupo de botones-->
            <div class="form-row">
                <div class="btn-group col-md-1 justify-content-between" role="group">
                    <button type="submit" class="btn btn-primary mr-2"  name="boton-enviaram" id="boton-enviaram">Enviar</button>
                    <button type="reset" class="btn btn-secondary mr-2"  name="boton-borraram"  id="boton-borraram">Borrar</button>
                    <button class="btn btn-info" name="boton-volver"  id="boton-volver"><a class="text-decoration-none" href="contenido.php">Volver</a> </button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php

include_once("../estructura/pie.php");
?>