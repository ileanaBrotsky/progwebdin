<?php
class AbmEstadoTipos{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * Devuelve un objeto
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
    
    /*-------------------------------------CARGAR SOLO CON LA CLAVE---------------------------------------*/
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
    
   /*--------------------------------------CHEQUEO CLAVES SETEADAS----------------------------------------------*/
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
    
  /*------------------------------------INSERTAR EN BASE DE DATOS-----------------------------------------------*/
    /**
     * carga un objeto con los datos pasados por parámetro y lo 
     * inserta en la base de datos
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['idestadotipos'] =null;
        $elObjtEstado = $this->cargarObjeto($param);

        if ($elObjtEstado!=null and $elObjtEstado->insertar()){
            $resp = true;
        }
        return $resp;
    }

     /*--------------------------------ELIMINA OBJETO DE BASE DE DATOS--------------------------------------------*/
    /**
     * Por lo general no se usa ya que se utiliza borrado lógico ( es decir pasar de activo a inactivo)
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
    
    /*----------------------------------MODIFICA EN BASE DE DATOS ------------------------------------------*/
    /**
     * Carga un obj con los datos pasados por parámetro y lo modifica en base de datos (update)
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
    
    /*--------------------------BUSCAR OBJ EN BASE DE DATOS--------------------------------------------------*/
    /**
     * Puede traer un obj específico o toda la lista si el parámetro es null
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
 
    
    
}
?>