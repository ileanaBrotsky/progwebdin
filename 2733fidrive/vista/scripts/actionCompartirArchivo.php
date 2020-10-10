<?php
$Titulo = " actionAMarchivo.php";
include_once("../estructura/cabecera.php");

$datos = data_submitted();
print_r($datos);
$obj = new control_contenido();
print_r($_FILES);

$arrayDatos = $obj->subirArchivo($datos);
?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- Accion Compartir Archivo.php</h3>
    </div>
    <!--contenedor de explicacion del ejercicio-->
    <div class="row col-md-12 text-alignt-center mt-2">
        
        <p class="font-bold" style="font-family: 'Noto Sans TC', sans-serif">
            DATOS DE LA ACCION REALIZADA.</p>
    </div>
    
    <!--contenedor del Formulario-->
    <div class="nav shadow mb-5 rounded justify-content-center mt-2 p-3">
        <!--Formulario-->
        <!--Contenedor de Explicación ejercicio-->
<div class="row col-md-12 text-alignt-center mt-2 "> 
     <h5>Respuesta</h5>
</div>
<!-- contenedor tipo alert que se abre con la de respuesta -->
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <h2 class= text-primary>Los datos del archivo son:</h2>  
  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="row col-md-12 p-3">
<button class="btn btn-secondary"> <a class="text-decoration-none text-white" href="contenido.php">Volver</a></button>
</div>
</div>
</div>
<?php

include_once("../estructura/pie.php");
?>