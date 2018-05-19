@extends('admin.layout') 
@section('title', "Grados") 
@section('content')

<div class="col-md-12 m-b-15">
    <button type="button" onclick="location.href='{{route('grados.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Grados</button>
</div>
<div class="col-md-12">

    <div class="card-box">
        <h4>@yield('title')</h4>

        <hr>
        <table class="table table-hover table-striped wrap" wrap>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Orden</td>
                    <td>Grado</td>
                    <td>Nivel</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody>

                @forelse($niveles as $nivel)
                
                @foreach($nivel->grados as $lev)
                <tr>
                    <td>{{$lev->idgrado}}</td>
                    <td>{{$lev->orden}} </td>
                    <td>{{$lev->grado}} </td>
                    
                    <td>{{$nivel->nombre}}</td>
                    <td>
                        <div class="pull-right">
                            <form action="{{ route('grados.destroy',  $lev->idgrado) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" title="Editar" onclick="location.href='{{ route('grados.edit', $lev->idgrado) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                            <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar el grado de {{$lev->grado}} del {{$nivel->nombre}}?')"
                                    type="submit"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
               
                @endforeach 
                @empty
                <td colspan="5">
                    <div class="text-center">No existen niveles registrados</div>
                </td>

                @endforelse
            </tbody>
        </table>
        {{$niveles->render()}}
    </div>
</div>
@endsection