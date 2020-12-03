<?php
$Titulo = " actualizarlogin.php";
include_once("../estructura/cabecera.php");
?>


<?php
$objAbmUsuario = new AbmUsuario();
$datos = data_submitted();
//print_r($datos);
//chequeo si se enviaron datos , para saber si es modificación o alta e archivo
// si hay datos los cargo en formulario, para modificacion
$objUs = NULL;
if (isset($datos['idusuario'])) {
    $usuario = $objAbmUsuario->buscar($datos);
      // print_r($listaArchivos);
    if (count($usuario) == 1) {
        $objUs = $usuario[0];
           //print_r($objArchivo);
        $id= $datos['idusuario'];
        $nombre =ucfirst( $objUs->getUsnombre());
        $apellido = ucfirst($objUs->getUsapellido());
        $usuario = $objUs->getUslogin();
        $pass = $objUs->getUsclave();
        $activo = 0;
    }
}
    ?>     
     <!--contenedor de todo-->
     <div class="container border bg-white shadow rounded justify-content-center mt-3">
         <!--contenedor de titulo-->
         <div class="nav bg-light shadow mb-4 rounded">
             <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Entrega 5- Eliminar usuario</h4>
         </div>

         <!--contenedor del Formulario-->
         <div class="nav shadow mb-5 rounded justify-content-center mt-2 p-3">
             <!--Formulario-->
             <form class="col-12 " id="eliminarUs" name="eliminarUs" method="POST" action="../accion/actioneliminarUs.php" >
            <!--Fila 1 % en 2 col de 6-->
             <div class="form-row ">
             <!--col 1 nombre-->
             <div class="col-6 ">
             <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="usnombre">Nombre:</label>
                   <input type="text"  class="form-control" id="usnombre" name="usnombre" value= <?php echo $nombre ?> readonly>
               </div>
               </div>
               <!--col 2 Apellido-->
                <div class="col-6 ">
                <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="usapellido">Apellido:</label>
                   <input type="text" class="form-control" id="usapellido" name="usapellido"  value= <?php echo $apellido ?>  readonly>
               </div>
               </div>
               </div>
          <!--Fila 2 % en 2 col de 6-->
          <div class="form-row ">
           <!--col 1 Nombre de usuario-->
           <div class="col-6 ">
               <div class="form-group  ">
                   <label class="control-label font-weight-bold" for="uslogin">Nombre de Usuario:</label>
                   <input type="text" class="form-control" id="uslogin" name="uslogin" pattern= "^[a-zA-Z]*$"  value= <?php echo $usuario ?>  readonly>
               </div>
            </div>
           <!--col 2 contraseña-->
           <div class="col-6 ">
                <div class="form-group">
                    <label  class="control-label font-weight-bold" for="usclave">Contraseña</label>
                        <div class="input-group">
                            <input class="form-control font-weight-light" type="text" id="usclave" name="usclave" aria-describedby="passwordHelp"  value= <?php echo $pass ?>  readonly/>
                        </div>
               </div>
            </div>
          <!--Fila 3 % 2 col de 6-->
          <div class="form-row col-12">
           <!--col 1 id usuario-->
           <div class="col-6 ">
           <div class="form-group">
                <label class="control-label font-weight-bold" for="idusuario">Id de usuario:</label>
                <input type="text" class="form-control font-weight-light " id="idusuario" name="idusuario" value="<?php echo $id ?>" readonly> 
            </div>   
            </div>  
          <!-- etiqueta invisible que envia activo-->
           <input type="hidden" class="form-control font-weight-light " id="usactivo" name="usactivo" value="<?php echo $activo ?>">
            <!--col 2 grupo de botones -->
            <div class="col-6 "> 
                <div class="form-group">
                <label class="control-label font-weight-bold" for="boton-enviarform">Confirma eliminación?</label>
                <div class="btn-group  d-flex align-items-baseline" role="group">
                    <button type="submit" class="btn btn-primary mr-2" name="boton-enviarform"  id="boton-enviarform">ELIMINAR</button>
                    <button class="btn btn-info" name="boton-volver" id="boton-volver"><a class="text-decoration-none" href="interface.php">VOLVER</a> </button>
                </div>
                </div>
            </div>
            </div>
        </form>  
        </div>
    </div>

<?php

include_once("../estructura/pie.php");
?>