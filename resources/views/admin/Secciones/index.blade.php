@extends('admin.layout') 
@section('title', "Secciones") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{route('secciones.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar secciones</button>
</div>
<div class="col-md-12">

    <div class="card-box">
        <h4>@yield('title')</h4>

        <hr>
        <table class="table table-hover table-striped wrap" wrap>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nivel</td>
                    <td>Grado</td>
                    <td>Seccion</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                
                @forelse($items as $item)
                
                <tr>
                    <td>{{$item->idseccion}}</td>
                    <td>{{$item->nombre}} </td>
                    <td>{{$item->grado}} </td>
                    <td>{{$item->letra}}</td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('secciones.destroy',  $item->idseccion) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" title="Editar" onclick="location.href='{{ route('secciones.edit', $item->idseccion) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar el la seccion {{$item->letra}} de {{$item->grado}} del {{$item->nombre}}?')"
                                    type="submit"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <td colspan="5">
                    <div class="text-center">No existen niveles registrados</div>
                </td>

                @endforelse
            </tbody>
        </table>
        {{$items->render()}}
    </div>
</div>
@endsection