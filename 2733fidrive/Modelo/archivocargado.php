<?php 
class ArchivoCargado {
/*-----------ATRIBUTOS----------------------*/
    private $idarchivocargado;//se carga en la tabla
    private $acnombre;
    private $acdescripcion;
    private $acicono;
    private $objusuario;//objeto usuario
    private $aclinkacceso;
    private $accantidaddescarga;
    private $accantidadusada;
    private $acfechainiciocompartir;
    private $acefechafincompartir;
    private $acprotegidoclave;
    private $mensajeoperacion;

/*-------------CONSTRUCTOR-------------------*/   
    public function __construct(){
        
        $this->idarchivocargado="";
        $this->acnombre="";
        $this->acdescripcion ="";
        $this->acicono="";
        $this->objusuario=new Usuario();
        $this->aclinkacceso="";
        $this->accantidaddescarga="";
        $this->accantidadusada ="";
        $this->acfechainiciocompartir="";
        $this->acefechafincompartir="";
        $this->acprotegidoclave="";
        $this->mensajeoperacion ="";
    }
   
/*------------------METODOS GETTERS --------------------*/
    public function getACId(){
        return $this->idarchivocargado;
    }
    public function getACNombre(){
        return $this->acnombre;
    }
    public function getACDescrip(){
        return $this->acdescripcion;
    }
    public function getACIcono(){
        return $this->acicono;
    }
    public function getObjUsuario(){
        return $this->objusuario;
    }
    public function getACLink(){
        return $this->aclinkacceso;
    }
    public function getACCantDesc(){
        return $this->accantidaddescarga;
    }
    public function getACCantUsada(){
        return $this->accantidadusada;
    }
    public function getACfechaInicCom(){
        return $this->acfechainiciocompartir;
    }
    public function getACfechaFinCom(){
        return $this->acefechafincompartir;
    }
    public function getACprotegido(){
        return $this->acprotegidoclave;
    }
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
 /*------------------------METODOS SETTERS--------------------*/
    public function setACId($valor){
        $this->idarchivocargado= $valor;
    }
    public function setACNombre($valor){
        $this->acnombre= $valor;
    }
    public function setACDescrip($valor){
        $this->acdescripcion= $valor;
    }
    public function setACIcono($valor){
        $this->acicono= $valor;
    }
    public function setObjUsuario($valor){
        $this->objusuario= $valor;
    }
    public function setACLink($valor){
        $this->aclinkacceso= $valor;
    }
    public function setACCantDesc($valor){
        $this->accantidaddescarga= $valor;
    }
    public function setACCantUsada($valor){
        $this->accantidadusada= $valor;
    }
    public function setACfechaInicCom($valor){
        $this->acfechainiciocompartir= $valor;
    }
    public function setACfechaFinCom($valor){
        $this->acefechafincompartir= $valor;
    }
    public function setACprotegido($valor){
        $this->acprotegidoclave= $valor;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion= $valor;
    }
  
/*-------------SETEAR CON TODOS LOS DATOS------------------*/
     public function setear($id, $nombre, $descrip,$icono, $objusuario,$link,$cantDesc,$cantUsada,
     $fechaInic,$fechaFin,$protegido )    {
        $this->setACId($id);
        $this->setACNombre($nombre);
        $this->setACDescrip($descrip);
        $this->setACIcono($icono);
        $this->setObjUsuario($objusuario);
        $this->setACLink($link);
        $this->setACCantDesc($cantDesc);
        $this->setACCantUsada($cantUsada);
        $this->setACfechaInicCom($fechaInic);
        $this->setACfechaFinCom($fechaFin);
        $this->setACprotegido($protegido);
    }
/*-------------------CARGAR --------------------------*/
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM archivocargado WHERE idarchivocargado = ".$this->getACId();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    
                    $row = $base->Registro();

                    $objUsario = NULL; 
                    if ($row['idusuario'] != null) { 
                        $objUsario = new Usuario(); 
                        $objUsario->setIdusuario($row['idusuario']); 
                        $objUsario->cargar(); }


                    $this->setear($row['idarchivocargado'],$row['acnombre'],$row['acdescripcion'],$row['acicono'], $objUsario,
                    $row['aclinkacceso'],$row['accantidaddescarga'],$row['accantidadusada'],$row['acfechainiciocompartir'], $row['acefechafincompartir'],
                    $row['acprotegidoclave']);
                }
            }  
        } else {
            $this->setmensajeoperacion("ArchivoCargado->listar: ".$base->getError());
        }
        return $resp;  
    }

/*------------------------INSERTAR----------------------------------------*/
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO archivocargado (acnombre, acdescripcion,acicono, idusuario, 
        aclinkacceso,accantidaddescarga,accantidadusada,acfechainiciocompartir,
        acefechafincompartir,acprotegidoclave)  
        VALUES ('".$this->getACNombre()."','".$this->getACDescrip()."','".$this->getACIcono()."','".$this->getObjUsuario()->getIdusuario()."','".$this->getACLink()."','".$this->getACCantDesc()."','".$this->getACCantUsada()."','".$this->getACfechaInicCom()."','".$this->getACfechaFinCom()."','".$this->getACprotegido()."')";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setACId($elid); 
                $resp = true;
            } else {
                $this->setmensajeoperacion("ArchivoCargado->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->insertar: ".$base->getError());
        }
        return $resp;
    }
   /*ejemplo de consulta para arreglar  UPDATE archivocargado SET acefechafincompartir=null WHERE idarchivocargado=79*/
/*------------------------MODIFICAR----------------------------------------*/
   
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE archivocargado SET acnombre='".$this->getACNombre()."', acdescripcion='".$this->getACDescrip()."',acicono='".$this->getACIcono()."',idusuario='".$this->getObjUsuario()->getIdusuario()."',aclinkacceso='".$this->getACLink()."',accantidaddescarga='".$this->getACCantDesc()."',accantidadusada='".$this->getACCantUsada()."',acfechainiciocompartir='".$this->getACfechaInicCom()."',acefechafincompartir='".$this->getACfechaFinCom()."',acprotegidoclave='".$this->getACprotegido()."' WHERE idarchivocargado='". $this->getACId()."'";
        //si tengo dudas de por qué no funciona hago un echo de la setencia, la pego en la BD y veo que error tira
      /* En php 7 en adelante si phpmyadmin no cambia ninguna fila porque no hay nada para modificar va a dar falsa la
        la consulta en base de datos asi que hay que poner if ($base->Ejecutar($sql >=0))
        en este caso no me pasa porque siempre que envio modifica*/
      //echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else { 
 
               
                $this->setmensajeoperacion("ArchivoCargado->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->modificar: ".$base->getError());
        }
        return $resp;
    }
 
 
/*------------------------ELIMINAR----NO SE USA EN ESTE TRABAJO------------------------------------*/
/*    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM archivocargado WHERE idarchivocargado=".$this->getACId();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("ArchivoCargado->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("ArchivoCargado->eliminar: ".$base->getError());
        }
        return $resp;
    }*/
/*------------------------------LISTAR--------------------------------------------*/    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $consultasql="SELECT * FROM archivocargado ";
        if ($parametro!="") {
            $consultasql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($consultasql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $objUsario = NULL; 
                    if ($row['idusuario'] != null) { 
                        $objUsario = new Usuario(); 
                        $objUsario->setIdusuario($row['idusuario']); 
                        $objUsario->cargar(); }
                    $obj= new ArchivoCargado();
                    
                    $obj->setear($row['idarchivocargado'],$row['acnombre'],$row['acdescripcion'],$row['acicono'], $objUsario,
                    $row['aclinkacceso'],$row['accantidaddescarga'],$row['accantidadusada'],$row['acfechainiciocompartir'], $row['acefechafincompartir'],
                    $row['acprotegidoclave']);
                    array_push($arreglo, $obj);
                   
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("ArchivoCargado->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
  
    
}


?>