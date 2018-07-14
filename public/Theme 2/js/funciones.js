
$('body').on('click', '#buscar', function () {
    var datos = $('#busqueda').val();;
    $.ajax({
        //data: parametros,
        url: '../alumnos/'+datos,
        type: 'GET',
        beforeSend: function () {
            //document.getElementById("text-load").innerHTML="Calculando Lugares";
        },
        success: function (finales) {
            if(finales){
                
                
                $("input[name=codigo]").val(datos);
                $('html, body').animate({
                    scrollTop: $("#info").offset().top-90
                }, 1000);
            }
        }
    });
});