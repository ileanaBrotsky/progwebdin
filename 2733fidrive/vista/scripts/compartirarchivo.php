<?php
$Titulo = " amarchivo.php";
include_once("../estructura/cabecera.php");

?>
<?php
$datos = data_submitted();

//print_r($datos);
if ($datos != null) {

    $nombre = $datos['nombreArchivoModalC'];
} else {

    $nombre = "";
}
?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- compartirarchivo.php</h3>
    </div>

    <!--contenedor del Formulario-->
    <div class="container shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 align-center" id="compartirformulario" name="compartirformulario" method="POST" action="compartirArchivo.php" novalidate>
            <!--Fila 1 % en  3 col de 4-->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="nomarchivo">Nombre del archivo:</label>
                    <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded pl-2" id="nomarchivo" name="nomarchivo" value="<?php echo $nombre ?>">

                </div>
                <!-- columna 2 -dias que comparte-->
                <div class="form-group col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="diascompartido">Cantida de dias que se comparte:</label>
                    <input type="number" class="form-control font-weight-light col-md-3" id="diascompartido" name="diascompartido">
                    <div class="small form-text text-muted" for="diascompartido"> Si queda vacio no caducará</div>
                    <div class="invalid-feedback" for="clave"><br>Solo numeros.</div>
                    <div class="valid-feedback" for="clave"> Perfecto!</div>
                </div>
                <!-- columna 3 -cantidad de descargas-->
                <div class="form-group col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="decargasposibles">Cantidad de descargas:</label>
                    <input type="number" class="form-control font-weight-light col-md-3" id="decargasposibles" name="decargasposibles">
                    <div class="small form-text text-muted" for="decargasposibles"> Si queda vacio, sin límite</div>
                    <!-- mensajes para validacion radio button -->
                    <div class="invalid-feedback" for="clave"><br>Solo numeros.</div>
                    <div class="valid-feedback" for="clave"> Perfecto!</div>
                </div>
            </div>
            <!-- Fila 2 % en 3 col de 4-->
            <div class="form-row ">
                <!-- columna 1 tipo de usuario -->
                <div class="form-group col-md-4 p-1 ">
                    <p class=font-weight-bold>Seleccione el tipo de Usuario</p>
                    <select class="custom-select" id="usuasrio" name="usuasrio" required>
                        <option value="">Elija Usuario</option>
                        <option value="Ileana">Ileana Brotsky</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Invitado">Invitado</option>
                    </select>
                    <!-- mensajes para validacion select -->
                    <div class="invalid-feedback" for="usuasrio"><br>Elija un usuario</div>
                    <div class="valid-feedback" for="usuasrio"> Perfecto!</div>
                </div>
                <!-- columna 2 checkbox tiene contraseña -->
                <div class="form-group col-md-4 p-1 ">
                    <p class=font-weight-bold>Confirme si el archivo tiene contraseña</p>
                    <!--Checkbox desea contraeña?-->
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="checkclave" name="checkclave" onclick="mostrarcampoClave(this)">
                        <label class="form-check-label" for="checkclave">Tiene contraseña</label>
                    </div>
                </div>
                <!-- columna 3 ingrese contraseña -->
                <div class="form-group col-sm p-1" id="campoPassword">
                    <label for="password-input">Ingrsese contraseña</label>
                    <!--input contraseña-->
                    <div class="password-strength form p-4">
                        <div class="input-group">
                            <input type="password" class="password-strength__input form-control" onkeyup="chequearPassword()" id="password-input" name="password-input" aria-describedby="passwordHelp" placeholder="Ingrese contraseña" required />
                            <!-- el ojito que muestra u oculta lo que escribis -->
                            <div class="input-group-append">
                                <button type="button" class="password-strength__visibility btn btn-outline-secondary"><span class="password-strength__visibility-icon" data-visible="hidden"><i class="fas fa-eye-slash"></i></span>
                                    <span class="password-strength__visibility-icon js-hidden" data-visible="visible"><i class="fas fa-eye"></i></span>
                                </button>
                            </div>
                            <small class="form-text text-muted mt-2" id="passwordHelp">Minusculas/ mayusculas/ numeros/ simbolos</small>
                            <!-- mensajes para validacion radio button -->
                            <div class="invalid-feedback" for="password-input"><br>Debe completar el campo.</div>
                            <div class="valid-feedback" for="password-input"> Perfecto!</div>
                        </div>
                        <div class="progress" style="height: 1.5em;">
                            <div class="progress-bar bg-danger" role="progressbar"  style="width: 30%" id="pb30"aria-valuenow="30" aria-valuemin="0" aria-valuemax="30">debil</div>
                            <div class="progress-bar bg-warning" role="progressbar"  style="width: 60%" id="pb60"aria-valuenow="60" aria-valuemin="60" aria-valuemax="80">moderada</div>
                            <div class="progress-bar bg-success" role="progressbar"  style="width: 100%" id="pb100" aria-valuenow="100" aria-valuemin="80" aria-valuemax="100">fuerte</div>
                        </div>
                        <div class="tex">
                        <small class="form-text text-muted mt-2" id="pbtext" >Fortaleza de la contraseña</small>
                        </div>
                    </div>
                </div>

                <!--Fila 3 % en  3 col -->
                <div class="form-row col-12 ">
                    <!-- columna 1 -hash-->
                    <div class="form-group col-sm-4 p-1 ">
                        <label class="control-label font-weight-bold" for="btnHash">Genere un código para compartir:</label>
                        <button type="button" id="btnHash" onclick="hash()" class="btn btn-warning shadow mr-2 btn-block ">generar</button>
                    </div>
                    <!-- columna 2 -hash de descarga-->
                    <div class="form-group  col-sm p-1" id="campoHash">
                        <label class="control-label font-weight-bold" for="codigodescarga">El código hash del archivo es:</label>
                        <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded " id="codigodescarga" name="codigodescarga" value="">
                    </div>
                    <!-- columna 3 -link de descarga-->
                    <div class="form-group  col-sm p-1 ">
                        <label class="control-label font-weight-bold" for="linkdescarga">El link de descarga del archivo es:</label>
                        <button class=" form-control font-weight-bold bg-light shadow-lg rounded mr-2 pl-2" id="linkdescarga" name="linkdescarga"><a class="text-decoration-none" href=<?php echo "../../archivos/" . $nombre ?>><?php echo "../../archivos/" . $nombre ?></a> </button>
                    </div>
                </div>
                <!--Fila 4 grupo de botones-->
                <div class="form-row">
                    <div class="btn-group col-md-1 justify-content-between" role="group">
                        <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                        <button type="reset" class="btn btn-secondary mr-2" onclick=ocultarCampo()>Borrar</button>
                        <button class="btn btn-info" name="boton-volver" id="boton-volver"><a class="text-decoration-none" href="contenido.php">Volver</a> </button>
                    </div>
                </div>
        </form>
    </div>
</div>

<?php

include_once("../estructura/pie.php");
?>