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
            //creo obj usuario
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param['idusuario']); 
            $objUsuario->cargar();

           $obj->setear($param['idarchivocargado'], $param['acnombre'], $param['acdescripcion'], $param['acicono'], $objUsuario,
             $param['aclinkacceso'], $param['accantidaddescarga'], $param['accantidadusada'], $param['acfechainiciocompartir'], $param['acefechafincompartir'], $param['acprotegidoclave']);
        }
        return $obj;
    }
   /*-------------------------------------CARGAR SOLO CON LA CLAVE---------------------------------------*/
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
  
     /*--------------------------------------CHEQUEO CLAVES SETEADAS----------------------------------------------*/
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
 
    

    /****************************************************************************************************************** */
    /*------------------------------------FUNCIONES PARA DAR DE  ALTA UN ARCHIVO----------------------------------------*/
    /** 
     * Sube el archivo a ambas tablas: archivocargado y archivocargadoestado
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
    /*----------------------------------------altaArchivocargadoEstado-------------------------------------------------------------*/ 
    /**
     * Carga en tabla archivoscargadosestado un objeto a partir de un array 
     * de datos pasado por parámetro- $datos==los datos que llegan de amarchivo
     * 
     * @param array $datos
     * @return boolean
     */
    public function altaArchivocargadoEstado($datos){
        //print_r($datos);
        /*Array ( [acnombre] => horario 2020.xlsx [diascompartido] => null 
        [accantidaddescarga] => null [idusuario] => 2 [acprotegidoclave] => null 
        [aclinkacceso] => -1001055095 [idarchivocargado] => 94 
        [clave] => 3 [descripcion] => Esta es una descripción genérica, si quiere puede cambiarla
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
         $datosEstado= ['idarchivocargadoestado'=>"", 'idestadotipos'=>$idEstadoTipo, 'acedescripcion'=>$descrip,
        'idusuario'=>$datos['idusuario'], 'acefechaingreso'=>$fechahoy,'acefechafin'=>NULL,
        'idarchivocargado'=>$datos['idarchivocargado']];
        //print_r($datosEstado);
        $objEstado= new AbmArchivoCargadoEstado();
        if($objEstado->alta($datosEstado)){
           $resp =true; 
        };
       return $resp;              
       }
      
     //-------------------------------------------------subirArchivo--------------------------------------------------------------  
     
    /**
     * Para subir archivo- SE USA EN AMARCHIVO.PHP
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
    
    //Verificaciones pedidas en el ejercicio deducidas por el tipo de archivo posible de seleccionar 
              if($tipoArchivo=="application/pdf" ||$tipoArchivo== "application/msword"||$tipoArchivo== "image/jpeg" ||$tipoArchivo== "application/vnd.openxmlformats-officedocument.wordprocessingml.document"||
              $tipoArchivo== " application/x-zip-compressed"||$tipoArchivo== "application/x-zip-compressed"||$tipoArchivo== "application/vnd.ms-excel"||$tipoArchivo== " application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
    // Intentamos copiar el archivo al servidor.
        if (!copy($_FILES['archivo']['tmp_name'], $dir.$_FILES['archivo']['name'])) {
            $mensaje= "ERROR: no se pudo cargar el archivo";
            $resp=true; }
        else{
            $mensaje= "El archivo ".$nombreArchivo." se ha copiado con éxito <br />";
            
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
  /*-------------------------------********* ALTA ARCHIVO NUEVO *********---------------------------------------*/
    /**
     * Combina todas:
     * Debe subir el archivo seleccionado a la carpeta de archivos, 
     * agregar el alta en la base de datos de "archivocargado" y 
     * agregar el alta en la base de datos de "archivocargadoestado"
     * 
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
    /**
     * Calcula la cantidad de dias que se compartirá par setear fecha fin compartir
     * arma un array con los datos nuevos, carga un obj y lo modifica en la base de datos
     * setea fecha final en el archivocargadoestado que venía teniendo
     * crea un nuevo obj archivocargadoestado con los datos actuales y lo sube a la base de datos
     * 
     * @param array $datos
     * @return boolean
     */
    public function compartirArchivo($datos){
        
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
 /*----------------------------------ELIMINAR -BORRADO LÓGICO---------------------------------------------------------*/
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
            
            //setear fecha fin en archivocargadoestado anterior
            $archivocargadoEstado= new AbmArchivoCargadoEstado;
            $resp= $archivocargadoEstado->setearfechafin($param);
            //hacer nueva tupla de archivocargadoestado con datos nuevos
            $resp= $this->altaArchivocargadoEstado($param);
        }
               
            }
        }
        return $resp;
  
}
/*----------------------------------DEJAR DE COMPARTIR ARCHIVO---------------------------------------------------------*/
  /**
     * Permite buscar un objeto Y CAMBIAR SU ESTADO NO COMPARTIDO
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
     * Permite SACAR DE COMPARTIDOS a los objetos que pasaron la fecha de compartir.
     * Se acciona cuando se carga la lista de compartidos
     * @param array 
     * @return boolean
     */
    public function chequearCaducidadCompartir(){
        $objAbmArchivoCargadoEstado= new AbmArchivoCargadoEstado;
       //traigo todos los objetoscargadoEstado que tegan estado 2(- estado compartido)
        $datos=['idestadotipos'=> 2];
        $arrayobjEstadoCompartido = $objAbmArchivoCargadoEstado->buscar($datos);
        if(count($arrayobjEstadoCompartido)>0){
      
        //busco todos los archivos cargados
        $arrayArchivoscargados= $this ->buscar(null);
        if(count($arrayArchivoscargados)>0){
      // seleccionar los archivos que tienen estadoarchivocargado compartido
      $archivosCompartidos=[];
      foreach ($arrayobjEstadoCompartido as $objEstadoCompartido) {
         $i = 0;
         while ($i < count($arrayArchivoscargados)) {
           if ($objEstadoCompartido->getObjarchivocargado()->getACId() == $arrayArchivoscargados[$i]-> getACId()){
               array_push( $archivosCompartidos,$arrayArchivoscargados[$i]);
                }
                $i++;
            }
        }
        //print_r($archivosCompartidos);
        if($archivosCompartidos!=""){
        foreach ($archivosCompartidos as $archivo){
            $fechaFinCompartir=($archivo->getACfechaFinCom());
            if ($fechaFinCompartir!="0000-00-00 00:00:00"){
                $fecha_hoy=strtotime(date("Y-m-d h:i:s",time()));
                $fecha_fin = strtotime($fechaFinCompartir);
                    
                if( $fecha_fin < $fecha_hoy ){
                    echo "venció";
                $arraydatos= ['idarchivocargado'=>$archivo->getACId(),'idusuario'=>$archivo->getObjUsuario()->getIdusuario(),'clave'=>4];
                 $this-> dejardeCompartir($arraydatos);
                }
            }
        }
    }
}
      }
    }


 /*-------------------------------------PASAR A USUARIO LINK DE DESCARGA DE ARCHIVO-----------------*/
   /**
    * 
     * Controla que el hash exista en base de datos.
     * controla que al archivo esté compartido( idestadotipo ==2)
     * controla que la cantidad de descargas que quedn sea > 0( if( accantidaddescarga !=0){if (accantidadusada < accantidaddescarga){$resp=true}})
     * controla que la fecha fin de descarga sea menor o igual a hoy)
     * Se acciona cuando se carga la lista de compartidos
     * @param array 
     * @return string
     */
    public function pasarlink($datos){
        $this->chequearCaducidadCompartir();
         $resp=false;
        $link="No hay archivo para descargar";
        $hash= $datos['codigodescarga'];
        //Controla que el hash exista en base de datos.
        if($hash!=""&& $hash!=0 && $hash!=null){
            $dato=['aclinkacceso'=>$hash];
            //busco el archivo compartido con ese hash- me trae array de un solo dato que es el archivo
            $archivosCompartidos=[];
            $archivosCompartidos= $this->buscar($dato);
            if(count($archivosCompartidos)<=0){
                $link=$link." El código no es válido.";
            }
            else{
            $archivoCompartido=$archivosCompartidos[0];

            //verifico que el estado actual del archivo sea compartido
           $archivoCargadoEstado= new AbmArchivoCargadoEstado;
           $datoIdArchivo=['idarchivocargado' =>$archivoCompartido-> getACId()];
           //traigo todos los estados que tiene ese archivo por su idarchivocargado
            $estadosArchivo=  $archivoCargadoEstado->buscar($datoIdArchivo);
           // print_r($estadosArchivo);
            //busco si $archivoCompartido tiene estado compartido y está activo
            if($archivoCargadoEstado->ActivoYCompartido($estadosArchivo)){
           
             //chequeo si cant de descargas es igual a cero no tiene limite
             if($archivoCompartido->getACCantDesc()==0){
                $cantUsada= $archivoCompartido->getACCantUsada()+1;
                $archivoCompartido->setACCantUsada($cantUsada);
                $archivoCompartido->modificar();
                $resp= true;
            }
             //chequeo que si la cantidad de descargas está seteada sea mayor a cantidad usada
            elseif($archivoCompartido->getACCantDesc()>0){
                //chequeo que queden descargas disponibles
                 if($archivoCompartido->getACCantDesc() > $archivoCompartido->getACCantUsada()){
                    $resp= true;
                    $cantUsada= $archivoCompartido->getACCantUsada()+1;
                    $archivoCompartido->setACCantUsada($cantUsada);
                    $archivoCompartido->modificar();
                    }
                    else{    
                        $resp= false;
                        $link=$link. " Se completó la cantidad de descargas posibles";
                        //saco de compartidos el archivo proque no tiene mas descargas posibles  
                        $arraydatos= ['idarchivocargado'=>$archivoCompartido->getACId(),'idusuario'=>$archivoCompartido->getObjUsuario()->getIdUsuario(),'clave'=>4];
                            if($arraydatos!="")  { 
                                $this-> dejardeCompartir($arraydatos);
                            }
                        }
                 
            }
            }
            
                   }
                }
            
                    
        if($resp==true){
            $nombreArchivo= $archivoCompartido->getACNombre();
                  
            $link="http://localhost/progwebdin/2733fidrive/archivos/". $nombreArchivo."";
        }
       
     return $link;
    }
}
