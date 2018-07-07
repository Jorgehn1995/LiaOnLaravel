@extends('admin.layout') 
@section('title', "Actividades Obligatorias") 
@section('content') @forelse($niveles as $nivel)
<div class="col-md-12 m-t-15">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                @yield('title') {{$nivel->nombre}}
            </h3>
            <div class="portlet-widgets">
            <a data-toggle="collapse" class="btn btn-secondary" data-parent="#accordion{{$nivel->idnivel}}" href="#nivel{{$nivel->idnivel}}"><i class="ion-minus-round text-light"></i></a>
                <span class="divider"></span>
                <button type="button" onclick="location.href='{{ route('modelos.create')."/".$nivel->idnivel }}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Actividad</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="nivel{{$nivel->idnivel}}" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped wrap" wrap>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Cuadro de Calificación</td>
                            <td>Nombre de Actividad</td>
                            
                            <td>Punteo Asignado</td>
                            <td><i data-toggle="tooltip" data-placement="top" title="Indica si los profesores pueden cambiarle de nombre a la actividad"
                                    class="ti-info-alt"></i>Renombrar</td>
                            <td><i data-toggle="tooltip" data-placement="top" title="Indica si solo los asesores pueden calificar la actividad"
                                    class="ti-info-alt"></i>Asesores</td>
                            <td>Orden</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nivel->cuadros as $cuadro) 
                        @foreach($cuadro->modelos as $modelo)
                        <tr>
                                <td>{{$modelo->idmodelo}}</td>
                                <td>{{$cuadro->nombre}} </td>
                                <td>{{$modelo->nombre}}</td>
                                
                                <td>{{$modelo->punteo}}</td>
                                <td>
                                    @if($modelo->renombrar) <span class="badge badge-success"><i class="ti-check"></i></span>@else <span class="badge badge-danger"><i class="ti-close"></i></span> @endif
                                </td>
                                <td>
                                    @if($modelo->asesor) <span class="badge badge-success"><i class="ti-check"></i></span>@else <span class="badge badge-danger"><i class="ti-close"></i></span> @endif
                                </td>
                                <td>{{$modelo->orden}}</td>
                                <td>
                                    <div class="pull-right">
                                        <form action="{{ route('modelos.destroy',  $modelo->idmodelo) }}" method="post"> {{ csrf_field() }} {{ method_field('delete') }}
                                            <button type="button" title="Editar" onclick="location.href='{{ route('modelos.edit', $modelo->idmodelo) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                            <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar el cuadro {{$modelo->nombre}} del {{$nivel->nombre}}?')"
                                                type="submit"><i class="ti ti-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
    
                        @endforeach                        
                        @empty <tr><td colspan="9">No se encontro ninguna actividad</td></tr> @endforelse

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
        <p> No Existen Grados Registrados</p>
    </div>
</div>

@endforelse
@endsection