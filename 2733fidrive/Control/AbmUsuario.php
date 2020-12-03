<?php
class AbmUsuario{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * Devuelve un objeto
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idusuario',$param) and array_key_exists('usnombre',$param) 
        and array_key_exists('usapellido',$param)and array_key_exists('uslogin',$param)
        and array_key_exists('usclave',$param) and array_key_exists('usactivo',$param)){
            $obj = new Usuario();
            $obj->setear($param['idusuario'], $param['usnombre'], $param['usapellido'], $param['uslogin'],
             $param['usclave'], $param['usactivo']);
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
        
        if( isset($param['idusuario']) ){
            $obj = new Usuario();
            $obj->setear($param['idusuario'], null, null, null, null, null);
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
        if (isset($param['idusuario']))
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
        $param['idusuario'] =null;
        $elObjtUsuario = $this->cargarObjeto($param);
        //Verifico que el objeto no sea nulo y lo inserto en BD 
        if ($elObjtUsuario!=null and $elObjtUsuario->insertar()){
            //Recupero id nueva del objeto insertado
            $param['idusuario'] = $elObjtUsuario->getIdusuario();
            $resp= $this->altaUsuarioRolIngresante($param);
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
   /* public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtUsuario = $this->cargarObjetoConClave($param);
            if ($elObjtUsuario!=null and $elObjtUsuario->eliminar()){
                $resp = true;
            }
        }
     return $resp;
    }*/
    
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
            $elObjtUsuario = $this->cargarObjeto($param);
            if($elObjtUsuario!=null and $elObjtUsuario->modificar()){
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
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
            if  (isset($param['usnombre']))
                $where.=" and usnombre =".$param['usnombre'];
            if  (isset($param['usapellido']))
                 $where.=" and usapellido ='".$param['usapellido']."'";
            if  (isset($param['uslogin']))
                 $where.=" and uslogin ='".$param['uslogin']."'";
            if  (isset($param['usclave']))
                 $where.=" and usclave ='".$param['usclave']."'";
            if  (isset($param['usactivo']))
                 $where.=" and usactivo ='".$param['usactivo']."'";
        }
        $arreglo = Usuario::listar($where);  
        return $arreglo;
       
    }

    /*-------------------------------------********* LISTAR USUARIOS ACTIVOS *********------------------------------------*/ 
    /**
     * busca todos los usuarios
     * Filtra los activos
     * Busca los roles que tienen esos usuarios activos
     *
     * @return array multidimensional con arrays de objusuario/ array con sus roles
     */
    public function listarUsuarios(){
        $listaActivos=[];
        $listaUsuarios = $this->buscar(null);
        if(count($listaUsuarios)>0){
        foreach ($listaUsuarios as $usuario){
            if($usuario->getUsactivo()==1){
               $roles=[];
               // $datosUSuario va a guardar un obj usuario y un array de roles de dicho usuario
               $datosUsuario=[];
                $usuarioRol= new AbmUsuariorol();
                $roles=$usuarioRol->buscarRolesUsuario($usuario);
                array_push($datosUsuario,$usuario);
                array_push($datosUsuario,$roles);
                array_push($listaActivos, $datosUsuario);
            }
        }
    }
        return $listaActivos;
    }

    /********************************* FUNCIONES PARA ALTA NUEVO USUARIO ****************************************/
    
    //----------------------------------noExisteUsuario--------------------------------------------
    /**
     * Debe verificar  que el usuario NO exista en base de datos
     * @param array $datos
     * @return boolean
     */
    public function noExisteUsuario($datos){
        //print_r($datos);
        $listaUsuarios = $this->buscar(null);
      //print_r($listaUsuarios);
            $resp=true;  
       if($listaUsuarios!=""){
            
            $i=0;
            do{
                $login=$listaUsuarios[$i]->getUslogin();
                if($login== $datos["uslogin"]){
                   $resp=false;
                }
                $i ++;
            } while ($i< count($listaUsuarios) && $resp==true);
           
        }
        return $resp; 
    }
   
    //-------------------------------------------altaUsuarioRolIngresante--------------------------------------------------------------------    
    //
     /**
     * instancia un objeto de la clase usuariorol donde 
     * se le asigna un rol al usuario NUEVO que por defecto será visitante
     * @param array $datos
     * @return boolean
     */
    public function altaUsuarioRolIngresante($datos){
        $resp= false;
   
        $usuarioRol= new AbmUsuariorol();
        $param= ['idusuario'=>$datos['idusuario'],'idrol'=> 2];
        if($usuarioRol->alta($param)){
            $resp=true;
        }
    
        return $resp;
     }
           
    //--------------------------------------------altaUsuarioRolExistente-------------------------------------------------------------------    
    /**
     * Instancia un objeto de la clase usuariorol donde se le asigna un NUEVO rol a 
     * un usuario existente,se usa en ActualizarLogin.php
     *
     * @param array $datos array de dayos de todo el obj usuario + nuevoRol
     * @return boolean
     */
    public function altaUsuarioRolExistente($datos){
        $resp= false;
            
        $usuarioRol= new AbmUsuariorol();
        $param= ['idusuario'=>$datos['idusuario'],'idrol'=> $datos['nuevoRol']];
            if($usuarioRol->alta($param)){
                $resp=true;
           }
        return $resp;
     }
    
  /*-------------------------------********* ALTA NUEVO USUARIO *********---------------------------------------*/
    /**
     * Combina todas:
     * Chequea que no exista 
     * Lo da de alta
     * @param array $datos
     * @return boolean
     */
    public function altaNuevoUsuario($datos){
        $resp=false;
        
        //verifico que el usuario no exista en la base de datos
        if($this->noExisteUsuario($datos)){
         //instancio un objeto con los datos del array y lo cargo a base de datos tabla usuario
            if( $this-> alta($datos)){
                $resp=true;
                 } 
            }
        return $resp;
    }
   
    /*---------------------------********* DEVUELVE EL USUARIO SI EXISTE SINO DEVUELVE OBJ EN NULL *********------------------------------------*/
    /**
     * Debe verificar  que el usuario exista en base de datos
     * SE USA EN ACTIONLOGIN PARA VER SI YA ESTÁ CARGADO EN BASE DE DATOS EL USUARIO
     * 
     * @param array $datos
     * @return boolean
     */
    public function existeUsuario($datos){
        //print_r($datos);
        $listaUsuarios = $this->buscar(null);
      //print_r($listaUsuarios);
       if($listaUsuarios!=""){
        $resp=false;
        $objUsuario=null; 
            $i=0;
            do{
               if(($listaUsuarios[$i]->getUslogin()== $datos["uslogin"]) &&($listaUsuarios[$i]->getUsclave()==$datos["usclave"]) &&($listaUsuarios[$i]->getUsactivo()==1)){
                   
                  $objUsuario=$listaUsuarios[$i];
                  $resp=true;
                  //chequeo que me traiga bien el usuario
                  //print_r($objUsuario);
                }
                $i ++;
            } while ($i< count($listaUsuarios) && $resp==false);
        }
            return $objUsuario; 
        }
    /*---------------------------********* LOGUEAR USUARIO *********------------------------------------*/
    /**
     * Chequea que existe el usuario (usando la funcion existeUsuario)
     * Si existe busca los roles que tiene y los devuelve
     * Luego inicia session (USANDO la funcion iniciarsession que instancia la info)
     * @param array $datos
     * @return boolean
     */
    public function loguearUsuario($datos){
            $resp=false;
          
           $elObjtUsuario= $this-> existeUsuario($datos);
           if ($elObjtUsuario!=null){
               //quiere decir que existe el usuario y ahora hay que averiguar que roles tiene
               //Creo un obj usuariorol
               $usuarioRol= new AbmUsuariorol();
               $roles=$usuarioRol->buscarRolesUsuario($elObjtUsuario);
              
                    //sumo los datos del usuario que quiero pasar a la session
                    //ucwords pone en mayúscula la primera letra de cada palabra una cadena
                    $nombreUsuario= ucwords($elObjtUsuario->getUsnombre()." ".$elObjtUsuario->getUsapellido());
                   // $password= $elObjtUsuario->getUsclave();
                    $datosSession=["roles"=>$roles, "NombreUsuario"=>$nombreUsuario,"login"=>$elObjtUsuario->getUslogin(),"idusuario"=>$elObjtUsuario->getIdusuario() ];
                    //print_r($datosSession);
                }
            
                //creo la session
                 $sesion= new Session();
                if($sesion->iniciarSession($datosSession)){
                     $resp=true;
                    };
                
        return $resp ;
    }

} 

?>