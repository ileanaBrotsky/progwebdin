<?php 

include_once("../estructura/cabecera.php");
$datos = data_submitted();
//ver datos;
//print_r($datos);
$resp = false;
$objUsuario = new AbmUsuario();
if(!is_null($datos['nuevoRol'])){
  $objUsuario = new AbmUsuario();
  $objUsuario->altaUsuarioRolExistente($datos);
  $resp =true;
}
if($objUsuario->modificacion($datos)){
  $resp =true;
}
 

if($resp){
  $mensaje= "Los datos se han modificado correctamente";
   
}
else {
  $mensaje= "No se han podido modificar los datos"; 
} 


?>

<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable. Parte 5/ Actualizar datos usuario</h3>
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
<div class="row col-md-12 p-3">
<button class="btn btn-info"> <a class="text-decoration-none text-white" href="../index/listarUsuario.php">Volver</a></button>
</div>
</div>
</div>

<?php

include_once("../estructura/pie.php");
?>


