<?php
$Titulo = " eliminararchivocompartido.php";
include_once("../estructura/cabecera.php");

?>
<?php 
$datos = data_submitted();

//print_r($datos);
if ($datos!=null){
   
    $nombre=$datos["nombreArchivoModalDC"];
}else{
   
    $nombre="1234.png";

}
?>
<!--contenedor de todo-->
<div class="container border bg-white shadow rounded justify-content-center mt-3">
    <!--contenedor de titulo-->
    <div class="nav bg-light shadow mb-3 rounded">
        <h4 class="text-primary"><i class="far fa-edit"></i> Trabajo Entregable/Parte 3- eliminararchivocompartido.php</h3>
    </div>
    
    <!--contenedor del Formulario-->
    <div class="container shadow mb-5 rounded  mt-2 p-3">
        <!--Formulario-->
        <form class="needs-validation col-12 align-center" id="eliminarcompformulario" name="eliminarcompformulario" method="POST" action="eliminarCompArchivo.php" novalidate>

            <!--Fila 1 % en  3 col -->
            <div class="form-row ">
                 <!-- columna 1 -Nombre-->
                 <div class="form-group  col-sm p-1 ">
                    <label class="control-label font-weight-bold" for="nomarchivo">Nombre del archivo:</label>
                    <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded pl-2" id="nomarchivo" name="nomarchivo" value="<?php echo $nombre ?>">

                </div>
                <!-- columna 2 -dias que se ha compartido-->
                <div class="form-group  col-sm p-1 ">
                <label class="control-label font-weight-bold" for="cantcompartida">El archivo se ha compartido:</label>
                    <input type="text" readonly class="form-control font-weight-bold bg-light shadow-lg rounded pl-2" id="cantcompartida" name="cantcompartida" value="10 veces">
                                     
                </div>
                <!-- columna 3 -Usuario-->
                <div class="form-group col-sm p-1 ">
                <label class="control-label font-weight-bold" for="operacion">Seleccione el tipo de Usuario:</label>
                 <select class="custom-select" id="operacion" name="operacion"required>
                        <option value="">Elija Usuario</option>    
                        <option value="Ileana">Ileana Brotsky</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Invitado">Invitado</option>
                    </select>
                     <!-- mensajes para validacion select -->
                     <div class="invalid-feedback" for="operacion"><br>Elija un usuario.</div>
                    <div class="valid-feedback" for="operacion"> Perfecto!</div>
                </div>
            </div>
            <!--Fila 2 Motivo de eliminación-->
            <div class="form-row ">
                <div class="form-group col-12">
                    <label class="control-label font-weight-bold" for="motivoeac">Motivo de eliminación del archivo compartido: </label>
                    <textarea class="form-control font-weight-light text-wrap" rows="3" id="motivoeac" name="motivoeac" required></textarea>
                    <div class="valid-feedback" for="motivoeac"> Perfecto!</div>
                    <div class="invalid-feedback" for="motivoeac">Debe completar el campo.</div>
                </div>
            </div>

            <!--Fila 3 grupo de botones-->
            <div class="form-row">
                <div class="btn-group col-md-1 justify-content-between" role="group">
                    <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                    <button type="reset" class="btn btn-secondary mr-2">Borrar</button>
                    <button class="btn btn-info" name="boton-volver"  id="boton-volver"><a class="text-decoration-none" href="contenido.php">Volver</a> </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

include_once("../estructura/pie.php");
?>