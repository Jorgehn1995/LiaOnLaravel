/**************
 Funciones Json para cargar select grado y seccion dinamicamente
***************/
function cargargrado() {
    var element = $("#selectGrados");
    $.ajax({
        //data: parametros,
        url: element.data('route'),
        type: 'GET',
        beforeSend: function () {
            //$(".loadicon").show(500);
        },
        success: function (response) {
            //console.log(response);
            var select = '<option value="">Selecione Un Grado</option>';
            $.each(response, function (i, v) {
                //alert( "Key: " + i + ", Value: " + v.idgrado );
                select += '<option value="' + v.idgrado + '">' + v.grado + ' ' + v.corto + '</option>';
            });
            element.html(select);
        },
        error: function (data) {

        }
    });
}
function cargarseccion(idseccion = 0) {
    var element = $("#selectGrados");
    var elementSeccion = $("#selectSecciones");
    $.ajax({
        //data: parametros,
        url: element.data('seccionroute') + "/" + element.val(),
        type: 'GET',
        beforeSend: function () {
            elementSeccion.html('<option  value="">Cargando Secciones...</option>');
        },
        success: function (response) {
            //console.log(response);
            //var select = '<option value="">Selecione Una Seccion</option>';
            var select = '';
            if (response.length == 0) {
                var select = '<option value="">Selecione Una Seccion</option>';
            }
            $.each(response, function (i, v) {
                //alert( "Key: " + i + ", Value: " + v.idgrado );

                if (idseccion == v.idseccion) {
                    select += '<option selected value="' + v.idseccion + '"> Seccion ' + v.letra + '</option>';
                } else {
                    select += '<option value="' + v.idseccion + '"> Seccion ' + v.letra + '</option>';
                }
            });
            elementSeccion.html(select);
        },
        error: function (data) {

        }
    });
}

/**************
 Funciones para el area de alumnos Alumnos
***************/
function alumnosdatatable() { //Inicializa datatable para la tabla de alumnos
    var dtLang = {
        "decimal": "",
        "emptyTable": "No hay datos",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
        "infoFiltered": "(Filtro de _MAX_ total registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron coincidencias",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": Activar orden de columna ascendente",
            "sortDescending": ": Activar orden de columna desendente"
        }
    }

    //Buttons examples
    var table = $('#alumnos').DataTable({
        lengthChange: false,
        buttons: [/*'copy',*/ 'excel', 'pdf'],
        language: dtLang,
    });
    table.buttons().container().appendTo('#alumnos_wrapper .col-md-6:eq(0)');
}
function selectgenero(genero) {
    var r;
    if (genero == "M") {
        r = '<option value="">Selecione un Genero</option><option selected value="M">Masculino</option><option value="F">Femenino</option>';
    } else {
        if (genero == "F") {
            r = '<option value="">Selecione un Genero</option><option value="M">Masculino</option><option selected value="F">Femenino</option>';
        } else {
            r = '<option value="">Selecione un Genero</option><option value="M">Masculino</option><option value="F">Femenino</option>';
        }
    }
    return r;
}
function addalumnoclear() {
    $("#update").val("0");
    $("#idinscripcion").val("0");
    $("#idusuario").val("");
    $("#inputcod").val("");
    $("input[name=codigo]").val("");
    $("input[name=nombre]").val("");
    $("input[name=apellido]").val("");
    $("input[name=nacimiento]").val("");
    $("select[name=genero]").html(selectgenero("G"));
    $("input[name=encargado]").val("");
    $("input[name=telencargado]").val("");
    $("input[name=otro]").val("");
    cargargrado();
    cargarseccion();
}
function consultarcodigo(dato) { //consulta el codigo y añade a los elementos <p> los datos recibidos
    var datos = dato.val();
    var ruta = dato.data('showroute');
    $.ajax({
        //data: parametros,
        url: ruta + "/" + datos,
        type: 'GET',
        beforeSend: function () {
            //document.getElementById("text-load").innerHTML="Calculando Lugares";

        },
        success: function (response) {
            console.log(response);

            if (response == "false") {
                addalumnoclear();
                $("#modal-notification").modal('hide');
                $("#sbox").show(500);
                $(".listalumnos").hide(500);
                $("input[name=codigo]").val(datos);
                $("#idusuario").val("");


                /**$('html, body').animate({
                    scrollTop: $("#info").offset().top - 90
                }, 1000);*/
            } else {
                //window.location.href = 'inscripcion/' + response;
                //console.log(response);
                addalumnoclear();
                $("#modal-notification").modal('hide');
                $("#sbox").show(500);
                $(".listalumnos").hide(500);
                $("#idusuario").val(response.idusuario);
                $("#inputcod").val(response.codigo);
                $("input[name=codigo]").val(response.codigo);
                $("input[name=nombre]").val(response.nombre);
                $("input[name=apellido]").val(response.apellido);
                $("input[name=nacimiento]").val(response.nacimiento);
                $("select[name=genero]").html(selectgenero(response.genero));
                infoscroll();
            }
        }
    });
}
function infoscroll() {
    $('html, body').animate({
        scrollTop: $("#info").offset().top
    }, 1000);
}
function registraralumno(element) {
    var form = element;
    $.ajax({
        //data: parametros,
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        beforeSend: function () {
            $(".loadicon").show(500);
        },
        success: function (response) {
            $(".loadicon").hide(500);
            if (response.message == "true") {
                $("#modalregistro").modal('hide');
                $("#busquedageneral").val(response['usuario']['codigo']);
                consultarcodigo($("#busquedageneral"));
                form.trigger("reset");
                $('html, body').animate({
                    scrollTop: $("#info").offset().top - 90
                }, 1000);
            }
        },
        error: function (data) {
            var dat = data.responseJSON;
            console.log(dat.errors);
            // Render the errors with js ...
        }
    });
}
function inscribiralumno(element) {
    var form = element;
    var idusuario = $("#idusuario").val();
    //alert(idusuario);
    /**
     * @param NOTA recordar de realizar la comprobacion de variables en javascript
     */


    $.ajax({
        //data: parametros,
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        beforeSend: function () {
            //$(".loadicon").show(500);
        },
        success: function (response) {
            $(".loadicon").hide(500);
            if (response.message == "true") {
                btnreload();
                $.Notification.notify(response['type'], 'top right', response['title'], response['body']);
                addalumnoclear();
                $("#sbox").hide();
                $(".listalumnos").show();
                $('html, body').animate({
                    scrollTop: 0
                }, 1000);
            } else {
                swal({
                    title: response['title'],
                    text: response['body'],
                    type: response['type'],
                });
            }
        },
        error: function (data) {
            var dat = data.responseJSON;
            //console.log(dat.errors);
            // Render the errors with js ...
        }
    });
}
function resetinscripcion() {
    cargargrado();
    $("#selectSecciones").html('<option  value="">Seleccione Una Sección</option>');
    $("#idusuario").val("");
    $("#busquedageneral").val("");
    $("#tcodigo").text("Codigo del Alumno");
    $("#tnombre").text("Nombre del Alumno");
    $("#tapellido").text("Apellido del Alumno");
    $("#tnacimiento").html("dd-mm-aaaa");
    $("#tgenero").html("Género");
    $("#sbox").hide();
    $(".listalumnos").show();
    $('html, body').animate({
        scrollTop: 0
    }, 1000);
}
function accentRemove(string) {
    return string
        .replace(/έ/g, 'ε')
        .replace(/[ύϋΰ]/g, 'υ')
        .replace(/ό/g, 'ο')
        .replace(/ώ/g, 'ω')
        .replace(/ά/g, 'α')
        .replace(/[ίϊΐ]/g, 'ι')
        .replace(/ή/g, 'η')
        .replace(/\n/g, ' ')
        .replace(/á/g, 'a')
        .replace(/é/g, 'e')
        .replace(/í/g, 'i')
        .replace(/ó/g, 'o')
        .replace(/ú/g, 'u')
        .replace(/ê/g, 'e')
        .replace(/î/g, 'i')
        .replace(/ô/g, 'o')
        .replace(/è/g, 'e')
        .replace(/ï/g, 'i')
        .replace(/ü/g, 'u')
        .replace(/ã/g, 'a')
        .replace(/õ/g, 'o')
        .replace(/ç/g, 'c')
        .replace(/ì/g, 'i');
};
function alumnocard(string) {
    var val = string;
    var acard = '';
    acard += '<div class="col-md-4 m-b-20 m-t-10 acard " >';
    acard += '<div class="card card-lift--hover shadow border-0">';
    acard += '<div class="card-body py-5 widget-user">';
    acard += '<div>';
    acard += '<img src="' + val.foto + '" class="rounded-circle" alt="user">';
    acard += ' <div class="wid-u-info">';
    acard += '<h6 class="mt-0 m-b-5 font-11 text-uppercase">' + val.nombre + ' <br><small class="">' + val.apellido + '</small></h6>';
    acard += '<p class="text-muted m-b-5 font-13">' + val.codigo + '</p>';
    acard += '</div>';
    acard += '</div>';
    acard += '<p class="description mt-3">' + val.grado.grado + ' ' + val.nivel.corto + ' ' + val.seccion.letra + '</p>';
    acard += '<div>';

    acard += '<span class="badge badge-pill badge-primary">' + val.nacimiento + '</span>';
    acard += '<span class="badge badge-pill badge-primary">' + val.edad + '</span>';
    acard += '<span class="badge badge-pill badge-' + val.estado.color + '"> ' + val.estado.estado + '</span>';
    acard += '</div>';
    acard += '<a href="' + val.editroute + '" class="btn btn-warning btn-sm mt-4" data-toggle="tooltip" data-placement="top" title="Editar Información" ><i class="ti-pencil"></i></a>';
    acard += '<a href="#" class="btn btn-info btn-sm mt-4" data-toggle="tooltip" data-placement="top" title="Editar Foto"><i class="ti-image"></i></a>';
    acard += '</div>';
    acard += '</div>';
    acard += '</div>';
    return acard;
}
function consultarinscritos(url) { //consulta el codigo y añade a los elementos <p> los datos recibidos
    $.ajax(url, {
        type: 'GET',
        beforeSend: function () {
            $("#divload").show();
        },
        success: function (datos) {
            data = datos;
            var output = ''
            $.each(datos, function (key, val) {
                output += alumnocard(val);
            });
            $("#divload").hide(0);
            $('#searchbox').html(output);

            $('#searchbox').slideDown(500);

        }
    });
}
function alumnoslivesearch(searchField) {
    if (searchField === '') {
        //console.log(data);
        output = '';
        $.each(data, function (key, val) {
            output += alumnocard(val);
        });
        $('#searchbox').html(output);
        return;
    }
    var regex = new RegExp(searchField, "i");
    var output = '';
    var count = 1;
    //console.log(data);
    $.each(data, function (key, val) {
        fullname = accentRemove(val.fullname.toLowerCase());
        codigo = accentRemove(val.codigo.toLowerCase());
        if ((fullname.search(regex) != -1) || (codigo.search(regex) != -1) || (val.edad.search(regex) != -1)) { //campos en que se busca
            output += alumnocard(val);
        }
    });
    if (output == '') {
        output = '<p class="text-muted text-center">Sin resultados</p>';
    }
    $('#searchbox').html(output);
}
function subirfotoperfil() {
    window.addEventListener('DOMContentLoaded', function () {
        var avatar = document.getElementById('avatar');
        var image = document.getElementById('image');
        var input = document.getElementById('input');
        var $progress = $('.pb');
        var $progressBar = $('.progress-bar');
        var $alert = $('.alert');
        var $modal = $('#modal');
        var cropper;

        $('[data-toggle="tooltip"]').tooltip();

        $("#input").change(function (e) {
            var files = e.target.files;
            var done = function (url) {
                input.value = '';
                image.src = url;
                $alert.hide();
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                    /**
                     * Aqui se inicia el cropper
                     */
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 0,
                    });
                    $(".ic").show();
                } else if (FileReader) {

                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);

                }
            }
        });
        $("#cancel").click(function () {
            cropper.destroy();
            cropper = null;
            $(".ic").hide();
        });

        $("#crop").click(function () {
            var initialAvatarURL;
            var canvas;

            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });
                initialAvatarURL = avatar.src;
                avatar.src = canvas.toDataURL();
                $progress.show();
                $alert.removeClass('alert-success alert-warning');
                canvas.toBlob(function (blob) {
                    var formData = new FormData();

                    formData.append('avatar', blob, 'avatar.jpg');
                    $.ajax('https://jsonplaceholder.typicode.com/posts', {
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,

                        xhr: function () {
                            $(".ic").hide();
                            var xhr = new XMLHttpRequest();

                            xhr.upload.onprogress = function (e) {
                                var percent = '0';
                                var percentage = '0%';

                                if (e.lengthComputable) {
                                    percent = Math.round((e.loaded / e.total) * 100);
                                    percentage = percent + '%';
                                    $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                                }
                            };

                            return xhr;
                        },

                        success: function () {
                            $alert.show().addClass('alert-success').text('Foto Subida');
                        },

                        error: function () {
                            avatar.src = initialAvatarURL;
                            $alert.show().addClass('alert-warning').text('Upload error');
                        },

                        complete: function () {

                            $progress.hide();
                            $("#cancel").click();
                        },
                    });
                });
            }
        });
    });

}