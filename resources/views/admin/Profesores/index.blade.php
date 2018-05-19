@extends('admin.layout') 
@section('title', "Profesores") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{route('profesores.create')}}'" class="btn btn-success">Agregar @yield('title')</button>
</div>
<div class="col-md-12">

    <div class="card-box">
        <h4>@yield('title')</h4>

        <hr>
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Tipo Usuario</td>
                    <td>Usuario</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>

                @forelse($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->idusuario}}</td>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{$usuario->apellido}}</td>
                    <td>
                        <span class="badge badge-{{$usuario->tipo->color}}"> {{$usuario->tipo->tipo}}</span>

                    </td>
                    <td>{{$usuario->usuario}}</td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('profesores.destroy',  $usuario->idusuario) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" onclick="location.href='{{ route('profesores.show', $usuario->idusuario) }}'" class="btn btn-primary"><i class="ti ti-user"></i></button>
                                <button type="button" onclick="location.href='{{ route('profesores.edit', $usuario->idusuario) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-danger" onclick="return confirm('¿seguro que deseas eliminar a {{$usuario->nombre}}?')" type="submit"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="6"><p>No existen profesores registrados</p></td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$usuarios->render()}}
    </div>
</div>
@endsection