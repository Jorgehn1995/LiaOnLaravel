//MODULOS  -   Tipo     -   Carpeta
//A        -   Master   -   Am
//D        -   admin    -   admin
//L        -   alumno   -   alumno
//P        -  profesor  -   aprofe
//G        -   pagos    -   apagos

$(document).ready(function(){
  $("#login").on("submit", function(e){
    e.preventDefault();
    var user = document.getElementById('user').value;
    var pass = document.getElementById('pass').value;
    var parametros = {
      "user" : user,
      "pass" : pass
    };
    $.ajax({
      data:  parametros,
      url:   'assets/validate.php',
      type:  'GET',
      success:  function (response) {
        if (response=="false") {
          var form=document.getElementById('login');
          var error=document.getElementById('error');
          form.className += " has-error";
          error.style.display="block";
        }else {
          if (response=="A") {
            window.location.href ="am/";
          };
          if (response=="D") {
            window.location.href ="admin/";
          };
          if (response=="L") {
            window.location.href ="alumno/";
          };
          if (response=="P") {
            window.location.href ="aprofe/";
          };
          if (response=="G") {
            window.location.href ="apagos/";
          };
          if (response=="disabled") {
            var form=document.getElementById('login');
            var error=document.getElementById('error');
            form.className += " has-error";
            error.innerHTML='<div class="col-12"><p class="text-danger">Usuario Inhabilitado</p></div>';
            error.style.display="block";
          }
        }
      }
    });
    return false;
  });
});
