@extends('master.layout') 
@section('title', "Usuarios") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{route('usuarios.create')}}'" class="btn btn-success">Agregar Usuario</button>
</div>
<div class="col-md-12">

    <div class="card-box">
        <h4>Usuarios</h4>

        <hr>
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>TipoUsuario</td>
                    <td>Usuario</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>

                @foreach($usuarios as $usuario)
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
                            <form action="{{ route('usuarios.destroy',  $usuario->idusuario) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" onclick="location.href='{{ route('usuarios.show', $usuario->idusuario) }}'" class="btn btn-primary"><i class="ti ti-user"></i></button>
                                <button type="button" onclick="location.href='{{ route('usuarios.edit', $usuario->idusuario) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-danger" onclick="return confirm('¿seguro que deseas eliminar a {{$usuario->nombre}}?')" type="submit"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$usuarios->render()}}
    </div>
</div>
@endsection