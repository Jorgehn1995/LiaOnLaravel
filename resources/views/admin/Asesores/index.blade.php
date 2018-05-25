@extends('admin.layout') 
@section('title', "Asesores") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{route('asesores.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Asesores</button>
</div>
<div class="col-md-12">

    <div class="card-box">
        <h4>@yield('title')</h4>

        <hr>
        <table class="table table-hover table-striped wrap" wrap>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Grado</td>
                    <td>Seccion</td>
                    <td>Asesor</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                
                @forelse($items as $item)
                
                <tr>
                    <td>{{$item->idasesor}}</td>
                    <td>{{$item->grado." ".$item->corto}} </td>
                    <td>{{$item->letra}} </td>
                    <td>{{$item->nombre." ".$item->apellido}}</td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('asesores.destroy',  $item->idasesor) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" title="Editar" onclick="location.href='{{ route('asesores.edit', $item->idasesor) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar el asesor {{$item->letra}} de {{$item->grado}} del {{$item->nombre}}?')"
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