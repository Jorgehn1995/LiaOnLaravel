@extends('admin.layout') 
@section('title', "Grados") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{route('grados.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Grados</button>
</div>
<div class="col-md-12">

    <div class="col-md-12 ">

        <table class="table table-hover table-striped wrap" wrap>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nivel</td>
                    <td>Nombre</td>
                    <td>Seccion</td>
                    <td>Asesor</td>
                    <td>Materias</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>

                @forelse($grados as $grado)
                <tr>
                    <td>0i{{$grado->idinstitucion}}-{{$grado->idgrado}} </td>
                    <td>{{$grado->nivel}} </td>
                    <td>{{$grado->nombre}}</td>
                    <td>{{$grado->seccion}}</td>
                    <td>{{$grado->asesor->usuario->nombre}} {{$grado->asesor->usuario->apellido}}</td>
                    <td>
                        <div class="btn-group text-center">
                            <button type="button" onclick="location.href='{{ route('asignaturas.index', $grado->idgrado) }}'" title="Editar Materias"
                                class="btn btn-warning"><i class="ti-pencil"></i></button>
                        </div>
                    </td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('grados.destroy',  $grado->idgrado) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <div class="btn-group">
                                    <button type="button" title="Editar Grado" onclick="location.href='{{ route('grados.edit', $grado->idgrado) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                    <button class="btn btn-danger" title="Eliminar Grado" onclick="return confirm('¿seguro que deseas eliminar el grado de {{$grado->grado}} del {{$grado->nombre}}?')"
                                        type="submit"><i class="ti ti-trash"></i></button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <td colspan="5">
                    <div class="text-center">No existen grados registrados</div>
                </td>

                @endforelse
            </tbody>
        </table>
        {{$grados->render()}}
    </div>
</div>
@endsection