<?php
class AbmEstadoTipos{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return EstadoTipos
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idestadotipos',$param) and array_key_exists('etdescripcion',$param) 
        and array_key_exists('etactivo',$param)){
            $obj = new EstadoTipos();
            $obj->setear($param['idestadotipos'], $param['etdescripcion'], $param['etactivo']);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idestadotipos']) ){
            $obj = new EstadoTipos();
            $obj->setear($param['idestadotipos'], null, null);
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idestadotipos']))
            $resp = true;
        return $resp;
    }
    
    /*---------------------------------------------------------------------------------------------------*/

    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idestadotipos'] =null;
        $elObjtEstado = $this->cargarObjeto($param);
//        verEstructura($elObjtTabla);
        if ($elObjtEstado!=null and $elObjtEstado->insertar()){
            $resp = true;
        }
        return $resp;
        
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtEstado = $this->cargarObjetoConClave($param);
            if ($elObjtEstado!=null and $elObjtEstado->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtEstado = $this->cargarObjeto($param);
            if($elObjtEstado!=null and $elObjtEstado->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idestadotipos']))
                $where.=" and idestadotipos =".$param['idestadotipos'];
            if  (isset($param['etdescripcion']))
                $where.=" and etdescripcion =".$param['etdescripcion'];
            if  (isset($param['etactivo']))
                 $where.=" and etactivo ='".$param['etactivo']."'";
         }
        $arreglo = EstadoTipos::listar($where);  
        return $arreglo;
        
    }
    /*------------------------------------para buscar el estado de un objetoArchivo-------------------*/
    /** devuelve el id del estado correspondiente a la descripcion de estado pasada por parámetro
     * 
     * @param array $param
     */
    public function buscarEstado($datos){
        
        //print_r($datos);   
        $id=null;
        //clave 0 = ALTA
        if($datos['clave']==0){
           $id=1;
       }
       //clave 1 = MODIFICACION (NO TIENE ESTADOTIPO)
        //clave 2 = ELIMINACION
       if($datos['clave']==2){
        $id=4;
       }
        //clave 3 = COMPARTIR
       if($datos['clave']==3){
        $id=2;
       }            
        //clave 4 = DEJAR DE COMPARTIR ARCHIVO
        if($datos['clave']==4){
            $id=3;
           } 
       
     $arrayEstados= $this->buscar(null);
     //print_r($arrayEstados);
       if($arrayEstados!=null){
           $idEstadoTipoDelArchivo="";
           $i=0;
           do{
            if($arrayEstados[$i]->getIdestadotipos()==$id){
                $idEstadoTipoDelArchivo = $arrayEstados[$i]->getIdestadotipos();
            }
            $i++;
           }
           while($i< count($arrayEstados) && $arrayEstados[$i]->getIdestadotipos()!=$id);
       }
       //echo $idEstadoTipoDelArchivo;
       return $idEstadoTipoDelArchivo;
   }
    
}
?>