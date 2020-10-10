<?php
$Titulo = " actionAMarchivo.php";
include_once("../estructura/cabecera.php");

$datos = data_submitted();
//print_r($datos);
$obj = new control_contenido();
$arrayDatos=[];
//print_r($_FILES);
if($datos["clave"]==0){
$arrayDatos = $obj->subirArchivo($datos);
?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- Accion Alta o Modificación de Archivo</h3>
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
<h2 class= text-primary>Resultado de la operacion:</h2> <?php echo " ".$arrayDatos[4]; ?> <br>
  <strong>Link de descarga:</strong> <a href=<?php echo " ".$arrayDatos[5]; ?>><?php echo " ".$arrayDatos[5]; ?></a> <br>
  <h3 class= text-primary>Los datos del archivo son:</h3>  
  <strong>Nombre:</strong> <?php echo " ".$arrayDatos[0]; ?> <br>
  <strong>Tipo de archivo:</strong> <?php echo " ".$arrayDatos[1]; ?> <br>
  <strong>Tamaño:</strong> <?php echo " ".$arrayDatos[2]. "KB" ; ?><br>
  <!--<strong>carpeta temporal:</strong> <?php //echo " ".$arrayDatos[3]; ?> <br>-->
  
  <strong>Cargado Por:</strong> <?php echo " ".$arrayDatos[6]; ?><br>
  <strong>Descripción:</strong> <?php echo " ".$arrayDatos[7]; ?><br>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="row col-md-12 p-3">
<button class="btn btn-info"> <a class="text-decoration-none text-white" href="contenido.php">Volver</a></button>
</div>
</div>
</div>
<?php
}
else{ 
  $arrayDatos = $obj->modificarArchivo($datos);
  ?>
  <!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- Accion Alta o Modificación de Archivo</h3>
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
  <h2 class= text-primary>Resultado de la operacion:</h2> <?php echo " ".$arrayDatos[2]; ?> <br>
  <h3 class= text-primary>Los datos del archivo son:</h3>  
  <strong>Nombre:</strong> <?php echo " ".$arrayDatos[0]; ?> <br>
  <strong>Tipo de archivo:</strong> <?php echo " ".$arrayDatos[1]; ?> <br>
  <strong>Cargado Por:</strong> <?php echo " ".$arrayDatos[3]; ?><br>
  <strong>Descripción:</strong> <?php echo " ".$arrayDatos[4]; ?><br>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="row col-md-12 p-3">
<button class="btn btn-info"> <a class="text-decoration-none text-white" href="contenido.php">Volver</a></button>
</div>
</div>
</div>
<?php
}
include_once("../estructura/pie.php");
?>