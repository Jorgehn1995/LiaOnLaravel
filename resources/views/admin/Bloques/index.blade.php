@extends('admin.layout') 
@section('title', "Bloques de Calificación") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{ route('bloques.create') }}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Bloque</button>
    <span class="badge text-muted" id="btn-msg" style="display:none;"> Hola</span>
</div>

<div class="col-md-12">
    <h6>@yield('title')</h6>
    <hr>
    <table class="table table-hover table-striped wrap" wrap>
        <thead>
            <tr>
                <td colspan="3" class="text-center">Información</td>
                <td colspan="3" class="text-center bg-info text-white">Visualizaciones</td>
                <td rowspan="2" class="text-center">Acciones</td>
            </tr>
            <tr>
                <td>Bloque</td>
                <td>Nombre</td>
                <td>Porcentaje</td>
                <td class="bg-info text-white">Profesores</td>
                <td class="bg-info text-white">Alumnos</td>
                <td class="bg-info text-white">Padres</td>
            </tr>
        </thead>
        <tbody id="tbody2">
            @forelse($bloques as $bloque)
            <tr id="{{$bloque->idcuadro}}">
                <td data-id="{{$loop->index+1}}">{{$loop->index+1}}</td>
                <td>{{$bloque->nombre}}</td>
                <td>{{$bloque->porcentaje}} </td>
                <td>
                    <input type="checkbox" @if($bloque->profesor==1) checked @endif data-tipo="profesor" data-id="{{$bloque->idbloque}}"
                    class="data-switch" data-plugin="switchery" data-color="#00b19d" />
                </td>
                <td>
                    <input type="checkbox" @if($bloque->alumno==1) checked @endif data-tipo="alumno" data-id="{{$bloque->idbloque}}"
                    class="data-switch" data-plugin="switchery" data-color="#00b19d" />
                </td>
                <td>
                    <input type="checkbox" @if($bloque->padre==1) checked @endif data-tipo="padre" data-id="{{$bloque->idbloque}}"
                    class="data-switch" data-plugin="switchery" data-color="#00b19d" />
                </td>
                <td>
                    <div class="pull-right">
                        <button type="button" title="Editar" onclick="location.href='{{ route('bloques.edit', $bloque->idbloque) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                    </div>
                </td>
            </tr>
            @empty
            <td class="text-center text-muted" colspan="11"> No existen cuadros registrados para este nivel</td>
            @endforelse

        </tbody>
    </table>
    <div class="col-md-12">
        <form id="ordenform" action="{{route('bloques.mostrar')}}" class="hide-b" method="POST">
            @csrf
            <input type="hidden" name="tipo" id="tipo">
            <input type="hidden" name="idbloque" id="idbloque">
            <input type="hidden" name="estado" id="estado">
        </form>
    </div>
</div>
@endsection
 
@section('js')
<script>
    $(".data-switch").change(function(){
        
        $("#tipo").val($(this).data('tipo'));
        $("#idbloque").val($(this).data('id'));
        var condiciones = $(this).is(":checked");
        if (!condiciones) {
            $("#estado").val("0");    
        }else{
            $("#estado").val("1");
        }
        var td=$(this);
        var form = $("#ordenform"); 
        $.ajax( {
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            beforeSend:function(){
                $("#btn-msg").html('<i class="ti-reload"></i> Guardando Cambios');
                $("#btn-msg").show();
            },
            success: function(response) {
                if(response['status']=="true"){
                    $("#btn-msg").html('<i class="ti-check"></i> Cambios Guardados');
                    $("#btn-msg").show();
                    $("#btn-msg").fadeOut(3000);
                }
            },
            error:function(error){
                $("#btn-msg").html('<i class="ti-unlink"></i> Sin conexión a internet');
                $("#btn-msg").show();
            }
            
        });
    });

</script>
@endsection