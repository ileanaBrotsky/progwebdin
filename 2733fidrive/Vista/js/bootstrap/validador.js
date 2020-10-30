(function() {
  'use strict';
  window.addEventListener('load', function() {
   
    /* Obtener todos los formularios a los que 
    queremos aplicar estilos de validación de Bootstrap personalizados*/
    var forms = document.getElementsByClassName('needs-validation');
    // Bucle sobre ellos y previene el submit
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
      
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
      
        form.classList.add('was-validated');
      
      }, false);
    });
  }, false);

})();


var btnEnviar = document.getElementById("boton-enviarca");
btnEnviar.disabled = true;
/*Habilita boton enviar SE USA EN COMPARTIR ARCHIVO PARA QUE NO SE ENVIE SI NO HAY HASH*/
function habilitarboton(){
  
  var btnEnviar = document.getElementById("boton-enviarca");
  btnEnviar.disabled = false;
  
}
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

//seleccionar un radiobutton en relacion al nombre de archivo ingresado en amarchivo 
function sugerirRadio() {
 
  var nombre = document.getElementById("acnombre").value;
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

		

//para poner el nombre automaticamente en el input nombre de archivo cuando se sube un archivo-SE USA EN AMARCHIVO
  function setearNombre(){
    var element = document.getElementById("acnombre");
    var nombre =document.getElementById('archivo').files[0].name;
    element.value= nombre;
    sugerirRadio();
    
  }
 //para chequear contraseña SE USA EN COMPARTIR ARCHIVO
 function chequearPassword(){
 
  var pass = document.getElementById("acprotegidoclave").value;
    var barra1= document.getElementById("pb30");
  var barra2= document.getElementById("pb60");
  var barra3= document.getElementById("pb100");

  //debil: solo numeros y letras, longitud menor a 6
  var redebil=/^[a-zA-Z0-9]{1,5}$/; 
  //moderada: solo numeros y letras, longitud mayor a 6
  var remoderada=/^[a-zA-Z0-9]{6,}$/;
  //fuerte: simbolos, numeros y letras, longitud mayor a 6
  var refuerte=/^[a-zA-Z0-9!_*+$¿?%¡/=#"@&)()]{6,}$/;
  
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
 
//generar hash para comartirarchivo.php SE USA EN COMPARTIR ARCHIVO
     function hash(){
      var cantDias = document.getElementById("diascompartido").value; 
      var cantDescargas = document.getElementById("accantidaddescarga").value; 
      var  nombreArchivo = document.getElementById("acnombre").value; 
      var  value= nombreArchivo+cantDias+cantDescargas;
      if(cantDias==""||cantDescargas==""){
        value=nombreArchivo+"9007199254740991";
      }
    //   alert(value);
       var linkdescarga= hashCode(value);
    //   alert(resp);
       var etiquetaCodigo= document.getElementById("aclinkacceso");
    //   alert(etiquetaCodigo.value);
      etiquetaCodigo.value=linkdescarga;
    //  alert(etiquetaCodigo.value);
        habilitarboton();
      /*mostrar campo para el ej compartirarchivo si está o no seleccionado el check id clave. */
      var element = document.getElementById("campoHash");
      element.style.display='block'; 
      
    }
   //Función que mezclalas variables para formar el hash
    function hashCode(str) { 
    return str.split('').reduce((prevHash, currVal) => (((prevHash << 5) - prevHash) + currVal.charCodeAt(0))|0, 0); } 
  
        
  //para el scroll bar de los contenidos y de archivos compartidos   
        var myCustomScrollbar = document.querySelector('.my-custom-scrollbar');
        var ps = new PerfectScrollbar(myCustomScrollbar);
        
        var scrollbarY = myCustomScrollbar.querySelector('.ps__rail-y');
        
        myCustomScrollbar.onscroll = function () {
          scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; height: 400px; right: ${-this.scrollLeft}px`;
        }

  //para mostrar u ocultar contraseña
  $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});