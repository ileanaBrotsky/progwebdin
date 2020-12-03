<?php 

include_once("../estructura/cabecera.php");
$datos = data_submitted();
//ver datos;
//print_r($datos);
$resp = false;
$objRol = new AbmRol();

    if($objRol->alta($datos)){
    $resp =true;
    
}


if($resp){
    $mensaje = "El rol ".$datos["rodescripcion"]." ha sido ingresado con éxito.";
}else {
    $mensaje = "Lo sentimos,no se ha podido ingresar el nuevo rol";
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

</div>
</div>
<?php

include_once("../estructura/pie.php");
?>


