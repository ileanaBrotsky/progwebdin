<?php 
class ArchivoCargadoEstado {
/*-----------ATRIBUTOS----------------------*/
    private $idarchivocargadoestado;
    private $objestadotipo;//objestadotipo
    private $acedescripcion;
    private $objusuario;//objetousuario
    private $acefechaingreso;
    private $acefechafin;
    private $objarchivocargado;//objetoarchivocargado
    private $mensajeoperacion;

/*-------------CONSTRUCTOR-------------------*/   
    public function __construct(){
        
        $this->idarchivocargadoestado="";
        $this->objestadotipo=new EstadoTipos();
        $this->acedescripcion ="";
        $this->objusuario=new Usuario();
        $this->acefechaingreso="";
        $this->acefechafin="";
        $this->objarchivocargado =new ArchivoCargado();
        $this->mensajeoperacion ="";
    }
   
/*------------------METODOS GETTERS --------------------*/
  /**
     * @return mixed
     */
    public function getIdarchivocargadoestado()
    {
        return $this->idarchivocargadoestado;
    }

/**
     * @return mixed
     */
    public function getObjestadotipo()
    {
        return $this->objestadotipo;
    }

/**
     * @return mixed
     */
    public function getAcedescripcion()
    {
        return $this->acedescripcion;
    }

/**
     * @return mixed
     */
    public function getObjusuario()
    {
        return $this->objusuario;
    }

/**
     * @return mixed
     */
    public function getAcefechaingreso()
    {
        return $this->acefechaingreso;
    }

/**
     * @return mixed
     */
    public function getAcefechafin()
    {
        return $this->acefechafin;
    }

/**
     * @return mixed
     */
    public function getObjarchivocargado()
    {
        return $this->objarchivocargado;
    }

/**
     * @return mixed
     */
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
/*---------------------------METODOS SETTERS--------------------------------------*/
/**
     * @param mixed $idarchivocargadoestado
     */
    public function setIdarchivocargadoestado($idarchivocargadoestado)
    {
        $this->idarchivocargadoestado = $idarchivocargadoestado;
    }

/**
     * @param mixed $objestadotipo
     */
    public function setObjestadotipo($objestadotipo)
    {
        $this->objestadotipo = $objestadotipo;
    }

/**
     * @param mixed $acedescripcion
     */
    public function setAcedescripcion($acedescripcion)
    {
        $this->acedescripcion = $acedescripcion;
    }

/**
     * @param mixed $objusuario
     */
    public function setObjusuario($objusuario)
    {
        $this->objusuario = $objusuario;
    }

/**
     * @param mixed $acefechaingreso
     */
    public function setAcefechaingreso($acefechaingreso)
    {
        $this->acefechaingreso = $acefechaingreso;
    }

/**
     * @param mixed $acefechafin
     */
    public function setAcefechafin($acefechafin)
    {
        $this->acefechafin = $acefechafin;
    }

/**
     * @param mixed $objarchivocargado
     */
    public function setObjarchivocargado($objarchivocargado)
    {
        $this->objarchivocargado = $objarchivocargado;
    }

/**
     * @param mixed $mensajeoperacion
     */
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }



   
/*-------------SETEAR CON TODOS LOS DATOS------------------*/
     public function setear($idarchivocargadoestado, $objetoestadotipo, $acedescripcion,$objetousuario, $acefechaingreso,
     $acefechafin,$objetoarchivocargado)    {
        $this->setIdarchivocargadoestado($idarchivocargadoestado);
        $this->setObjestadotipo($objetoestadotipo);
        $this->setAcedescripcion($acedescripcion);
        $this->setObjusuario($objetousuario);
        $this->setAcefechaingreso($acefechaingreso);
        $this->setAcefechafin($acefechafin);
        $this->setObjarchivocargado($objetoarchivocargado);
        }
/*-------------------CARGAR --------------------------*/
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM archivocargadoestado WHERE idarchivocargadoestado = ".$this->getIdarchivocargadoestado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                   
                    $objestado = NULL; 
                    if ($row['idestadotipos'] != null) { 
                        $objestado = new Estadotipos(); 
                        $objestado->setIdestadotipos($row['idestadotipos']); 
                        $objestado->cargar(); }
                    $objUsario = NULL; 
                    if ($row['idusuario'] != null) { 
                        $objUsario = new Usuario(); 
                        $objUsario->setIdusuario($row['idusuario']); 
                        $objUsario->cargar(); }
                        $objArchivo = NULL; 
                        if ($row['idarchivocargado'] != null) { 
                            $objArchivo=new ArchivoCargado();
                            $objArchivo->setACId($row['idarchivocargado']); 
                            $objArchivo->cargar(); }
                    
                    
                    $this->setear($row['idarchivocargadoestado'],$row['idestadotipos'],$row['acedescripcion'],
                    $row['idusuario'], $row['acefechaingreso'],
                    $row['acefechafin'],$row['idarchivocargado']);
                }
            }  
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->listar: ".$base->getError());
        }
        return $resp;  
    }

/*------------------------INSERTAR----------------------------------------*/
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO archivocargadoestado (idestadotipos, acedescripcion,idusuario, acefechaingreso, 
        acefechafin,idarchivocargado)  VALUES ('".$this->getObjestadotipo()->getIdestadotipos()."','".$this->getAcedescripcion()."','".$this->getObjusuario()->getIdusuario()."','".$this->getAcefechaingreso()."','".$this->getAcefechafin()."','".$this->getObjarchivocargado()->getACId()."')";
        //echo $sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdarchivocargadoestado($elid); 
                $resp = true;
            } else {
                $this->setmensajeoperacion("ArchivoCargadoEstado->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->insertar: ".$base->getError());
        }
        return $resp;
    }
   
/*------------------------MODIFICAR----------------------------------------*/
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE archivocargadoestado SET idestadotipos='".$this->getObjestadotipo()->getIdestadotipos()."', acedescripcion='".$this->getAcedescripcion()."', idusuario='".$this->getObjusuario()->getIdusuario()."',acefechaingreso='".$this->getAcefechaingreso()."',acefechafin='".$this->getAcefechafin()."',idarchivocargado='".$this->getObjarchivocargado()->getACId()."'WHERE idarchivocargadoestado='". $this->getIdarchivocargadoestado()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else { 
                
               
                $this->setmensajeoperacion("ArchivoCargadoEstado->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->modificar: ".$base->getError());
        }
        return $resp;
    }
 
/*------------------------ELIMINAR-------No se utiliza---------------------------------*/
 /*   public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM archivocargadoestado WHERE idarchivocargadoestado=".$this->getIdarchivocargadoestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("ArchivoCargadoEstado->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->eliminar: ".$base->getError());
        }
        return $resp;
    }*/
/*------------------------------LISTAR--------------------------------------------*/     
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $consultasql="SELECT * FROM archivocargadoestado ";
        if ($parametro!="") {
            $consultasql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($consultasql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new ArchivoCargadoEstado();
                    
                    $objestado = NULL; 
                    if ($row['idestadotipos'] != null) { 
                        $objestado = new Estadotipos(); 
                        $objestado->setIdestadotipos($row['idestadotipos']); 
                        $objestado->cargar(); }
                    $objUsario = NULL; 
                    if ($row['idusuario'] != null) { 
                        $objUsario = new Usuario(); 
                        $objUsario->setIdusuario($row['idusuario']); 
                        $objUsario->cargar(); }
                        $objArchivo = NULL; 
                        if ($row['idarchivocargado'] != null) { 
                            $objArchivo=new ArchivoCargado();
                            $objArchivo->setACId($row['idarchivocargado']); 
                            $objArchivo->cargar(); }

                    $obj->setear($row['idarchivocargadoestado'],$objestado,$row['acedescripcion'],$objUsario, $row['acefechaingreso'],
                    $row['acefechafin'],$objArchivo);
                    array_push($arreglo, $obj);
                   
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("ArchivoCargadoEstado->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
    
}


?>