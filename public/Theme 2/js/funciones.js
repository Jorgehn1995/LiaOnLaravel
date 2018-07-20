
$('body').on('click', '#buscar', function () {
    var datos = $('#busqueda').val();;
    $.ajax({
        //data: parametros,
        url: '../alumnos/'+datos,
        type: 'GET',
        beforeSend: function () {
            //document.getElementById("text-load").innerHTML="Calculando Lugares";
        },
        success: function (response) {
            if(response=="false"){
                $("input[name=codigo]").val(datos);
                $('html, body').animate({
                    scrollTop: $("#info").offset().top-90
                }, 1000);
            }else{
                window.location.href = 'inscripcion/'+response;
            }
        }
    });
});
var dtLang={
    "decimal":        "",
    "emptyTable":     "No hay datos",
    "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
    "infoFiltered":   "(Filtro de _MAX_ total registros)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Mostrar _MENU_ registros",
    "loadingRecords": "Cargando...",
    "processing":     "Procesando...",
    "search":         "Buscar:",
    "zeroRecords":    "No se encontraron coincidencias",
    "paginate": {
        "first":      "Primero",
        "last":       "Ultimo",
        "next":       "Siguiente",
        "previous":   "Anterior"
    },
    "aria": {
        "sortAscending":  ": Activar orden de columna ascendente",
        "sortDescending": ": Activar orden de columna desendente"
    }
}

 //Buttons examples
 var table = $('#alumnos').DataTable({
    lengthChange: false,
    buttons: ['copy', 'excel', 'pdf'],
    language: dtLang,
});
table.buttons().container().appendTo('#alumnos_wrapper .col-md-6:eq(0)');
