<?php
$Titulo = " actualizarlogin.php";
include_once("../estructura/cabecera.php");
?>


<?php
$objAbmUsuario = new AbmUsuario();
$datos = data_submitted();
//print_r($datos);

//chequeo si se enviaron datos , para saber si es modificación o alta e archivo
// si hay datos los cargo en formulario, para modificacion
$objUs = NULL;
if (isset($datos['idusuario'])) {
    $usuario = $objAbmUsuario->buscar($datos);
      
    if (count($usuario) == 1) {
        $objUs = $usuario[0];
           //print_r($objArchivo);
        $id= $datos['idusuario'];
        $nombre =ucfirst( $objUs->getUsnombre());
        $apellido = ucfirst($objUs->getUsapellido());
        $usuario = $objUs->getUslogin();
        $pass = $objUs->getUsclave();
        $activo = $objUs->getUsactivo();
       
            } 
       

    }

    ?>     
     <!--contenedor de todo-->
     <div class="container border bg-white shadow rounded justify-content-center mt-3">
         <!--contenedor de titulo-->
         <div class="nav bg-light shadow mb-4 rounded">
             <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Entrega 5- Actualización de usuario</h4>
         </div>

         <!--contenedor del Formulario-->
         <div class="nav shadow mb-5 rounded justify-content-center mt-2 p-3">
             <!--Formulario-->
             <form class="needs-validation col-12 " id="actUsuario" name="actUsuario" method="POST" action="../accion/actionActualizarLogin.php" novalidate>
            <!--Fila 1 % en 2 col de 6-->
             <div class="form-row ">
             <!--col 1 nombre-->
             <div class="col-6 ">
             <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="usnombre">Nombre:</label>
                   <input type="text" class="form-control" id="usnombre" name="usnombre" value= <?php echo $nombre ?> required>
                   <!-- mensajes para validacion Marca -->
                    <div class="invalid-feedback" for="usnombre"><br>Debe completar el campo.</div>
                    <div class="valid-feedback" for="usnombre"> Perfecto!</div>
               </div>
               </div>
               <!--col 2 Apellido-->
                <div class="col-6 ">
                <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="usapellido">Apellido:</label>
                   <input type="text" class="form-control" id="usapellido" name="usapellido"  value= <?php echo $apellido ?>  required>
                   <!-- mensajes para validacion Marca -->
                    <div class="invalid-feedback" for="usapellido"><br>Debe completar el campo.</div>
                    <div class="valid-feedback" for="usapellido"> Perfecto!</div>
               </div>
               </div>
               </div>
          <!--Fila 2 % en 2 col de 6-->
          <div class="form-row ">
           <!--col 1 Nombre de usuario-->
           <div class="col-6 ">
               <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="uslogin">Nombre de Usuario:</label>
                   <input type="text" class="form-control" id="uslogin" name="uslogin" pattern= "^[a-zA-Z]*$"  value= <?php echo $usuario ?>  required>
                   <!-- mensajes para validacion usuariologin -->
                    <div class="invalid-feedback" for="uslogin"><br>Debe completar el campo.</div>
                    <div class="valid-feedback" for="uslogin"> Perfecto!</div>
               </div>
            </div>
           <!--col 2 contraseña-->
           <div class="col-6 ">
                <div class="form-group">
                    <label  class="control-label font-weight-bold" for="usclave">Contraseña</label>
                        <div class="input-group">
                            <input class="password-strength__input form-control" type="password" onkeyup="chequearPassword()" id="usclave" name="usclave" aria-describedby="passwordHelp"  value= <?php echo $pass ?>  required/>
                            <div class="input-group-append">
                                <button class="password-strength__visibility btn btn-outline-secondary" type="button"><span class="password-strength__visibility-icon" data-visible="hidden"><i class="fas fa-eye-slash"></i></span><span class="password-strength__visibility-icon js-hidden" data-visible="visible"><i class="fas fa-eye"></i></span></button>
                            </div>
                            <div class="invalid-feedback" for="acprotegidoclave"><br>Debe completar el campo.</div>
                        </div>
                        <small class="password-strength__error text-danger js-hidden">Este símbolo no está permitido</small>
                        <small class="form-text text-muted mt-2" id="passwordHelp">Minusculas/ mayusculas/ numeros/ simbolos</small>
                        <small class="form-text text-muted mt-2" id="pbtext">Fortaleza de la contraseña</small>
                    <div class="password-strength__bar-block progress mb-4">
                        <div class="password-strength__bar progress-bar bg-danger " role="progressbar" style="width: 30%" id="pb30" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30">debil</div>
                        <div class="password-strength__bar progress-bar bg-warning" role="progressbar" style="width: 60%" id="pb60" aria-valuenow="60" aria-valuemin="60" aria-valuemax="80">moderada</div>
                        <div class="password-strength__bar progress-bar bg-success" role="progressbar" style="width: 100%" id="pb100" aria-valuenow="100" aria-valuemin="80" aria-valuemax="100">fuerte</div>
                    </div>
                    </div>
               </div>
               </div>   
              <!--Fila 3 % en 2 col de 6-->
          <div class="form-row ">
           <!--col 1 roles de usuario-->
           <div class="col-6 ">
               <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="roles">Roles actuales del Usuario:</label>
                   <input type= "text" class="form-control font-weight-light" value= "<?php echo $datos['roles']?>"readonly>
                </div> 
            </div>
            <!-- columna 2 elija nuevo rol -->
             <div class="col-6 ">
                <div class="form-group ">
                    <label class="control-label font-weight-bold" for="nuevoRol">Puede agregar rol:</label>
                    <select class='custom-select' id='nuevoRol' name='nuevoRol'>"
                        <option value="">Elija rol</option>
                        <?php
                        $rol = new AbmRol();
                        $objRoles = $rol->buscar(null);

                        foreach ($objRoles as $unObjeto) {
                            echo  " <option value='" . $unObjeto->getIdrol() . "'>" . $unObjeto->getRodescripcion() . "</option>";
                        } 
                        ?>
                    </select>
                </div>
             </div>    
             </div>
          <!-- etiqueta invisible que envia el idusuario  y otra que envia activo-->
          <input type="hidden" class="form-control font-weight-light " id="idusuario" name="idusuario" value="<?php echo $id ?>"> <!-- etiqueta invisible que envia el idusuario -->
          <input type="hidden" class="form-control font-weight-light " id="usactivo" name="usactivo" value="<?php echo 1 ?>">
            <!--Fila 3 grupo de botones -->
            <div class="form-row ">
                <div class="btn-group col-md-1 justify-content-between" role="group">
                    <button type="submit" class="btn btn-primary mr-2" name="boton-enviarform"  id="boton-enviarform">Enviar</button>
                    <button type="reset" class="btn btn-secondary mr-2">Borrar</button>
                    <button class="btn btn-info" name="boton-volver" id="boton-volver"><a class="text-decoration-none" href="listarUsuario.php">Volver</a> </button>
                </div>
            </div>
        </form>  
        </div>
    </div>

<?php

include_once("../estructura/pie.php");
?>