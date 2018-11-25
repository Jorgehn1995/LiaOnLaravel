@extends('admin.layout') 
@section('title', "Profesores") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{route('profesores.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar @yield('title')</button>
</div>
<div class="col-md-12">

    <div class="">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Tipo Usuario</td>
                    <td>Usuario</td>
                    <td>Estado</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @forelse($profesores as $profesor)
                <tr>
                    <td>{{$profesor->usuario->idusuario}}</td>
                    <td>{{$profesor->usuario->nombre}}</td>
                    <td>{{$profesor->usuario->apellido}}</td>
                    <td>
                        <span class="badge badge-{{$profesor->usuario->tipo->color}}"> {{$profesor->usuario->tipo->tipo}}</span>
                    </td>
                    <td>{{$profesor->usuario->usuario}}</td>
                    @if ($profesor->estado==1)
                    <td><span class="badge badge-success"> Activo</span></td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('profesores.destroy',  $profesor->idrol) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" onclick="location.href='{{ route('profesores.show', $profesor->usuario->idusuario) }}'" class="btn btn-primary"><i class="ti ti-user"></i></button>
                                <button type="button" onclick="location.href='{{ route('profesores.password', $profesor->usuario->idusuario) }}'" title="Restablecer Contraseña"
                                    class="btn btn-secondary"><i class="ti ti-lock"></i></button>
                                <button type="button" onclick="location.href='{{ route('profesores.edit', $profesor->usuario->idusuario) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-danger" onclick="return confirm('¿seguro que deseas inactivar a {{$profesor->usuario->nombre}}?')"
                                    type="submit"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                    @else
                    <td><span class="badge badge-danger"> Inactivo</span></td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('profesores.destroy',  $profesor->idrol) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" onclick="location.href='{{ route('profesores.show', $profesor->usuario->idusuario) }}'" class="btn btn-primary"><i class="ti ti-user"></i></button>
                                <button type="button" onclick="location.href='{{ route('profesores.password', $profesor->usuario->idusuario) }}'" title="Restablecer Contraseña"
                                    class="btn btn-secondary"><i class="ti ti-lock"></i></button>
                                <button type="button" onclick="location.href='{{ route('profesores.edit', $profesor->usuario->idusuario) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-success" onclick="return confirm('¿seguro que deseas activar a {{$profesor->usuario->nombre}}?')"
                                    type="submit"><i class="ti ti-plus"></i></button>
                            </form>
                        </div>
                    </td>
                    @endif

                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="7">
                        <p>No existen profesores registrados</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$profesores->render()}}
    </div>
</div>
@endsection
 
@section('js')
<script>

</script>
@endsection