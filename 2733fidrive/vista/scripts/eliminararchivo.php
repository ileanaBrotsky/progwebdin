<?php
$Titulo = " amarchivo.php";
include_once("../estructura/cabecera.php");

?>
<?php 
$datos = data_submitted();
//print_r($datos);
if ($datos!=null){
     $nombre=$datos['nombreArchivoModalE'];
}else{
       $nombre="";
}
?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-3 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- Eliminar Archivo</h3>
    </div>
     <!--contenedor del Formulario-->
    <div class="container shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 align-center" id="eliminarformulario" name="eliminarformulario" method="POST" action="ActionEliminarArchivo.php" novalidate>

            <!--Fila 1 % en 2 col-->
            <div class="form-row ">
                <!-- columna 1 -Nombre-->
                <div class="form-group  col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="nomarchivoE">Nombre del archivo:</label>
                    <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded pl-2" id="nomarchivoE" name="nomarchivoE" value="<?php echo $nombre ?>">

                </div>
                <!-- columna 2 tipo de usuario -->
                <div class="form-group col-sm p-1 ">
                    
                    <label class="control-label font-weight-bold" for="usuario">Seleccione el tipo de Usuario</label>
                    <select class="custom-select" id="usuario" name="usuario"required>
                        <option value="">Elija Usuario</option>    
                        <option value="Ileana Brotsky">Ileana Brotsky</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Invitado">Invitado</option>
                    </select>
                     <!-- mensajes para validacion select -->
                     <div class="invalid-feedback" for="usuario"><br>Elija un usuario.</div>
                    <div class="valid-feedback" for="usuario"> Perfecto!</div>
                </div>
            </div>
            <!--Fila 2 Motivo de eliminación-->
            <div class="form-row ">
                <div class="form-group col-12">
                    <label class="control-label font-weight-bold" for="descripcionelim">Motivo de eliminación del archivo: </label>
                    <textarea class="form-control font-weight-light text-wrap" rows="3" id="descripcionelim" name="descripcionelim" required></textarea>
                    <div class="valid-feedback" for="descripcionelim"> Perfecto!</div>
                    <div class="invalid-feedback" for="descripcionelim">Debe completar el campo.</div>
                </div>
            </div>
            <!--Fila 3 grupo de botones-->
            <div class="form-row">
                <div class="btn-group col-md-1 justify-content-between mb-3" role="group">
                    <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                    <button type="reset" class="btn btn-secondary mr-2">Borrar</button>
                    <button class="btn btn-info"> <a class="text-decoration-none text-white " href="contenido.php">Volver</a></button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once("../estructura/pie.php");
?>