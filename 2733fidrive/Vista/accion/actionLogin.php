<?php 

include_once("../estructura/cabeceraInicio.php");
$datos = data_submitted();
//ver datos;
//print_r($datos);
$resp = false;
$objUsuario = new AbmUsuario();
$usclave= base64_encode($datos["usclave"]);
$datosUsuario= ["uslogin"=>$datos["uslogin"],"usclave"=> $usclave];
$datosSesion= $objUsuario->loguearUsuario($datosUsuario);
    if($datosSesion!=""){
    $resp =true;
   //print_r($datosSesion); 
}


if($resp){
  header ("location: http://localhost/progwebdin/2733fidrive/vista/index/contenido.php");
   
}else {
   
 
  
?>

<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable-parte 5/ Login</h3>
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
  <h3 class= text-primary><?php	echo "Lo sentimos , hay un error en el ingreso de los datos ."; ?></h3>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    <!-- dibujito de duolingo  -->
    <div class="F2B9m"><div class="_2Dn_R"><img class="_1RL1c" src="https://d2pur3iezf4d1j.cloudfront.net/images/a6d286619505b43e1c94e259bb1a628f"></div></div>
    </div> 
    <!-- fin dibujito -->
</div>
<div class="row col-md-12 p-3">
<button class="btn btn-info"> <a class="text-decoration-none text-white" href="../index/interface.php">Volver</a></button>
</div>
</div>
</div>

<?php
}
include_once("../estructura/pie.php");
?>


