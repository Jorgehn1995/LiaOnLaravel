@extends('admin.layout') 
@section('title', "Asignaciones") 
@section('content')
<div class="col-md-12">
    <div class="alert alert-danger fade show m-b-0">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        <h5 class="text-secondary">Importante</h5>
        <p class="text-secondary">
            Una vez se empieza a calificar no podras eliminar la asignacion, solo podrás cambiar de profesor para impartir la materia
        </p>

    </div>

</div>
@forelse($grados as $grado)


<div class="col-md-12 m-t-15">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                @yield('title') {{$grado->corto}} {{$grado->seccion}}
            </h3>
            <div class="portlet-widgets">
                <a data-toggle="collapse" class="btn btn-secondary" data-parent="#accordion{{$grado->idgrado}}" href="#grado{{$grado->idgrado}}"><i class="ion-minus-round text-light"></i></a>
                <span class="divider"></span>
                <button type="button" onclick="location.href='{{ route('asignaciones.create')." / ".$grado->idgrado}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar Asignatura</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="grado{{$grado->idgrado}}" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped wrap" wrap>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre Materia</td>
                            <td>Profesor</td>
                            <td>Bloques</td>
                            <td>Asesores</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>

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