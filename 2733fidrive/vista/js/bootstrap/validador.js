(function() {
  'use strict';
  window.addEventListener('load', function() {
   
    /* Obtener todos los formularios a los que 
    queremos aplicar estilos de validación de Bootstrap personalizados*/
    var forms = document.getElementsByClassName('needs-validation');
    // Bucle sobre ellos y previene el submit
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
       
       /*agregado para cambiar a invalido el campo descripcion si no estaba lleno
       no funciona. tambien probé con document.getElementById( 'editor' );
       
        var editorEnriquecido=  document.querySelector( '#editor' );
       if(editorEnriquecido.value==""){
        form.checkValidity()==false;
        editorEnriquecido.style.borderColor= "red";
       }*/

        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
      
        form.classList.add('was-validated');
      
      }, false);
    });
  }, false);

})();



/*mostrar campo con botones ocultos para trabajar con  archivos existentes, en ejercicio "contenido". */
  function mostrarBotones() {
    var element = document.getElementById("filaBotones");
   
      element.style.display='block';
    
  }
  
/*mostrar/ocultar campo para el ej compartirarchivo si está o no seleccionado el check id clave. */
    function mostrarcampoClave() {
        var element = document.getElementById("campoPassword");
          check = document.getElementById("checkclave");
          if (check.checked) {
            element.style.display='block';
          }
        else {
            element.style.display='none';
          }
        }
  /*ocultar/mostrar campo para el ejercicio compartirarchivo/amararchivo(campo subirachivo) id clave y campohash. para que al resetear el formulario se oculte*/ 
        function ocultarCampo() {
          var element = document.getElementById("campoPassword");
          element.style.display='none';
          var element = document.getElementById("campoHash");
        element.style.display='none';
        var element = document.getElementById("filaBotones");
        element.style.display='none';
        var element = document.getElementById("archivo");
        element.style.display='block';
        }
/*Borrar nombre de archivo al resetear formulario am
  borrar texto enriquecido al resetear formulario NO ANDA 
  function borrarCampo() {
    var element =  document.getElementById("editor1") ;
    element="";
  }*/
 
 /*para cambiar el action de formulario amarchivo clave=0->Alta/clave!0=Modificar*/
function cambiarAlta() {
  //obtener formulario
    var amformulario = $('#amformulario');
    var clave= document.getElementById("clave").value;
    if(clave!=0){
    //Cambia el ACTION del formulario
    amformulario.attr("action", "actionModificar.php");
  }
  else{
    amformulario.attr("action", "actionAlta.php");
  
}
}
//seleccionar un radiobutton en relacion al nombre de archivo ingresado en amarchivo 
function sugerirRadio() {
  var nombre = document.getElementById("nombrearchivo").value;
      var letrachica= nombre.toLowerCase();
      var terminacion = letrachica.split(".");
      var tipoArchivo = terminacion[1];
     
      if (tipoArchivo=="gif" ||tipoArchivo=="jpg" || tipoArchivo=="jpeg"|| tipoArchivo=="png"||tipoArchivo=="svg"){
        document.getElementById('imagen').checked = true;
        alert("se sugiere seleccionar tipo de archivo imagen");
      }
    if (tipoArchivo=="zip"){
      document.getElementById('Zip').checked = true;
      alert("se sugiere seleccionar tipo de archivo zip");
    }
    if (tipoArchivo=="pdf"){
      document.getElementById('PDF').checked = true;
      alert("se sugiere seleccionar tipo de archivo pdf");
    }
    if (tipoArchivo=="doc"|| tipoArchivo == "docx"){
      document.getElementById('DOC').checked = true;
      alert("se sugiere seleccionar tipo de archivo doc");
    }
    if (tipoArchivo=="xls"|| tipoArchivo == "xlsx"){
      document.getElementById('XLS').checked = true;
      alert("se sugiere seleccionar tipo de archivo xls");
    }
}
//para cargar el modal de modificararchivo
function cargarModalM(){
  var nombre = document.getElementById("SelectorArchivos").value;
  var elementoModal = document.getElementById("nombreArchivoModalM");
      elementoModal.value= nombre;

} 
//para cargar el modal de eliminar
function cargarModalE(){
  var nombre = document.getElementById("SelectorArchivos").value;
  var elementoModal = document.getElementById("nombreArchivoModalE");
      elementoModal.value= nombre;

}
//para cargar el modal de eliminar
function cargarModalDC(){
  var nombre = document.getElementById("SelectorArchivos").value;
  var elementoModal = document.getElementById("nombreArchivoModalDC");
      elementoModal.value= nombre;

}
//para cargar el modal de compartir
function cargarModalC(){
  var nombre = document.getElementById("SelectorArchivos").value;
  var elementoModal = document.getElementById("nombreArchivoModalC");
      elementoModal.value= nombre;

}
//para poner el nombre automaticamente en el input nombre de archivo cuando se sube un archivo-SE USA EN AMARCHIVO
  function setearNombre(){
    var element = document.getElementById("nombrearchivo");
    var nombre =document.getElementById('archivo').files[0].name;
    element.value= nombre;
    sugerirRadio();
    
  }
 //para chequear contraseña
 function chequearPassword(){
 
  var pass = document.getElementById("password-input").value;
  var errorsimbolo=document.getElementById("password-strength__error text-danger js-hidden");
  var barra1= document.getElementById("pb30");
  var barra2= document.getElementById("pb60");
  var barra3= document.getElementById("pb100");

  //debil: solo numeros y letras, longitud menor a 6
  var redebil=/^[a-zA-Z0-9]{1,5}$/; 
  //moderada: solo numeros y letras, longitud mayor a 6
  var remoderada=/^[a-zA-Z0-9]{6,}$/;
  //fuerte: simbolos, numeros y letras, longitud mayor a 6
  var refuerte=/^[a-zA-Z0-9!_*+$¿¡]{6,}$/
  
	if(redebil.exec(pass)){
    barra1.style.display='block';
    barra2.style.display='none';
    barra3.style.display='none';
   }
else{
    if (remoderada.exec(pass)){
        barra1.style.display='none';
        barra2.style.display='block';
        barra3.style.display='none';
        }
    else{
         if (refuerte.exec(pass)){
          barra1.style.display='none';
          barra2.style.display='none';
          barra3.style.display='block';
   }
  }
}  
   }
 
//generar hash para comartirarchivo.php
     function hash(){
      var cantDias = document.getElementById("diascompartido").value; 
      var cantDescargas = document.getElementById("decargasposibles").value; 
      var  nombreArchivo = document.getElementById("nomarchivo").value; 
      var  value= nombreArchivo+cantDias+cantDescargas;
      if(cantDias==""||cantDescargas==""){
        value=nombreArchivo+"9007199254740991";
      }
    //   alert(value);
       var resp= hashCode(value);
    //   alert(resp);
       var etiquetaCodigo= document.getElementById("codigodescarga");
    //   alert(etiquetaCodigo.value);
      etiquetaCodigo.value=resp;
    //  alert(etiquetaCodigo.value);
      /*mostrar campo para el ej compartirarchivo si está o no seleccionado el check id clave. */
      var element = document.getElementById("campoHash");
      element.style.display='block'; 
    }
       function hashCode(str) { 
        return str.split('').reduce((prevHash, currVal) => (((prevHash << 5) - prevHash) + currVal.charCodeAt(0))|0, 0); } 
       
     


  