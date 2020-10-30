<?php 
class EstadoTipos {
/*-----------ATRIBUTOS----------------------*/
    private $idestadotipos;
    private $etdescripcion;
    private $etactivo;
    private $mensajeoperacion;

/*-------------CONSTRUCTOR-------------------*/   
    public function __construct(){
        
        $this->idestadotipos="";
        $this->etdescripcion="Cargado en base de datos";
        $this->etactivo =1;
        $this->mensajeoperacion ="";
    }
   
/*------------------METODOS GETTERS --------------------*/
   /**
     * @return string
     */
    public function getIdestadotipos()
    {
        return $this->idestadotipos;
    }

    /**
     * @return string
     */
    public function getEtdescripcion()
    {
        return $this->etdescripcion;
    }

    /**
     * @return string
     */
    public function getEtactivo()
    {
        return $this->etactivo;
    }

    /**
     * @return string
     */
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
/*---------------------------METODOS SETTERS--------------------------------------*/
    /**
     * @param string $idestadotipos
     */
    public function setIdestadotipos($idestadotipos)
    {
        $this->idestadotipos = $idestadotipos;
    }

    /**
     * @param string $etdescripcion
     */
    public function setEtdescripcion($etdescripcion)
    {
        $this->etdescripcion = $etdescripcion;
    }

    /**
     * @param string $etactivo
     */
    public function setEtactivo($etactivo)
    {
        $this->etactivo = $etactivo;
    }

    /**
     * @param string $mensajeoperacion
     */
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

/*-------------SETEAR CON TODOS LOS DATOS------------------*/
     public function setear($idestadotipos, $etdescripcion,$etactivo)    {
        $this->setIdestadotipos($idestadotipos);
        $this->setEtdescripcion($etdescripcion);
        $this->setEtactivo($etactivo);
       
        }
/*----------------------CARGAR -----------------------------*/
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM estadotipos WHERE idestadotipos = ".$this->getIdestadotipos();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idestadotipos'],$row['etdescripcion'],$row['etactivo']);
                }
            }  
        } else {
            $this->setmensajeoperacion("EstadoTipos->listar: ".$base->getError());
        }
        return $resp;  
    }

/*------------------------INSERTAR----------------------------------------*/
    public function insertar(){
        $resp = false;
        $base=new BaseDatos(); 
        $sql="INSERT INTO estadotipos (etdescripcion,etactivo)  VALUES ('".$this->getEtdescripcion()."','".$this->getEtactivo()."')";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdestadotipos($elid); 
                $resp = true;
            } else {
                $this->setmensajeoperacion("EstadoTipos->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("EstadoTipos->insertar: ".$base->getError());
        }
        return $resp;
    }
   
/*------------------------MODIFICAR----------------------------------------*/
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE estadotipos SET etdescripcion='".$this->getEtdescripcion()."', etactivo='".$this->getEtactivo()."'WHERE idestadotipos='". $this->getIdestadotipos()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else { 
                
               
                $this->setmensajeoperacion("EstadoTipos->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("EstadoTipos->modificar: ".$base->getError());
        }
        return $resp;
    }
 
/*------------------------ELIMINAR----------------------------------------*/
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM estadotipos WHERE idestadotipos=".$this->getIdestadotipos();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("EstadoTipos->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("EstadoTipos->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
/*------------------------------LISTAR--------------------------------------------*/    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $consultasql="SELECT * FROM estadotipos ";
        if ($parametro!="") {
            $consultasql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($consultasql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new EstadoTipos();
                    
                    $obj->setear($row['idestadotipos'],$row['etdescripcion'],$row['etactivo']);
                    array_push($arreglo, $obj);
                   
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("EstadoTipos->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
    
}


?>