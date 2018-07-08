@extends('admin.layout') 
@section('title', "Asignaturas") 
@section('content') @forelse($niveles as $nivel) @forelse($nivel->grados as $grado)
<div class="col-md-12 m-t-15">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                @yield('title') para {{$grado->grado." ".$nivel->corto}}
            </h3>
            <div class="portlet-widgets">
                <a data-toggle="collapse" class="btn btn-secondary" data-parent="#accordion{{$nivel->idnivel}}" href="#grado{{$grado->idgrado}}"><i class="ion-minus-round text-light"></i></a>
                <span class="divider"></span>
                <button type="button" onclick="location.href='{{ route('asignaturas.create')."/".$grado->idgrado}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Asignatura</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="grado{{$grado->idgrado}}" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped wrap" wrap>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Orden</td>
                            <td>Nombre de Materia</td>
                            <td>Nombre Corto de Materia</td>
                            <td>Se muestra en la ficha</td>
                            <td>Estado</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grado->asignaturas as $asignatura) 
                        <tr>
                            <td>{{$asignatura->idasignatura}}</td>
                            <td>{{$asignatura->orden}}</td>
                            <td>{{$asignatura->nombre}}</td>
                            <td>{{$asignatura->corto}}</td>
                            <td>
                                    @if($asignatura->mostrar) <span class="badge badge-success"><i class="ti-check"></i></span>@else <span class="badge badge-danger"><i class="ti-close"></i></span> @endif
                            </td>
                            <td>
                                    @if($asignatura->activo) <span class="badge badge-success">Activo</span>@else <span class="badge badge-danger">Inactivo</span> @endif
                            </td>
                            <td>
                                <div class="pull-right">
                                    <form action="{{ route('asignaturas.destroy',  $asignatura->idasignatura) }}" method="post"> {{ csrf_field() }} {{ method_field('delete') }}
                                        <button type="button" title="Editar" onclick="location.href='{{ route('asignaturas.edit', $asignatura->idasignatura) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                        <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar la asignatura {{$asignatura->nombre}} del grado {{$grado->grado." ".$nivel->corto}}?')"
                                            type="submit"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr> 
                        @empty
                        <tr>
                            <td colspan="9">No se encontró ninguna asignatura</td>
                        </tr> @endforelse

                    </tbody>
                </table>
                {{$niveles->render()}}
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