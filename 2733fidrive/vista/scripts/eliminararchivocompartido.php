<?php
$Titulo = " eliminararchivocompartido.php";
include_once("../estructura/cabecera.php");

?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-3 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 2- eliminararchivocompartido.php</h3>
    </div>
    <!--contenedor de explicacion del ejercicio-->
    <div class="row col-md-12 text-alignt-center mt-2 mb-1">
        <h5>Consigna</h5>
        <p class="font-bold" style="font-family: 'Noto Sans TC', sans-serif">
            Creamos el archivo eliminararchivocompartido.php para eliminar las opciones de compartir un Archivo.<br>
            Este archivo debe incluir los archivos: cabedera.php, pie.php y menu.php.<br>
            Etiqueta que muestra nombre del archivo compartido (Colocar valor por defecto 1234.png).<br>
            Etiqueta que muestra la cantidad de veces que se compartió.<br>
            Motivo de ya no compartir el Archivo.
            Usuario que lo carga (Seleccionar desde un Combo, los usuarios posibles son: admin, visitante, y usted).</p>
    </div>
    <!--contenedor del Formulario-->
    <div class="container shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 align-center" id="eliminarcompformulario" name="eliminarcompformulario" method="POST" action="eliminarCompArchivo.php" novalidate>

            <!--Fila 1 % en  3 col -->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-sm p-1 ">
                    <p class="font-weight-bold">El nombre del archivo compartido es:</p>
                    <label class=" bg-light shadow-lg rounded p-2 control-label font-weight-bold">1234.png</label>
                </div>
                <!-- columna 2 -dias que se ha compartido-->
                <div class="form-group  col-sm p-1 ">
                    <p class="font-weight-bold">El archivo se ha compartido:</p>
                    <label class="bg-light shadow-lg rounded p-2 control-label font-weight-bold">10 veces</label>
                </div>
                <!-- columna 3 -Usuario-->
                <div class="form-group col-sm p-1 ">
                    <p class=font-weight-bold>Seleccione el tipo de Usuario</p>
                    <select class="form-control " id="usuarioeac" name="usuarioeac">
                        <option>Ileana Brotsky</option>
                        <option>Administrador</option>
                        <option>Invitado</option>
                    </select>
                </div>
            </div>
            <!--Fila 2 Motivo de eliminación-->
            <div class="form-row ">
                <div class="form-group col-12">
                    <label class="control-label font-weight-bold" for="motivoeac">Motivo de eliminación del archivo compartido: </label>
                    <textarea class="form-control font-weight-light text-wrap" rows="3" id="motivoeac" name="motivoeac" required></textarea>
                    <div class="valid-feedback" for="motivoeac"> Perfecto!</div>
                    <div class="invalid-feedback" for="motivoeac">Debe completar el campo.</div>
                </div>
            </div>

            <!--Fila 3 grupo de botones-->
            <div class="form-row">
                <div class="btn-group col-md-1 justify-content-between" role="group">
                    <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                    <button type="reset" class="btn btn-secondary">Borrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once("../estructura/pie.php");
?>