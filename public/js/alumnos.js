/**
 * 
 * @param {*} string remueve las tildes de una cadena y ayuda a simplificar la busqueda de informacion
 */
function removerAcentos(string) {
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
/**
 * 
 * @param {*} alumno se pasa un alumno y este dibuja y estructura el diseño de la tarjeta que se verá en pantalla
 */
function tarjetaAlumno(alumno) {
    var val = alumno;

    var acard = '';
    acard += '<div class="col-md-6 m-b-20 m-t-10 acard " >';
    acard += '<div class="card card-lift--hover shadow border-0">';
    acard += '<div class="card-body py-5 widget-user">';
    acard += '<div>';
    acard += '<img src="' + val.foto + '" class="rounded-circle" alt="user">';
    acard += ' <div class="wid-u-info">';
    acard += '<h5 class="mt-0 m-b-5 font-11 text-uppercase">' + val.codigo + ' </h5>';
    acard += '<p class=" m-b-5 font-13"><strong>' + val.nombre + ' ' + val.apellido + '</strong></p>';
    acard += '</div>';
    acard += '</div>';
    acard += '<div> <br>';
    acard += '<p class="description mt-3">' + val.grado.nombre + ' ' + val.grado.seccion + '</p>';
    acard += '<span class="badge badge-pill badge-primary">' + val.nacimiento + '</span>';
    acard += '<span class="badge badge-pill badge-primary">' + val.edad + '</span>';
    if (val.idestado = 1) {
        acard += '<span class="badge badge-pill badge-success"> Activo </span>';
    }
    acard += '</div>';
    acard += '<a href="' + val.editar + '" class="btn btn-warning btn-sm mt-4" data-toggle="tooltip" data-placement="top" title="Editar Información" ><i class="ti-pencil"></i> Editar</a>';
    acard += '<a href="#" class="btn btn-info btn-sm mt-4" data-toggle="tooltip" data-placement="top" title="Editar Foto"><i class="ti-image"></i> Cambiar Foto</a>';
    acard += '<a href="#" class="btn btn-success btn-sm mt-4" data-toggle="tooltip" data-placement="top" title="Ver Pagos"><i class="ti-money"></i> Ver Pagos</a>';
    acard += '</div>';
    acard += '</div>';
    acard += '</div>';
    return acard;
}
/**
 * 
 * @param {*} searchField Realiza una busqueda live en los registros de un objeto y luego devulve el resultado
 * @param {*} data se pasa la data donde se buscaran las coincidencias
 */
function alumnoslivesearch(searchField, data) {
    data = JSON.parse(data);
    if (searchField === '') {
        //console.log(data);
        output = '';
        $.each(data, function (key, val) {
            output += tarjetaAlumno(val);
        });
        $('#searchbox').html(output);
        return;
    }
    var regex = new RegExp(searchField, "i");
    var output = '';
    var count = 1;
    console.log(data);
    $.each(data, function (key, val) {

        fullname = removerAcentos(val.fullname.toLowerCase());
        codigo = removerAcentos(val.codigo.toLowerCase());
        if ((fullname.search(regex) != -1) || (codigo.search(regex) != -1) || (val.edad.search(regex) != -1)) { //campos en que se busca
            output += tarjetaAlumno(val);
        }
    });
    if (output == '') {
        output = '<p class="text-muted text-center">Sin resultados</p>';
    }
    $('#searchbox').html(output);
}
/**
 * 
 * @param {*} url se pasa la url de donde se cargaran los alumnos y este se encarga de cargarlos y desencadenar el livesearch
 */
function cargaralumnos(url) {
    var url = url;
    $.ajax({
        //data: parametros,
        url: url,
        type: 'GET',
        beforeSend: function () {
            $(".divload").show();
        },
        success: function (response) {
            $("#datainscritos").val(JSON.stringify(response));
            var output = "";
            $.each(response, function (key, val) {
                output += tarjetaAlumno(val);
            });
            $('#searchbox').html(output);
            $(".listalumnos").show();
            $("#divload").hide();
        },
        error: function (data) {

        }
    });
}
/**
 * 
 * @param {*} inp aca se pasa el input donde se cargaran los datos de los grados 
 * @param {*} url aca se psa la url de donde se obtendrán los grados
 */
function grados(inp, url) {
    var url = url;
    var element = inp;
    $.ajax({
        //data: parametros,
        url: url,
        type: 'GET',
        beforeSend: function () {
            //$(".loadicon").show(500);
        },
        success: function (response) {
            //console.log(response);
            var select = '<option value="">Selecione Un Grado</option>';
            $.each(response, function (i, v) {
                //alert( "Key: " + i + ", Value: " + v.idgrado );
                select += '<option value="' + v.idgrado + '">' + v.grado + ' ' + v.seccion + '</option>';
            });
            element.html(select);
        },
        error: function (data) {

        }
    });
}
/**
 * 
 * @param {*} inp Este parametro lleva el input que se va a autocompletar con esta funcion
 * @param {*} arr este parametro lleva el arrary con el que se completara el input
 * NOTA: ESTA FUNCION NO SE DESENCADENA SOLA. la funcion la desencadena la funcion datosautocompletado
 */
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false; }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].codigo.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                b.setAttribute("class", "data-autocomplete");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].codigo.substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].codigo.substr(val.length) + " - " + arr[i].apellido + " " + arr[i].nombre;
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' class='data-autocomplete' data-json='" + JSON.stringify(arr[i]) + "' value='" + arr[i].codigo + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    procesarautocompletado(this.getElementsByTagName("input")[0].dataset.json);
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}
/**
 * 
 * @param {*} url esta es la url de donde se traeran los datos y esta funcion desencadena la de autocompletado en el input 
 */
function datosautocompletado(url) { //consulta el codigo y añade a los elementos <p> los datos recibidos
    $.ajax(url, {
        type: 'GET',
        beforeSend: function () {

        },
        success: function (response) {
            autocomplete(document.getElementById('codigo'), response);
        }
    });
}
/**
 * 
 * @param {*} json por este parametro se pasa el json que otorgo la funcion anterior y lo que hace es completar todos los campos con los datos
 * a los cuales hemos dado click
 */
function procesarautocompletado(json) {
    json = JSON.parse(json);

    $("[name='nombre']").val(json.nombre);
    $("[name='apellido']").val(json.apellido);
    if (json.genero == 'm') {
        var genero = '<option selected value="m">Masculino</option><option value="f">Femenino</option>';
    } else {
        var genero = '<option value="f">Masculino</option><option selected value="f">Femenino</option>';
    }
    $("[name='genero']").html(genero);
    $("[name='nacimiento']").val(json.nacimiento);
    $("[name='direccion']").val(json.direccion);
    $("[name='encargado']").val(json.encargado);
    $("[name='telencargado']").val(json.telefono);
}
/**
 * 
 * @param {*} form se pasa el formulario a la funcion y esta se encarga de extraer los datos y hacer la peticion ajax
 */
function registraralumno(form) {
    var form = form;
    $.ajax({
        //data: parametros,
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        beforeSend: function () {

            $(".btn-save").html('<i class="ti-reload"></i> Procesando Informacion');
        },
        success: function (response) {
            //console.log(response.status);
            $(".btn-save").prop('disabled', false);
            $(".btn-save").html('<i class="ti-save"></i> INSCRIBIR ALUMNO');
            if (response.status) {
                $(".listalumnos").show();
                $("#sbox").hide();
                form.trigger("reset");
                $('html, body').animate({
                    scrollTop: $("#info").offset().top - 90
                }, 1000);
                cargaralumnos($("#inscritos").val());
                swal({
                    title: response.title,
                    text: response.msg,
                    type: 'success',
                });
            } else {
                swal({
                    title: response.title,
                    text: response.msg,
                    type: 'info',
                });
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
