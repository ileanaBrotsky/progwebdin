<?php
$Titulo = " compartirarchivo.php";
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
        // print_r($objArchivo);
        $nombre = $objArchivo->getACNombre();
        $icono = $objArchivo->getACIcono();
        $clave = 3;
        $idArchivo = $datos['idarchivocargado'];
        $descrip = $objArchivo->getACDescrip();
    }
}
?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 4</h3>
    </div>

    <!--contenedor del Formulario-->
    <div class="container shadow mb-5 rounded  mt-2 p-3">

        <!--Formulario-->
        <form class="needs-validation col-12 align-center" id="compartirformulario" name="compartirformulario" method="POST" action="../accion/actionArchivoCargado.php" novalidate>
            <!--Fila 1 % en  3 col de 4-->
            <div class="form-row col-12 ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="acnombre">Nombre del archivo:</label>
                    <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded " id="acnombre" name="acnombre" value="<?php echo $nombre ?>">

                </div>
                <!-- columna 2 -dias que comparte-->
                <div class="form-group col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="diascompartido">Cantida de dias que se comparte:</label>
                    <input type="number" class="form-control font-weight-light col-md-3" id="diascompartido" name="diascompartido">
                    <div class="small form-text text-muted" for="diascompartido"> Si queda vacio no caducará</div>
                </div>
                <!-- columna 3 -cantidad de descargas-->
                <div class="form-group col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="decargasposibles">Cantidad de descargas:</label>
                    <input type="number" class="form-control font-weight-light col-md-3" id="accantidaddescarga" name="accantidaddescarga">
                    <div class="small form-text text-muted" for="decargasposibles"> Si queda vacio, sin límite</div>
                </div>
            </div>
            <!-- Fila 2 % en 3 col de 4-->
            <div class="form-row col-12 ">
                <div class="form-group col-4 p-1 ">
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
                <!-- columna 2 checkbox tiene contraseña -->
                <div class="form-group col-4 p-1 ">
                    <p class=font-weight-bold>Confirme si el archivo tiene contraseña</p>
                    <!--Checkbox desea contraeña?-->
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="checkclave" name="checkclave" onclick="mostrarcampoClave(this)">
                        <label class="form-check-label" for="checkclave">Tiene contraseña</label>
                    </div>
                </div>
                
                <!-- columna 3 ingrese contraseña -->
                <div class="form-group col-4 p-1 " id="campoPassword">-
                <form class="password-strength form p-4">
                    <!--input contraseña-->
                    <div class="form-group">
                    <label for="8">Ingrsese contraseña</label>
                        <div class="input-group">
                            <input class="password-strength__input form-control" type="password" onkeyup="chequearPassword()" id="acprotegidoclave" name="acprotegidoclave" aria-describedby="passwordHelp" placeholder="Ingrese contraseña" />
                            <div class="input-group-append">
                                <button class="password-strength__visibility btn btn-outline-secondary" type="button"><span class="password-strength__visibility-icon" data-visible="hidden"><i class="fas fa-eye-slash"></i></span><span class="password-strength__visibility-icon js-hidden" data-visible="visible"><i class="fas fa-eye"></i></span></button>
                            </div>
                        </div>
                        <small class="password-strength__error text-danger js-hidden">This symbol is not allowed!</small>
                        <small class="form-text text-muted mt-2" id="passwordHelp">Minusculas/ mayusculas/ numeros/ simbolos</small>
                    </div>
                    
                        <small class="form-text text-muted mt-2" id="pbtext">Fortaleza de la contraseña</small>

                    <div class="password-strength__bar-block progress mb-4">
                        <div class="password-strength__bar progress-bar bg-danger " role="progressbar" style="width: 30%" id="pb30" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30">debil</div>
                        <div class="password-strength__bar progress-bar bg-warning" role="progressbar" style="width: 60%" id="pb60" aria-valuenow="60" aria-valuemin="60" aria-valuemax="80">moderada</div>
                        <div class="password-strength__bar progress-bar bg-success" role="progressbar" style="width: 100%" id="pb100" aria-valuenow="100" aria-valuemin="80" aria-valuemax="100">fuerte</div>
                    </div>
                </form>
                </div>
                    

            <!--Fila 3 % en  2 col -->
            <div class="form-row col-12 ">
                <!-- columna 1 -hash-->
                <div class="form-group col-sm-4 p-1 ">
                    <label class="control-label font-weight-bold" for="btnHash">Genere un código de descarga:</label>
                    <button type="button" id="btnHash" onclick="hash()" class="btn btn-warning shadow mr-2 btn-block " required>generar</button>
                </div>
                <!-- columna 2 -hash de descarga-->
                <div class="form-group  col-sm p-1" id="campoHash">
                    <label class="control-label font-weight-bold" for="aclinkacceso">El código del archivo es:</label>
                    <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded " id="aclinkacceso" name="aclinkacceso" value="" required>
                </div>
               
            </div>
            <!--Fila 4 grupo de botones y etiquetas ocultas-->
            <div class="form-group col-md-6">
                <!--  <label class="control-label font-weight-bold" for="clave">Clave del archivo:</label> -->
                <input type="hidden" class="form-control font-weight-light " id="idarchivocargado" name="idarchivocargado" value="<?php echo $idArchivo ?>">
                <input type="hidden" class="form-control font-weight-light " id="clave" name="clave" value="<?php echo $clave ?>">
                <input type="hidden" class="form-control font-weight-light " id="descripcion" name="descripcion" value="<?php echo $descrip ?>">
                <input type="hidden" class="form-control font-weight-light " id="acicono" name="acicono" value="<?php echo $icono ?>">
            </div>
            <div class="form-row col-12">
                <div class="btn-group col-md-1 justify-content-between" role="group">
                    <button type="submit" class="btn btn-primary mr-2" name="boton-enviarca"  id="boton-enviarca">Enviar</button>
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