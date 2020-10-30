<?php 

include_once("../estructura/cabecera.php");
$datos = data_submitted();
//ver datos;
//print_r($datos);
$accion="";
$resp = false;
$objTrans = new AbmArchivoCargado();

if (isset($datos['clave'])){
//---------------------------- Clave 0 = ALTA  --------------------------------------------
if($datos['clave']=='0'){
    if($objTrans->ejecutarAlta($datos)){
        $resp =true;
        $accion= "Cargar Archivo";
   
  
    }
} 
//-------------------------- clave 1= MODIFICACION ---------------------------------------
    
    if($datos['clave']=='1'){
        //echo"entró";
        if($objTrans->modificacion($datos)){
            $resp = true;
            $accion= "Modificar Archivo";
        }
    }

//---------------------------clave 2= ELIMINACIÓN--------------------------------------------
    if($datos['clave']=='2'){
        if($objTrans->darbaja($datos)){
            $resp =true;
            $accion= "Eliminar Archivo";
        }
        
    }
//---------------------------clave 3= COMPARTIR--------------------------------------------
if($datos['clave']=='3'){
    
        if($objTrans->compartirArchivo($datos)){
        $resp =true;
        $accion= "Compartir Archivo";
    }
    
}
    if($resp){
        $mensaje = "La accion ".$accion." se realizo correctamente.";
    }else {
        $mensaje = "La accion ".$accion." no pudo concretarse.";
    }
 //---------------------------clave 4= NO COMPARTIR MAS--------------------------------------------
if($datos['clave']=='4'){
    
    if($objTrans->dejardeCompartir($datos)){
    $resp =true;
    $accion= "Dejar de compartir Archivo";
}

}
if($resp){
    $mensaje = "La accion ".$accion." se realizo correctamente.";
}else {
    $mensaje = "La accion ".$accion." no pudo concretarse.";
}   
}

?>

<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-4 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 4- Accion Alta o Modificación de Archivo</h3>
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
<button class="btn btn-info"> <a class="text-decoration-none text-white" href="../index/contenido.php">Volver</a></button>
</div>
</div>
</div>
<?php

include_once("../estructura/pie.php");
?>


