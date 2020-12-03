<?php 

include_once("../estructura/cabeceraInicio.php");
$datos = data_submitted();
//ver datos;
//print_r($datos);
$resp = false;
$objUsuario = new AbmUsuario();
        $usclave= base64_encode($datos["acprotegidoclave"]);
        $datosUsuario= ['idusuario'=>"","usnombre"=>strtolower($datos['usnombre']),'usapellido'=>strtolower($datos['usapellido']),"uslogin"=>$datos["uslogin"],
        "usclave"=> $usclave,"usactivo"=>"1"];
    if($objUsuario->altaNuevoUsuario($datosUsuario)){
    $resp =true;
   
}


if($resp){
    $mensaje = "Bienvenido ".$datos["usnombre"]."! Ya sos parte de la comunidad FIDRIVE.";
}else {
    $mensaje = "Lo sentimos ".$datos["usnombre"]." El nombre de usuario ya existe en la base de datos de FIDRIVE.";
}   


?>

<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/entrega final- Ingreso nuevo Usuario</h3>
    </div>
      <!--contenedor de explicacion del ejercicio-->
    <div class="row col-md-12 text-alignt-center mt-2">
        
        <p class="font-bold" style="font-family: 'Noto Sans TC', sans-serif">
            DATOS DE LA ACCION REALIZADA.</p>
    </div>
    
    <!--contenedor del Formulario-->
    <div class="nav shadow mb-5 rounded justify-content-center mt-2 p-3">
 <!-- contenedor tipo alert que se abre con la de respuesta -->
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <h2 class= text-primary>Resultado de la operacion:</h2> <br>
  <h3 class= text-primary><?php	echo $mensaje; ?></h3>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="row col-md-12 p-3 justify-content-center ">
<button class="btn btn-info"> <a class="text-decoration-none text-white" href="../index/contenido.php">Empezar</a></button>
</div>
</div>
</div>
<?php

include_once("../estructura/pie.php");
?>


