$(document).ready(function() {
  function requerido(campo){
    swal({
      title: "Campo Requerido",
      text: campo,
      icon: "warning",
    });
  }
  $(".save").click(function(e){
    e.preventDefault();
    var blank=0;
    if ( $("#tel-encargado").val() =='') {
      blank=1;
      requerido('{Telefono de Encargado}');
    }
    if ( $("#encargado").val() =='') {
      blank=1;
      requerido('{Nombre de Encargado}');
    }
    if ( $("#nacionalidad").val() =='') {
      blank=1;
      requerido('{Nacionalidad}');
    }
    if ( $("#nacimiento").val() =='') {
      blank=1;
      requerido('{Fecha de Nacimiento}');
    }
    if ( $("#genero").val() =='') {
      blank=1;
      requerido('{Genero del alumno}');
    }
    if ( $("#grado").val() =='') {
      blank=1;
      requerido('{Grado a cursar}');
    }
    if ( $("#apellidos").val() =='') {
      blank=1;
      requerido('{Apellidos del Alumno}');
    }
    if ( $("#nombres").val() =='') {
      blank=1;
      requerido('{Nombre del Alumno}');
    }
    if ( $("#cod").val() =='') {
      blank=1;
      requerido('{Codigo Personal}');
    }
    if (blank==0) {
      //console.log("todo bien");
      var id  = $("#idalumno").val();
      var idcole = $("#idcole").val();
      var codigo = $("#cod").val();
      var nombres = $("#nombres").val();
      var apellidos = $("#apellidos").val();
      var grado = $("#grado").val();
      var genero = $("#genero").val();
      var nacimiento = $("#nacimiento").val();
      var nacionalidad = $("#nacionalidad").val();
      var doc = $("#doc").val();
      var nodoc = $("#nodoc").val();
      var encargado = $("#encargado").val();
      var telencargado = $("#tel-encargado").val();
      var otros = $("#otros").val();
      var estado = $("#estado").val();
      var parametros = {
        "id" : id,
        "idcole" : idcole,
        "peticion":"update",
        "codigo" : codigo,
        "nombres" : nombres,
        "apellidos" : apellidos,
        "grado" : grado,
        "genero" : genero,
        "nacimiento" : nacimiento,
        "nacionalidad" : nacionalidad,
        "doc" : doc,
        "nodoc" : nodoc,
        "encargado" : encargado,
        "telencargado" : telencargado,
        "otros": otros,
        "estado":estado
      };
      console.log(parametros);
      $.ajax({
        data:  parametros,
        url:   '../ajax/update.php',
        type:  'GET',
        beforeSend: function () {

        },
        success:  function (response) {
          //alert(response);
          if (response=="Exito") {
            swal({
              buttons: false,
              timer: 2000,
              title: "Exito",
              text: "Alumno Ingresado Exitosamente",
              icon: "success"
            });
            location.href="./";
          }
          if (response=="Duplicado") {
            swal({
              title: "Duplicado",
              text: "El Codigo Ingresado ya esta asignado a otro alumno",
              icon: "warning"
            });
          }
          if (response=="Error") {
            swal({
              title: "Error",
              text: "Se ha producido un error al actualizar el alumno",
              icon: "danger"
            });
          }
        }
      });
    }

  });
  $(".cancel").click(function(e){
    location.href="./";
  });
  $(".regresar").click(function(){
    location.href="./";
  });
  jQuery('#nacimiento').datepicker({
    autoclose: true,
    todayHighlight: true,
    language: 'es',
  });
});
