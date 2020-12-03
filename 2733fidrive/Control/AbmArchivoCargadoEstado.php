<?php
class AbmArchivoCargadoEstado{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * Devuelve un objeto
     * @param array $param
     * @return ArchivoCargadoEstado
     */
    private function cargarObjeto($param){
        //print_r ($param);
        $obj = null;
           
        if( array_key_exists('idarchivocargadoestado',$param) and array_key_exists('idestadotipos',$param) and array_key_exists('acedescripcion',$param)
        and array_key_exists('idusuario',$param)and array_key_exists('acefechaingreso',$param)and array_key_exists('acefechafin',$param)
        and array_key_exists('idarchivocargado',$param)){
            
           //creo objeto estadotipos
            $objEstadoTipo = new EstadoTipos();
            $objEstadoTipo->setIdestadotipos($param['idestadotipos']); 
            $objEstadoTipo->cargar();
          
           //creo objeto usuario
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param['idusuario']); 
            $objUsuario->cargar();
            
            //creo objeto archivocargado
            $objArchivo = new ArchivoCargado();
            $objArchivo->setACId($param['idarchivocargado']); 
            $objArchivo->cargar();
            
            //agregarle los otros objetos
            $obj = new ArchivoCargadoEstado();
            $obj->setear($param['idarchivocargadoestado'], $objEstadoTipo, $param['acedescripcion'], $objUsuario, $param['acefechaingreso'],
             $param['acefechafin'], $objArchivo);
        }
        return $obj;
    }
    /*-------------------------------------CARGAR SOLO CON LA CLAVE---------------------------------------*/
    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return ArchivoCargadoEstado
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idarchivocargadoestado']) ){
            $obj = new ArchivoCargadoEstado();
            $obj->setear($param['idarchivocargadoestado'], null, null, null, null, null, null);
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
        if (isset($param['idarchivocargadoestado']))
            $resp = true;
        return $resp;
    }
    
    /*------------------------------------INSERTAR EN BASE DE DATOS-----------------------------------------------*/
    /**
     * Carga un objeto con los datos pasados por parámetro y lo 
     * Inserta en la base de datos
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['idarchivocargadoestado'] =null;
        $elObjtArchivoE = $this->cargarObjeto($param);
        //print_r($elObjtArchivoE);
        if ($elObjtArchivoE!=null and $elObjtArchivoE->insertar()){
            $resp = true;
        }
        return $resp;
    }

    /*-----------------------------------------ELIMINA OBJETO DE BASE DE DATOS--------------------------------------------*/
    /**
     * Por lo general no se usa ya que se utiliza borrado lógico ( es decir pasar de activo a inactivo)
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
    */
   /* public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtArchivoE = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoE!=null and $elObjtArchivoE->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    } */

    /*----------------------------------------MODIFICA EN BASE DE DATOS ------------------------------------------*/
    /**
     * Carga un obj con los datos pasados por parámetro y lo modifica en base de datos (update)
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtArchivoE = $this->cargarObjeto($param);
            if($elObjtArchivoE!=null and $elObjtArchivoE->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /*-----------------------------------BUSCAR OBJ EN BASE DE DATOS--------------------------------------------------*/
    /**
     * Puede traer un obj específico o toda la lista si el parámetro es null
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idarchivocargadoestado']))
                $where.=" and idarchivocargadoestado =".$param['idarchivocargadoestado'];
            if  (isset($param['idestadotipos']))
                $where.=" and idestadotipos =".$param['idestadotipos'];
            if  (isset($param['acedescripcion']))
                 $where.=" and acedescripcion ='".$param['acedescripcion']."'";
            if  (isset($param['idusuario']))
                 $where.=" and idusuario ='".$param['idusuario']."'";
            if  (isset($param['acefechaingreso']))
                 $where.=" and acefechaingreso ='".$param['acefechaingreso']."'";
            if  (isset($param['acefechafin']))
                 $where.=" and acefechafin ='".$param['acefechafin']."'";
            if  (isset($param['idarchivocargado']))
                 $where.=" and idarchivocargado ='".$param['idarchivocargado']."'";
           
        }
        $arreglo = ArchivoCargadoEstado::listar($where);  
        return $arreglo;
        
    }

     /*------------------------------------FILTRAR LISTA DE ARCHIVOS POR PARAMETRO-------------------------------------------------*/
     /**
     * busca todos los objetos y selecciona los que cumplen la condición
     * pasada por parametro
     * @param array $param que tiene el estado buscado  y el usuario de la session
     * @return array de objcargadoestados 
     */
     public function filtrar($param){
         $archivoscargados= new AbmArchivoCargado;
         $archivoscargados->chequearCaducidadCompartir();
      //print_r($param);
        $listaArchivosE = $this->buscar(null);
       // print_r($listaArchivosE);
        $objetosCargados=[];
        //filtro los archivocargadoEstados que corresponden al parametro y no tienen fecha final
        foreach ($listaArchivosE as $archivoE){
            if((($archivoE->getObjestadotipo()->getIdestadotipos()==$param[0]) || 
            ($archivoE->getObjestadotipo()->getIdestadotipos()==$param[1]))&& 
            ($archivoE->getObjusuario()->getIdusuario()==$param[2])&&
            ($archivoE->getAcefechafin()== "0000-00-00 00:00:00")){
                array_push($objetosCargados,$archivoE);
           }
        }
        // print_r($objetosCargados);
        $objMostrar=[];
         /*Si hay archivos en esa condición */
         if (count($objetosCargados) > 0) {
            //$listaArchivos es el array de todos los archivos cargados con sus datos  
            $objAbmArchivoCargado = new AbmArchivoCargado();
            $listaArchivos = $objAbmArchivoCargado->buscar(null);

            //comparo los ides de ambas tablas para seleccionar solo aquellos archivos que cumplan la condicion del estado
            foreach ($listaArchivos as $objArchivo) {
            $i = 0;
              while ($i < count($objetosCargados)) {
                if ($objArchivo->getACId() == $objetosCargados[$i]->getObjarchivocargado()->getACId()){
                    array_push( $objMostrar,$objArchivo);
                }
                $i++;
            }
        }
       }
      // print_r($objMostrar);
       return $objMostrar;
    }
    
     /*--------------------------------------------CAMBIA FECHA FINAL-------------------------------------------*/
     /**
     * permite setear fechafin 
     * @param array $param
     * @return boolean
     */
    public function setearfechafin($param){
       // print_r($param);
        $resp = false;
        $id= $param['idarchivocargado'];
        $datos=['idarchivocargado'=>$id];
        if (isset($datos['idarchivocargado'])) {
        $archivos= $this-> buscar($datos);
        //print_r($archivos);
        $i=0;
        do{            
            if($archivos[$i]->getAcefechafin()=="0000-00-00 00:00:00"){
            $archivoASetear=$archivos[$i];
            $fechahoy=date("Y-m-d h:i:s"); 
        $archivoASetear->setAcefechafin($fechahoy);
        //print_r($archivoASetear);
        $resp= $archivoASetear->modificar();
            }
            $i++;
        }while ($i< count($archivos));
      }
        return $resp;
    }
    /*-------------------------------------CONTROLA QUE EL ESTADO DE  UN ARCHIVO ESTÉ ACTIVO Y SEA COMPARTIDO-----------------*/
   /**
    * 
     * Recibe como parametro un array de objetos archivoscargadoestado que tienen el mismo idarchivocargado.*/
    public function ActivoYCompartido($estadosArchivo){
        $i=0;
        $resp=false;
        while($i<count($estadosArchivo)&&$resp==false){
            if(($estadosArchivo[$i]->getObjestadotipo()->getIdestadotipos()==2)&&($estadosArchivo[$i]->getAcefechafin()=="0000-00-00 00:00:00")){
                $resp= true;
        }
        $i++;
    }
    return $resp;
    }


}
?>