<?php 
$Titulo = "actioncrearcarpeta"; 
include_once("../estructura/cabecera.php");
?>
<!-- contenedor de todo -->
<div class="container border shadow  bg-white rounded justify-content-center mt-5" >
<?php 
$datos = data_submitted();
$obj = new control_contenido();
//print_r($datos);

$respuesta = $obj->crearCarpeta($datos);
?>
<!--Contenedor de titulo-->
<div class="nav bg-light shadow mb-5 rounded ">
       <h4 class= "text-primary" ><i class="far fa-edit"></i> Crear nueva carpeta</h3>
   </div>
    <!--Contenedor de Explicación ejercicio-->
   <div class="row col-md-12 text-alignt-center mt-2 "> 
     <h5>Respuesta</h5>
    
   </div>
<!-- contenedor de respuesta -->
<div class="nav bg-light shadow mb-5 rounded justify-content-center mt-5">
<h3 class="text-center font-weight-bold large"><?php echo "La carpeta '".$datos["nombreCarpetaNueva"]."' ". $respuesta ?> </h3>
</div>
<button class="btn btn-info m-5"> <a class="text-decoration-none text-white" href="contenido.php">Volver</a></button>
</div>
</div>



<?php 

include_once("../estructura/pie.php");
?>
