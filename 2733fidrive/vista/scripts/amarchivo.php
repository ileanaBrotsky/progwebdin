<?php
$Titulo = " amarchivo.php";
include_once("../estructura/cabecera.php");

?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 2- amarchivo.php</h3>
    </div>
    <!--contenedor de explicacion del ejercicio-->
    <div class="row col-md-12 text-alignt-center mt-2">
        <h5>Consigna</h5>
        <p class="font-bold" style="font-family: 'Noto Sans TC', sans-serif">
            Crear el archivo amarchivo.php para alta o modificación de un Archivo.<br>
            Debe incluir los archivos: cabecera.php, pie.php y menu.php.
            Nombre del Archivo (Colocar valor por defecto 1234.png). Descripción del Archivo.
            Usuario que lo carga (Seleccionar desde un Combo, los usuarios posibles son: admin, visitante, y usted)
            .Seleccionar Icono que se va a utilizar (Imagen, Zip, Doc, PDF, XLS). Usar CheckBox.
            Clave del Archivo a modificar. (Este debe ser un campo Oculto).</p>
    </div>
    <!--contenedor del Formulario-->
    <div class="nav shadow mb-5 rounded justify-content-center mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 " id="amformulario" name="amformulario" method="POST" action="modificarArchivo.php" novalidate>
            <!--Fila 1 % en 2 col-->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-md-6">
                    <label class="control-label font-weight-bold" for="nombrearchivo">Nombre del archivo:</label>
                    <input type="text" class="form-control font-weight-light" value="1234.png" id="nombrearchivo" name="nombrearchivo" required>
                    <div class="valid-feedback" for="nombrearchivo"> Perfecto!</div>
                    <div class="invalid-feedback" for="nombrearchivo">Debe completar el campo.</div>
                </div>
                <!-- columna 2 -clave archivo-->
                <div class="form-group col-md-6">
                    <label class="control-label font-weight-bold" for="clave">Clave del archivo:</label>
                    <input type="password" class="form-control font-weight-light" id="clave" name="clave" required>
                    <div class="valid-feedback" for="clave"> Perfecto!</div>
                    <div class="invalid-feedback" for="clave">Debe completar el campo.</div>
                </div>
            </div>
            <!-- Fila 2 % en 2 ol -->
            <div class="form-row ">
                <!-- columna 1 tipo de archivos -->
                <div class="form-group col-md-6">
                    <p class=font-weight-bold>Seleccione el tipo de archivo</p>
                    <!--grupo radio-button 1 imagen-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="imagen" name="tipoarchivo" value="imagen" class="custom-control-input" required>
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

                <!-- columna 2 tipo de usuario -->
                <div class="form-group col-md-6">
                    <p class=font-weight-bold>Seleccione el tipo de Usuario</p>
                    <select class="form-control" id="operacion" name="operacion">
                        <option>Ileana Brotsky</option>
                        <option>Administrador</option>
                        <option>Invitado</option>
                    </select>
                </div>
            </div>
            <!--Fila 3 descripcion archivo-->
            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label class="control-label font-weight-bold" for="descripcion">Descripción del archivo: </label>
                    <textarea class="form-control font-weight-light text-wrap" rows="3" id="descripcion" name="descripcion" required></textarea>
                    <div class="valid-feedback" for="descripcion"> Perfecto!</div>
                    <div class="invalid-feedback" for="descripcion">Debe completar el campo.</div>
                </div>
            </div>

            <!--Fila 5 del botón-->
            <!--Fila 5 grupo de botones-->
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