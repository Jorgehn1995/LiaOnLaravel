@extends('admin.layout') 
@section('title', "Cuadro de Calificación") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{ route('cuadros.create') }}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Actividad</button>
    <button type="button" id="btn-ordenar" class="btn btn-info" style="display:none;"><i class="ti-exchange-vertical"></i> Guardar Orden</button>
</div>

<div class="col-md-12">
    <h6>@yield('title')</h6>
    <hr>
    <table class="table table-hover table-striped wrap" wrap>
        <thead>
            <tr>
                <td>Orden</td>
                <td>Tipo</td>
                <td>Nombre</td>
                <td>Punteo</td>
                <td>Renombrar</td>
                <td>Califica</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody id="tbody">
            @forelse($cuadros as $cuadro)
            <tr id="{{$cuadro->idcuadro}}">
                <td data-id="{{$loop->index+1}}">{{$loop->index+1}}</td>
                <td>{{$cuadro->saber}}</td>
                <td>{{$cuadro->nombre}} </td>
                <td>{{$cuadro->punteo}} </td>
                @if($cuadro->renombrar==0)
                <td><span class="badge badge-danger">No</span></td>
                @else
                <td><span class="badge badge-success">Si</span></td>
                @endif @if($cuadro->asesor==0)
                <td>Profesor</td>
                @else
                <td>Asesor</td>
                @endif
                <td>
                    <div class="pull-right">
                        <button type="button" title="Editar" onclick="location.href='{{ route('cuadros.edit', $cuadro->idcuadro) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                    </div>
                </td>
            </tr>
            @empty
            <td class="text-center text-muted" colspan="7"> No existen cuadros registrados para este nivel</td>
            @endforelse

        </tbody>
    </table>
    <div class="col-md-12">
        <form id="ordenform" action="{{route('cuadros.ordenar')}}" class="hide-b" method="POST">
            @csrf
            <textarea name="orden" id="serial" cols="30" rows="10"></textarea>
        </form>

    </div>
</div>
@endsection
 
@section('js')
<script>
    $("#tbody").sortable({
        update: function( event, ui ) {
            var changedList = this.id;
                var order = $(this).sortable('toArray');
                var positions = order.join(';');
                $("#serial").val(positions);
                $("#btn-ordenar").show();
                console.log({
                  id: changedList,
                  positions: positions
                });
            $(this).children().each(function(index) {
                $(this).find('td').first().html(index + 1)
                
            });
        }
    });
    $("#btn-ordenar").click(function(){
        var form=$("#ordenform")
        form.submit();
    });

</script>
@endsection