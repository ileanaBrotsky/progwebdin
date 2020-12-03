<?php

include_once("../estructura/cabeceraInicio.php");
$datos = data_submitted(); //el hash con el código que corresponde a aclinkacceso en Base de datos
//$datos['codigodescarga']
//print_r($datos);
$resp = false;
$objUsuario = new AbmArchivocargado();

$linkdescarga = $objUsuario->pasarLink($datos);

if ($linkdescarga == "No hay archivo para descargar") {
       $mensaje = "No encontramos tu archivo";
} else {
       $mensaje = "Encontramos tu archivo!";
}


?>

<!--Contenedor de todo-->
<div class="container col-12 border shadow rounded justify-content-center mt-5 pt-5 pb-5" id="presentacion">
       <div class="row col-12 justify-content-center">
              <h5 class="text-white animate__animated animate__fadeIn  "><?php echo $mensaje ?> </h5>
       </div>
       <div class="row col-12 justify-content-center mb-5">
              <div class="input-group col-6">
                     <input type="text" class="form-control " id="codigodescarga" name="linkdescarga" value="<?php echo $linkdescarga ?>" readonly>
                     <!-- BOTON A HREF --><button type="button" class="btn btn-secondary btn-sm"><a href="<?php echo $linkdescarga ?>">DESCARGAR</a></button>
              </div>
       </div>
       <div class="row col-12 justify-content-center mt-5">
              <h5 class="text-white animate__animated animate__fadeIn  ">Iniciá sesión para usar la aplicación</h5>
       </div>
       <!-- fila % en 2 col -->
       <div class="row col-12 mb-5 justify-content-center">
              <!-- columna 1 -->
              <div class="col-6 justify-content-center">
                     <div class="row col-12 justify-content-end">
                            <p class="text-white animate__animated animate__fadeIn  ">¿Sos de la casa?</p>
                     </div>
                     <div class="row col-12 justify-content-end">
                            <button class="btn btn-warning mr-2" name="ingresar" id="ingresar" data-toggle="modal" data-target="#login2">INGRESA</a> </button>
                     </div>
              </div>
              <!-- col 2 -->
              <div class="col-6 justify-content-center">
                     <div class=" row col-12 ">
                            <p class="text-white animate__animated animate__fadeIn">¿Sos nuevo?</p>
                     </div>
                     <div class="row col-12 ">
                            <button class="btn btn-info" name="registrarse" id="registrarse"><a class="text-decoration-none" href="../index/usuario.php">REGISTRATE</a> </button>
                     </div>
              </div>
       </div>

       <!-- Modal /se abre con un botón/ -->
       <div class="modal fade" id="login2" tabindex="-1" role="dialog" aria-labelledby="ModalInicioSesion" aria-hidden="true">
              <!-- para que el modal se centre verticalmetne en la pantalla "modal-dialog modal-dialog-centered-->
              <div class="modal-dialog modal-dialog-centered " role="document">
                     <div class="container shadow p-3 mb-5 bg-secondary rounded ">
                            <div class="modal-content ">
                                   <div class="modal-header">
                                          <div class="container ">
                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                 </button>
                                                 <h4 class="modal-title text-center" id="exampleModalLabel">Ingresa tus datos</h4>
                                          </div>
                                   </div>
                                   <div class="modal-body">
                                          <!--Formulario-->
                                          <form class="needs-validation" id="login" name="login" method="POST" action="actionLogin.php" novalidate>

                                                 <div class="form-group">
                                                        <!--para colocar el icono dentro del recuadro de texto-->
                                                        <div class="input-group">
                                                               <div class="input-group-prepend">
                                                                      <span class="input-group-text icon-user"></span>
                                                               </div>
                                                               <input type="text" class="form-control" id="uslogin" name="uslogin" placeholder="Usuario" required>
                                                               <div class="valid-feedback">Luce bien!</div>
                                                               <div class="invalid-feedback">Completá el campo. Sólo letras</div>
                                                        </div>
                                                 </div>
                                                 <div class="form-group">
                                                        <!--para colocar el icono dentro del recuadro de texto-->
                                                        <div class="input-group">
                                                               <div class="input-group-prepend">
                                                                      <span class="input-group-text icon-lock"> </span>
                                                               </div>
                                                               <input type="password" class="password-strength__input form-control" id="usclave" name="usclave" aria-describedby="passwordHelp" placeholder="Contraseña" required>
                                                               <div class="input-group-append">
                                                                      <button class="password-strength__visibility btn btn-outline-secondary" type="button"><span class="password-strength__visibility-icon" data-visible="hidden"><i class="fas fa-eye-slash"></i></span><span class="password-strength__visibility-icon js-hidden" data-visible="visible"><i class="fas fa-eye"></i></span></button>
                                                               </div>
                                                        </div>

                                                        <div class="valid-feedback">Luce bien!</div>
                                                        <div class="invalid-feedback">Completá el campo</div>
                                                 </div>
                                   </div>
                                   <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
                                   </form>
                            </div>

                     </div>

              </div>

       </div>
</div>



<?php
include_once("../estructura/pie.php");
?>