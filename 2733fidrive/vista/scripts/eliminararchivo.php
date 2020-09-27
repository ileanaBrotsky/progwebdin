<?php
$Titulo = " amarchivo.php";
include_once("../estructura/cabecera.php");

?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-3 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 2- eliminararchivo.php</h3>
    </div>
    <!--contenedor de explicacion del ejercicio-->
    <div class="row col-md-12 text-alignt-center mb-1 mt-2">
        <h5>Consigna</h5>
        <p class="font-bold" style="font-family: 'Noto Sans TC', sans-serif">
            Creamos el archivo eliminararchivo.php para eliminar un Archivo. <br>
            Este archivo debe incluir los archivos: cabedera.php, pie.php y menu.php. <br>
            Etiqueta que muestra nombre del archivo compartido (Colocar valor por defecto 1234.png).
            Motivo de Eliminación.
            Usuario que lo carga (Seleccionar desde un Combo, los usuarios posibles son: admin, visitante, y usted)</p>
    </div>
    <!--contenedor del Formulario-->
    <div class="container shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 align-center" id="eliminarformulario" name="eliminarformulario" method="POST" action="eliminarArchivo.php" novalidate>

            <!--Fila 1 % en 2 col-->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-sm p-1 ">
                    <p class="font-weight-bold">El nombre del archivo compartido es:</p>
                    <label class="bg-light shadow-lg rounded p-2 control-label font-weight-bold">1234.png</label>
                </div>
                <!-- columna 2 tipo de usuario -->
                <div class="form-group col-sm p-1 ">
                    <p class=font-weight-bold>Seleccione su tipo de Usuario</p>
                    <select class="form-control " id="operacion" name="operacion">
                        <option>Ileana Brotsky</option>
                        <option>Administrador</option>
                        <option>Invitado</option>
                    </select>
                </div>
            </div>
            <!--Fila 2 Motivo de eliminación-->
            <div class="form-row ">
                <div class="form-group col-12">
                    <label class="control-label font-weight-bold" for="descripcion">Motivo de eliminación del archivo: </label>
                    <textarea class="form-control font-weight-light text-wrap" rows="3" id="descripcion" name="descripcion" required></textarea>
                    <div class="valid-feedback" for="descripcion"> Perfecto!</div>
                    <div class="invalid-feedback" for="descripcion">Debe completar el campo.</div>
                </div>
            </div>
            <!--Fila 3 grupo de botones-->
            <div class="form-row">
                <div class="btn-group col-md-1 justify-content-between mb-3" role="group">
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