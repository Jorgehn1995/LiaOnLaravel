@extends('admin.layout') 
@section('title', "Cuadros") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{ route('cuadros.create') }}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Cuadros</button>
</div>
@forelse($niveles as $nivel)
<div class="col-md-12">
    
    <div class="card-box">
        
                    <h4>@yield('title') {{$nivel->nombre}}</h4>

        <hr>
        <table class="table table-hover table-striped wrap" wrap>
            <thead>
                        <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Descripción</td>
                    <td>Ponderación</td>
                    <td>¿Acepta Actividades?</td>
                    <td>Orden</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @forelse($nivel->cuadros as $lev)
                <tr>
                    <td>{{$lev->idcuadro}}</td>
                    <td>{{$lev->nombre}} </td>
                    <td>{{$lev->descripcion}} </td>
                    <td>{{$lev->ponderacion}} </td>
                    @if($lev->autoagregar==0)
                    <td>No</td>
                    @else
                    <td>Si</td>
                    @endif
                    <td>{{$lev->orden}} </td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('cuadros.destroy',  " $lev->idcuadro") }}" method="post"> {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" title="Editar" onclick="location.href='{{ route('cuadros.edit', $lev->idcuadro) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar el cuadro {{$lev->nombre}} del {{$nivel->nombre}}?')"
                                    type="submit"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                    <td class="text-center text-muted" colspan="7"> No existen cuadros registrados para este nivel</td>
                @endforelse

            </tbody>
        </table>
        {{$niveles->render()}}
    </div>
</div>
@empty
<div class="col-md-12">
    <div class="card-box text-center">
        <p> No Existen Grados Registrados</p>
    </div>
</div>

@endforelse
@endsection