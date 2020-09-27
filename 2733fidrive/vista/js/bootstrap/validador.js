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
/*funcion especifica para eje3-username debe ser diferente a contraseña*/
let form = new Validation("eje-3");
// Validation Functions
form.requireText("username", 5, 20, [" "], []);
form.registerPassword("password", 8, 10, [" "], []);





/*mostrar ocultar campo para el ej compartir archivo id clave. */

    function mostrarcampoClave() {
      var element = document.getElementById("campoClave");
          check = document.getElementById("checkclave");
          if (check.checked) {
            element.style.display='block';
           
          }
        else {
            element.style.display='none';
           
          }
        }
   
        function ocultarCampo() {
          var element = document.getElementById("campoClave");
          
                element.style.display='none';
               
        }
