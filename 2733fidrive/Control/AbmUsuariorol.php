<?php
class AbmUsuariorol{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuariorol
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idusuario',$param) and array_key_exists('idrol',$param) )
        {
           
            $objusuario= new Usuario();
            $objusuario->setIdusuario($param['idusuario']); 
            $objusuario->cargar();

            $objrol= new Rol();
            $objrol->setIdrol($param['idrol']); 
            $objrol->cargar();

            $obj = new Usuariorol();
            $obj->setear($objusuario, $objrol);
        }
        return $obj;
    }
    
    /*-------------------------------------CARGAR SOLO CON LA CLAVE---------------------------------------*/
    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuariorol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['patente']) ){
            $obj = new Usuariorol();
            $obj->setear($param['patente'], null, null, null);
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
        if (isset($param['idusuario']) && isset($param['idrol']))
            $resp = true;
        return $resp;
    }
 
       /*------------------------------------INSERTAR EN BASE DE DATOS-----------------------------------------------*/
    /**
     * Carga un objeto con los datos pasados por parámetro y lo 
     * Inserta en la base de datos
     * @param array $param= idusuario/idrol
     * @return boolean
     */
    public function alta($param){
       // print_r($param);
        $resp = false;
       //Creo objeto con los datos
        $elObj = $this->cargarObjeto($param);
        //print_r($elObjtArchivo);
        //Verifico que el objeto no sea nulo y lo inserto en BD 
        if ($elObj!=null and $elObj->insertar()){
           $resp=true;
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
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtArchivoE = $this->cargarObjetoConClave($param);
            if ($elObjtArchivoE!=null and $elObjtArchivoE->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    //COMENTARIO: NO EXISTE FUNCION MODIFICACION PORQUE TODOS LOS DATOS SON CLAVE PRIMARIA DE OTRA TABLA
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
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
            if  (isset($param['idrol']))
                $where.=" and idrol =".$param['idrol'];
            
        }
        $arreglo = Usuariorol::listar($where);  
        return $arreglo;
        }
  
    /*------------------------------------LISTAR ROLES DE UN USUARIO-------------------------------------*/ 
     /** 
     * Busca todos los usuariorol correspondientes a un objusuario
     * lista todos los roles que tiene el usuario
     * @param object
     * @return array devuelve las descripciones de cada rol de dicho usuario
     */
    public function buscarRolesUsuario($elObjtUsuario){
     $listaUsRol= [];
     //listo todos los obj usuariorol
     $listaUsRol= $this->buscar(null);
     //print_r($listaUsRol);
     if($listaUsRol!=""){
        $roles=[]; 
        //agrego todos los roles que tenga el usuario en el array $roles
        foreach ($listaUsRol as $usuariorol){
            if($usuariorol->getOBJusuario()->getIdusuario() == $elObjtUsuario->getIdusuario()){
               $roldescrip=$usuariorol->getOBJrol()->getRodescripcion();
               array_push ($roles, $roldescrip);     
             
              }
        } 
        }
        return $roles;
    }
 
}
  ?>
