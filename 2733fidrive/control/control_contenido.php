<?php

class control_contenido  {

 //para obtener todos los archivos que no son carpetas de un directorio- SE USA EN CONTENIDO.PHP
    public function obtenerFiles(){
      $directorio = "../../archivos/";
      $archivos = scandir($directorio);
      //print_r($archivos);
      $arrayFiles=[];
      if($archivos!=null){
      foreach ( $archivos as $archivo){
          $nombre= $archivo;
          if(is_file("../../archivos/$nombre")){
             array_push($arrayFiles,$archivo);
          }
      }
    }
     // print_r( $arrayFiles);
      return $arrayFiles;
    }
//----------------------------------------------------------------------------------------------   
 
  //para obtener todas las carpetas de un directorio-SE USA EN CONTENIDO.PHP
    public function obtenerCarpetas(){
      $directorio = "../../archivos/";
      $archivos = scandir($directorio);
      $arrayCarpetas=[];
      if($archivos!=null){
       foreach ( $archivos as $archivo){
        $nombre= $archivo;
            if(is_dir("../../archivos/$nombre")){
              array_push($arrayCarpetas,$archivo);
            }
       }
      }
     // print_r( $arrayCarpetas);
     return $arrayCarpetas;
    }
//----------------------------------------------------------------------------------------------  
//para eliminar archivo- SE USA EN ELIMINARARCHIVO.PHP
/*public function eliminarArchivo($datos){
  $arrayDatos= [];
  $usuario= $datos["usuario"];
  $motivo= $datos["descripcionelim"];
  $nombre= $datos["nomarchivoE"];
  $directorio = "../../archivos/";
      $archivos = scandir($directorio);
      $i=0;
      while($i< count($archivos)&& $resp){
        if($archivos[$i]==$nombre){
        $eliminado = $directorio.$nombre;
        //Usar un file_exists($ruta) antes del unlink, no? Para que no se cuelgue
        //is_writable($ruta) te devuelve también si se puede borrar, no?
        //No sé si el permiso de modificar y borrar es el mismo
        //Dice un comentario en la documentación, que retorna falso si no existe el archivo
        $resp= unlink($eliminado);
        $i++;
      }
       if($resp){ 
         $mensaje="se eliminó el archivo";
       }
  
  else{
    $mensaje="No se encontró el archivo a eliminar";
      }
  }
  $arrayDatos=[$mensaje,$usuario,$nombre, $motivo];
  return $arrayDatos;
}*/
//----------------------------------------------------------------------------------------------  
//para subir archivo- SE USA EN AMARCHIVO.PHP
  public function subirArchivo($datos){
  // Definimos Directorio donde se guarda el archivo
   $dir = "../../archivos/";
   $arrayDatosArchivo= [];
  // Comprobamos que no se hayan producido errores
  if ($_FILES['archivo']["error"] <= 0) {
      $nombreArchivo= $_FILES['archivo']['name']  ;
      $tipoArchivo= $_FILES['archivo']['type'] ;
      $tamañoArchivo= ($_FILES['archivo']["size"] / 1024);
      $carpetaTemporalArchivo= $_FILES['archivo']['tmp_name'];
      $linkDescarga="No hay link disponible";
      
      //Verificaciones pedidas en el ejercicio deducidas por el tipo de archivo posible de seleccionar 
            if($tipoArchivo=="application/pdf" ||$tipoArchivo== "application/msword"||$tipoArchivo== "image/jpeg" ||$tipoArchivo== "application/vnd.openxmlformats-officedocument.wordprocessingml.document"||
            $tipoArchivo== " application/x-zip-compressed"||$tipoArchivo== "application/x-zip-compressed"||$tipoArchivo== "application/vnd.ms-excel"||$tipoArchivo== " application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
      // Intentamos copiar el archivo al servidor.
      if (!copy($_FILES['archivo']['tmp_name'], $dir.$_FILES['archivo']['name'])) {
          $mensaje= "ERROR: no se pudo cargar el archivo";
           }
      else{
          $mensaje= "El archivo ".$nombreArchivo." se ha copiado con éxito <br />";
          $linkDescarga=$dir.$_FILES["archivo"]["name"];
      }
  }
  else{
     
      $mensaje= "ERROR: no se pudo cargar el archivo porque no es del tipo permitido";
  }
  
}
  else{
      $mensaje= "ERROR: no se pudo cargar el archivo. No se pudo acceder al archivo Temporal";
      }
      $cargadoPor=$datos["usuario"];
      $descripcion=$datos["editor1"];
      $arrayDatosArchivo= [$nombreArchivo,$tipoArchivo,$tamañoArchivo,$carpetaTemporalArchivo,$mensaje,$linkDescarga, $cargadoPor,$descripcion];
return $arrayDatosArchivo;

} 
//para cargar datos modficados de archivo- SE USA EN AMARCHIVO
public function modificarArchivo($datos){
  $arrayModificado=[];

  $nombreArchivo= $datos['nombrearchivo'];
  $tipoArchivo= $datos['tipoarchivo'];
  $cargadoPor=$datos["usuario"];
  $descripcion=$datos["editor1"];
  $mensaje="Los datos se han modificado correctamente";
  $arrayModificado= [$nombreArchivo,$tipoArchivo,$mensaje, $cargadoPor,$descripcion];
return $arrayModificado;
}

// Creamos un directorio o carpeta 
public function crearCarpeta($datos){
    $directorio="../../archivos/";
    $nombre= $datos["nombreCarpetaNueva"];
    $resp= "";
    $carpetaNueva = mkdir($directorio.$nombre, 0777);
    if($carpetaNueva){
        $resp= "se creó correctamente.";
    }
    else{
        $resp= "lamentablemente no se pudo crear.";
    }
 
return $resp;
}
}            

?>