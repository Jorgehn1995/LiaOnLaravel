@extends('admin.layout') 
@section('title', "Niveles Educativos") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{route('niveles.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Nivel o Carrera</button>
</div>
<div class="col-md-12">

    <div class="card-box">
        <h4>@yield('title')</h4>

        <hr>
        <table class="table table-hover table-striped wrap" wrap >
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Corto</td>
                    <td>Descripción</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>

                @forelse($niveles as $nivel)
                <tr>
                    <td>{{$nivel->idnivel}}</td>
                    <td>{{$nivel->nombre}}</td>
                    <td>{{$nivel->corto}}</td>
                    <td >{{substr($nivel->descripcion,0,50).'...'}}</td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('niveles.destroy',  $nivel->idnivel) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" title="" onclick="location.href='{{ route('niveles.show', $nivel->idnivel) }}'" class="btn btn-primary"><i class="ti ti-layers-alt"></i></button>
                                <button type="button" title="Editar" onclick="location.href='{{ route('niveles.edit', $nivel->idnivel) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar a {{$nivel->nombre}}?')" type="submit"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <td colspan="5"><div class="text-center">No existen niveles registrados</div></td>

                @endforelse
            </tbody>
        </table>
        {{$niveles->render()}}
    </div>
</div>
@endsection