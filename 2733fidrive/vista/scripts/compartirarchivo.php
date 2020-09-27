<?php
$Titulo = " amarchivo.php";
include_once("../estructura/cabecera.php");

?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 2- compartirarchivo.php</h3>
    </div>
    <!--contenedor de explicacion del ejercicio-->
    <div class="row col-md-12 text-alignt-center mt-2">
        <h5>Consigna</h5>
        <p class="font-bold" style="font-family: 'Noto Sans TC', sans-serif">
            Crear el archivo compartirarchivo.php para compartir un archivo.
            Etiqueta del nombre archivo compartido (Colocar valor por defecto 1234.png).
            Ingresar cant. de días que se comparte (Si queda vació no expira).
            Ingresar cant. de descargar posibles (Si queda vació no hay limites).
            Usuario que lo carga (idem amarchivo).
            CheckBox para seleccionar que se debe proteger con contraseña.
            Un Campo para cargar la contraseña.
            Etiqueta del link de compartir generado.
            Botón para generar un hash que sera el acceso para compartir el archivo.</p>
    </div>
    <!--contenedor del Formulario-->
    <div class="container shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 align-center" id="compartirformulario" name="compartirformulario" method="POST" action="compartirArchivo.php" novalidate>
            <!--Fila 1 % en  3 col de 4-->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-sm p-1 ">
                    <p class="font-weight-bold">El nombre del archivo compartido es:</p>
                    <label class="bg-light shadow-lg rounded p-2 control-label font-weight-bold">1234.png</label>
                </div>
                <!-- columna 2 -dias que comparte-->
                <div class="form-group col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="diascompartido">Cantida de dias que se comparte:</label>
                    <input type="text" pattern=" [0-9]+" class="form-control font-weight-light col-md-3" id="diascompartido" name="diascompartido">
                    <div class="small form-text text-muted" for="diascompartido"> Si queda vacio no caducará</div>
                </div>
                <!-- columna 3 -cantidad de descargas-->
                <div class="form-group col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="decargasposibles">Cantidad de descargas posibles:</label>
                    <input type="text" pattern=" [0-9]+" class="form-control font-weight-light col-md-3" id="decargasposibles" name="decargasposibles">
                    <div class="small form-text text-muted" for="decargasposibles"> Si queda vacio, sin límite</div>
                </div>
            </div>
            <!-- Fila 2 % en 3 col de 4-->
            <div class="form-row ">
                <!-- columna 1 tipo de usuario -->
                <div class="form-group col-md-4 p-1 ">
                    <p class=font-weight-bold>Seleccione el tipo de Usuario</p>
                    <select class="form-control col-md-6" id="operacion" name="operacion">
                        <option>Ileana Brotsky</option>
                        <option>Administrador</option>
                        <option>Invitado</option>
                    </select>
                </div>
                <!-- columna 2 checkbox tiene contraseña -->
                <div class="form-group col-md-4 p-1 ">
                    <p class=font-weight-bold>Confirme si el archivo tiene contraseña</p>
                    <!--Checkbox desea contraeña?-->
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="checkclave" name="checkclave" onclick=mostrarcampoClave(this)>
                        <label class="form-check-label" for="checkclave">Tiene contraseña</label>
                    </div>
                </div>
                <!-- columna 3 ingrese contraseña -->
                <div class="form-group col-sm p-1" id="campoClave">
                    <p class=font-weight-bold>Ingrsese contraseña</p>
                    <!--Checkbox desea contraeña?-->
                    <div class="form-check form-check-inline">
                        <input type="password" class="form-control" id="clave" name="clave" required>
                        <!-- mensajes para validacion radio button -->
                        <div class="invalid-feedback" for="clave"><br>Debe completar el campo.</div>
                        <div class="valid-feedback" for="clave"> Perfecto!</div>
                    </div>
                </div>
            </div>
            <!--Fila 3 % en  2 col -->
            <div class="form-row ">
                <!-- columna 1 -hash-->
                <div class="form-group col-sm-4 p-1 ">
                    <p class="font-weight-bold">genere un hash para compartir:</p>
                    <button type="button" class="btn btn-secondary shadow mr-2 ">generador de hash</button>
                </div>
                <!-- columna 2 -link de descarga-->
                <div class="form-group  col-sm-4 p-1 ">
                    <p class="font-weight-bold">El el link de descarga del archivo es:</p>
                    <label class="bg-light shadow-lg rounded p-2 control-label font-weight-bold col-10">www.xxxxxxxxxxxxxx</label>
                </div>

            </div>

            <!--Fila 5 del botón-->
            <!--Fila 5 grupo de botones-->
            <div class="form-row">
                <div class="btn-group col-md-1 justify-content-between" role="group">
                    <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                    <button type="reset" class="btn btn-secondary" onclick=ocultarCampo()>Borrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once("../estructura/pie.php");
?>