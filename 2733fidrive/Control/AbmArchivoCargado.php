<?php
class AbmArchivoCargado{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return ArchivoCargado
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idarchivocargado',$param) and array_key_exists('acnombre',$param) and array_key_exists('acdescripcion',$param)
        and array_key_exists('acicono',$param)and array_key_exists('idusuario',$param)and array_key_exists('aclinkacceso',$param)
        and array_key_exists('accantidaddescarga',$param)and array_key_exists('accantidadusada',$param)and array_key_exists('acfechainiciocompartir',$param)
        and array_key_exists('acefechafincompartir',$param)and array_key_exists('acprotegidoclave',$param)){
            $obj = new ArchivoCargado();
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param['idusuario']); 
            $objUsuario->cargar();

           $obj->setear($param['idarchivocargado'], $param['acnombre'], $param['acdescripcion'], $param['acicono'], $objUsuario,
             $param['aclinkacceso'], $param['accantidaddescarga'], $param['accantidadusada'], $param['acfechainiciocompartir'], $param['acefechafincompartir'], $param['acprotegidoclave']);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return ArchivoCargado
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idarchivocargado']) ){
            $obj = new ArchivoCargado();
            $obj->setear($param['idarchivocargado'], null, null, null, null, null, null, null, null, null, null);
        }
        return $obj;
    }
  
    /*------------------------------------------------------------------------------------------*/
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idarchivocargado']))
            $resp = true;
        return $resp;
    }
 
    


    /*------------------------------------FUNCIONES PARA DAR DE  ALTA UN ARCHIVO----------------------------------------*/
    /** sube el archivo a ambas tablas: archivocargado y archivocargadoestado
     * 
     * @param array $param
     * @return boolean
     */
    public function alta($param){
       // print_r($param);
        $resp = false;
        $param['idarchivocargado'] =null;
        //Creo objeto con los datos
        $elObjtArchivo = $this->cargarObjeto($param);
        //print_r($elObjtArchivo);
        //Verifico que el objeto no sea nulo y lo inserto en BD 
        if ($elObjtArchivo!=null and $elObjtArchivo->insertar()){
            //Recupero id nueva del objeto insertado
            $param['idarchivocargado'] = $elObjtArchivo->getACId();
            //Cargo datos en tabla archivocargadoestado
            $resp= $this->altaArchivocargadoEstado($param);
        }
        return $resp;
     }
    /*---------------------------------------------------------------*/ 
    //carga en tabla archivoscargadosestado un objeto a partir de un array de datos pasado por parámetro- $datos==los datos que llegan de amarchivo
   /**
     * permite eliminar un objeto 
     * @param array $datos
     * @return boolean
     */
        public function altaArchivocargadoEstado($datos){
        //print_r($datos);
        /*Array ( [acnombre] => horario 2020.xlsx [diascompartido] => null [accantidaddescarga] => null [idusuario] => 2 [acprotegidoclave] => null [aclinkacceso] => -1001055095 [idarchivocargado] => 94 [clave] => 3 [descripcion] =>
        Esta es una desccripción genérica, si quiere puede cambiarla
        [acicono] => XLS*/
        $resp=false;
        $fechahoy=date("Y-m-d h:i:s");
       
        if( $datos['clave']== 0){
            $idEstadoTipo=1;
            $descrip= "Archivo Cargado";
        }
        if( $datos['clave']== 2){
            $idEstadoTipo=4;
            $descrip= "Archivo Eliminado";
        }
        if( $datos['clave']== 3){
            $idEstadoTipo=2;
            $descrip= "Archivo Compartido";
        }
        if( $datos['clave']== 4){
            $idEstadoTipo=3;
            $descrip= "Archivo No compartido";
        }
       
        
        
        $datosEstado= ['idarchivocargadoestado'=>"", 'idestadotipos'=>$idEstadoTipo, 'acedescripcion'=>$descrip,'idusuario'=>$datos['idusuario'], 'acefechaingreso'=>$fechahoy,'acefechafin'=>NULL,'idarchivocargado'=>$datos['idarchivocargado']];
        //print_r($datosEstado);
        $objEstado= new AbmArchivoCargadoEstado();
        if($objEstado->alta($datosEstado)){
           $resp =true; 
        };
       return $resp;              
       }
      
     //----------------------------------------------------------------------------------------------  
     //para subir archivo- SE USA EN AMARCHIVO.PHP
    /**
     * permite eliminar un objeto 
     * @param array $datos
     * @return boolean
     */
     public function subirArchivo($datos){
    // Definimos Directorio donde se guarda el archivo
     $dir = "../../archivos/";
     $resp=false;
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
            $resp=true; }
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
        
  return $resp;
  
  } 
  /*---------------------------********* ALTA ARCHIVO NUEVO *********------------------------------------*/
    /*Debe subir el archivo seleccionado a la carpeta de archivos, 
   agregar el alta en la base de datos de "archivocargado" y 
    agregar el alta en la base de datos de "archivocargadoestado"*/
    /**
     * permite eliminar un objeto 
     * @param array $datos
     * @return boolean
     */
    public function ejecutarAlta($datos){
    $resp=false;
      $this-> subirArchivo($datos);
          // print_r($datos);
          

     if( $this-> alta($datos)){
         $resp=true;
           }
       
   return $resp;
}

/*----------------------------------FIN DE FUNCIONES DE ALTA ARCHIVO------------------------------------------*/
/**************************************************************************************************************/

 
   /*---------------------------------------MODIFICAR ARCHIVO CARGADO--------------------------------------*/ 
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtArchivo = $this->cargarObjeto($param);
            //print_r($elObjtArchivo );
            if($elObjtArchivo!=null and $elObjtArchivo->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
   
  
    
   /*--------------------------------------- BUSCAR CON O SIN PARAMETRO UN OBJ--------------------------------------*/ 
   /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idarchivocargado']))
                $where.=" and idarchivocargado =".$param['idarchivocargado'];
            if  (isset($param['acnombre']))
                $where.=" and acnombre =".$param['acnombre'];
            if  (isset($param['acdescripcion']))
                 $where.=" and acdescripcion ='".$param['acdescripcion']."'";
            if  (isset($param['acicono']))
                 $where.=" and acicono ='".$param['acicono']."'";
            if  (isset($param['idusuario']))
                 $where.=" and idusuario ='".$param['idusuario']."'";
            if  (isset($param['aclinkacceso']))
                 $where.=" and aclinkacceso ='".$param['aclinkacceso']."'";
            if  (isset($param['accantidaddescarga']))
                 $where.=" and accantidaddescarga ='".$param['accantidaddescarga']."'";
            if  (isset($param['accantidadusada']))
                 $where.=" and accantidadusada ='".$param['accantidadusada']."'";
            if  (isset($param['acfechainiciocompartir']))
                 $where.=" and acfechainiciocompartir ='".$param['acfechainiciocompartir']."'";
            if  (isset($param['acefechafincompartir']))
                 $where.=" and acefechafincompartir ='".$param['acefechafincompartir']."'";
            if  (isset($param['acprotegidoclave']))
                 $where.=" and acprotegidoclave='".$param['acprotegidoclave']."'";
        }
        $arreglo = ArchivoCargado::listar($where);  
        return $arreglo;
        }
 /**************************************************************************************************************/ 
 /*----------------------------------COMPARTIR ARCHIVO---------------------------------------------------------*/
    public function compartirArchivo($datos){
        //echo "estoy en compartirarchivo";
        //print_r($datos);
        $resp= false;
        $fechahoy=date("Y-m-d h:i:s");
        //sumo cantidad de dias que se compartira para encontrar fecha final de compartir.
        $diascompartido= $datos['diascompartido'];
        if($diascompartido!=""){
            $fechafin=  date("Y-m-d h:i:s",strtotime($fechahoy."+ ".$diascompartido." days")); 
    }
    else{
      
        $fechafin=$datos['diascompartido'];
    }
        //cargo todos los datos necesarios para el objeto en el array
        $datosArchivo=['idarchivocargado'=>$datos['idarchivocargado'],'acnombre'=>$datos['acnombre'],'acdescripcion'=>$datos['descripcion'],'acicono'=>$datos['acicono'], 'idusuario'=>$datos['idusuario'],
        'aclinkacceso'=> $datos['aclinkacceso'],'accantidaddescarga'=>$datos['accantidaddescarga'],'accantidadusada'=>0,'acfechainiciocompartir'=>$fechahoy, 'acefechafincompartir'=>$fechafin,
        'acprotegidoclave'=>$datos['acprotegidoclave']];
        //instancio un objeto con los datos del array
        $elObjtArchivo = $this->cargarObjeto($datosArchivo);
        //print_r($elObjtArchivo);
         //Modifico objeto en BD
       if( $elObjtArchivo->modificar()){
           $resp=true;
       }
       //setear fecha fin en archivocargadoestado anterior
       $archivocargadoEstado= new AbmArchivoCargadoEstado;
       $resp= $archivocargadoEstado->setearfechafin($datos);
       //hacer nueva tupla de archivocargadoestado con datos nuevos
       $resp= $this->altaArchivocargadoEstado($datos);
 return $resp;
 }
 /**************************************************************************************************************/ 
 /*----------------------------------ELIMINAR ARCHIVO---------------------------------------------------------*/
  /**
     * permite buscar un objeto Y CAMBIAR SU ESTADO A BAJA
     * @param array $param
     * @return boolean
     */
    public function darbaja($param){
        $resp=false;
        $id= $param['idarchivocargado'];
        $descrip=$param['acdescripcion'];
        $usuario=$param['idusuario'];
        $datos=['idarchivocargado'=>$id];
        $objArchivo = NULL;
        if (isset($datos['idarchivocargado'])) {
            $listaArchivos = $this->buscar($datos);
              // print_r($listaArchivos);
            if (count($listaArchivos) == 1) {
                $objArchivo = $listaArchivos[0];
               //  print_r($objArchivo);
               $objArchivo->setACDescrip($descrip);
               $objArchivo->getObjUsuario()->setIdUsuario($usuario);
               if( $objArchivo->modificar()){
                $resp=true;
            }
            //setear fecha fin en archivocargadoestado anterior
            $archivocargadoEstado= new AbmArchivoCargadoEstado;
            $resp= $archivocargadoEstado->setearfechafin($param);
            //hacer nueva tupla de archivocargadoestado con datos nuevos
            $resp= $this->altaArchivocargadoEstado($param);
               
               
            }

        return $resp;

  }
}
/*----------------------------------DEJAR DE COMPARTIR ARCHIVO---------------------------------------------------------*/
  /**
     * permite buscar un objeto Y CAMBIAR SU ESTADO NO COMPARTIDO
     * @param array $param
     * @return boolean
     */
    public function dejardeCompartir($param){
        //print_r($param);
        $resp=false;
        //setear fecha fin en archivocargadoestado anterior
        $archivocargadoEstado= new AbmArchivoCargadoEstado;
        $resp= $archivocargadoEstado->setearfechafin($param);
         //hacer nueva tupla de archivocargadoestado con datos nuevos
        if($this->altaArchivocargadoEstado($param)){
                $resp=True;
            }
        return $resp;
            }
      

  
  /*-------------------------------------CONTROLA CADUCIDAD DE COMPARTIR-----------------*/
   /**
     * permite SACAR DE COMPARTIDOS a los objetos que pasaron la fecha de compartir.
     * @param array 
     * @return boolean
     */
    public function chequearCaducidadCompartir(){
        //traigo todos los objetos- estado compartido
        $objAbmArchivoCargadoEstado= new AbmArchivoCargadoEstado;
        $ide=[2, ""];
        $arrayobjEstadoCompartido = $objAbmArchivoCargadoEstado->filtrar($ide);
       //busco todos los archivos cargados
        $arrayArchivos= $this ->buscar(null);
      // seleccionar los archivos que estan compartidos
      $archivosCompartidos=[];
      foreach ($arrayobjEstadoCompartido as $objEstado) {
            
        $i = 0;
         while ($i < count($arrayobjEstadoCompartido)) {
           if ($objEstado->getIdarchivocargado() == $arrayArchivos[$i]-> getACId()){
               array_push( $archivosCompartidos,$arrayArchivos[$i]);
           }
           $i++;
       }
   }
if($archivosCompartidos!=""){
        $fechahoy=strtotime(date("Y-m-d h:i:s",time()));

        foreach ($archivosCompartidos as $archivo){
            $fechaFinCompartir=($archivo->getACfechaFinCom());
            if($fechaFinCompartir < $fechahoy){
                echo "ENTREEEEEE";
          $arraydatos= ['idarchivocargado'=>$archivo->getACId(),'idusuario'=>$archivo->getIdUsuario(),'clave'=>4];
          if($arraydatos!="")  { $this-> dejardeCompartir($arraydatos);
          }
           
        }
    
    }
    }
}
}
  ?>
