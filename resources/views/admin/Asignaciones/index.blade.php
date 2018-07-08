@extends('admin.layout') 
@section('title', "Asignaciones") 
@section('content')
<div class="col-md-12">
    <div class="alert alert-secondary fade show m-b-0">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        <h5 class="text-secondary">Importante</h5>
        <p class="text-secondary">
            Una vez se empieza a calificar no podras eliminar la asignacion, solo podrás cambiar de profesor para impartir la materia
        </p>

    </div>

</div>
@forelse($niveles as $nivel) @forelse($nivel->grados as $grado)


<div class="col-md-12 m-t-15">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                @yield('title') para {{$grado->grado." ".$nivel->corto}}
            </h3>
            <div class="portlet-widgets">
                <a data-toggle="collapse" class="btn btn-secondary" data-parent="#accordion{{$nivel->idnivel}}" href="#grado{{$grado->idgrado}}"><i class="ion-minus-round text-light"></i></a>
                <span class="divider"></span>
                <button type="button" onclick="location.href='{{ route('asignaciones.create')."/".$grado->idgrado}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Asignatura</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="grado{{$grado->idgrado}}" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped wrap" wrap>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Asignatura</td>
                            <td>Profesor</td>
                            <td>Seccion</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grado->asignaturas as $asignatura) @foreach($asignatura->asignaciones as $asignacion)
                        <tr>
                            <td>{{$asignacion->idasignacion}}</td>
                            <td>{{$asignatura->nombre}}</td>
                            <td>{{$asignacion->profesor->nombre." ".$asignacion->profesor->nombre}}</td>

                            <td>{{$asignacion->seccion->letra}}</td>
                            <td>
                                <div class="pull-right">
                                    <form action="{{ route('asignaciones.destroy',  $asignacion->idasignacion) }}" method="post"> {{ csrf_field() }} {{ method_field('delete') }}
                                        <button type="button" title="Editar" onclick="location.href='{{ route('asignaciones.edit', $asignacion->idasignacion) }}'"
                                            class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                        <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar la asignatura {{$asignatura->nombre}} del grado {{$grado->grado."
                                            ".$nivel->corto}}?')" type="submit"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach @empty
                        <tr>
                            <td colspan="9">No se encontró ninguna asignatura</td>
                        </tr> @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@empty
<div class="col-md-12">
    <div class="card-box text-center">
        <p> No existen grados registrados para <strong>{{$nivel->nombre}}</strong></p>
    </div>
</div>

@endforelse @empty
<div class="col-md-12">
    <div class="card-box text-center">
        <p> No Existen Grados Registrados</p>
    </div>
</div>

@endforelse
@endsection