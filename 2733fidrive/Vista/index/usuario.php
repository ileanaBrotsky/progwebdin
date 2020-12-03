<?php
$Titulo = " usuario.php";
include_once("../estructura/cabeceraInicio.php");

?>
<?php

?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3 p-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Registrar nuevo usuario</h3>
    </div>
            <!--Formulario-->
        <form class="needs-validation col-12  align-center" id="userform" name="userform" method="POST" action="../accion/actionIngreso.php" novalidate>
        <div class="password-strength form p-4 " id="campoPassword2">
             <!--Fila 1 % en 2 col de 6-->
             <div class="form-row ">
             <!--col 1 nombre-->
             <div class="col-6 ">
             <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="usnombre">Nombre:</label>
                   <input type="text" class="form-control" id="usnombre" name="usnombre" placeholder="Ingrese su nombre" required>
                   <!-- mensajes para validacion Marca -->
                    <div class="invalid-feedback" for="usnombre"><br>Debe completar el campo.</div>
                    <div class="valid-feedback" for="usnombre"> Perfecto!</div>
               </div>
               </div>
               <!--col 2 Apellido-->
                <div class="col-6 ">
                <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="usapellido">Apellido:</label>
                   <input type="text" class="form-control" id="usapellido" name="usapellido" placeholder="Ingrese su apellido" required>
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
                   <input type="text" class="form-control" id="uslogin" name="uslogin" pattern= "^[a-zA-Z]*$" placeholder="Cree su nombre de usuario" required>
                   <!-- mensajes para validacion Marca -->
                    <div class="invalid-feedback" for="uslogin"><br>Debe completar el campo.</div>
                    <div class="valid-feedback" for="uslogin"> Perfecto!</div>
               </div>
            </div>
           <!--col 2 contraseña-->
           <div class="col-6 ">
                <div class="form-group">
                    <label  class="control-label font-weight-bold" for="acprotegidoclave">Ingrese contraseña</label>
                        <div class="input-group">
                            <input class="password-strength__input form-control" type="password" onkeyup="chequearPassword()" id="acprotegidoclave" name="acprotegidoclave" aria-describedby="passwordHelp" placeholder="Cree una contraseña usando minúsculas mayúsculas y símbolos" required/>
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
                
          
            <!--Fila 3 grupo de botones -->
            <div class="form-row ">
                <div class="btn-group col-md-1 justify-content-between" role="group">
                    <button type="submit" class="btn btn-primary mr-2" name="boton-enviarform"  id="boton-enviarform">Enviar</button>
                    <button type="reset" class="btn btn-secondary mr-2">Borrar</button>
                    <button class="btn btn-info" name="boton-volver" id="boton-volver"><a class="text-decoration-none" href="interface.php">Volver</a> </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once("../estructura/pie.php");
?>