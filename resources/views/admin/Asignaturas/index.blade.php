@extends('admin.layout') 
@section('title', "Materias -".$grado->nombre." ".$grado->seccion) 
@section('content')
<div class="col-md-12 mb-3 panelgrados">
    <div class="row">
        <div class="col-md-12">
            <label for="grados">Seleccione un Grado</label>

            <div class="input-group">
                <select name="" id="selectGrados" class="form-control">
                    <option value="">Selecciona un Grado</option>
                    @foreach ($grados as $g)
                    @if ($g->idgrado==$grado->idgrado)
                        <option selected value="{{route('asignaturas.index',$g->idgrado)}}">{{$g->nombre}} {{$g->seccion}}</option>
                    @else
                        <option value="{{route('asignaturas.index',$g->idgrado)}}">{{$g->nombre}} {{$g->seccion}}</option>
                    @endif
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-info waves-effect waves-light" id="mostrar" type="button">Mostrar Materias</button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-md-12 panelingreso " style="display:none;">
    <h6 class="portlet-title text-dark">Agregar Materia</h6>
    <hr>
    <form method="POST" action="{{route('asignaturas.store',$grado->idgrado)}}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre Materia</label>
                    <input type="text" name="nombre" required class="form-control" value="{{old('nombre')}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="corto" class="control-label">Abreviatura de Materia</label>
                    <input type="text" name="corto" required class="form-control" value="{{old('corto')}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="idrol" class="control-label">Docente Asignado</label>
                    <select name="idrol" required id="" class="form-control">
                        <option value="">Seleccionar Profesor</option>
                        @foreach ($profesores as $profesor)
                            @if (old('idrol')==$profesor->idrol)
                                {{$sl="selected"}}
                            @else
                                {{$sl=""}}
                            @endif
                            <option {{$sl}} value="{{$profesor->idrol}}">{{$profesor->usuario->nombre." ".$profesor->usuario->apellido}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="orden" class="control-label">Orden</label>
                    <input type="text" name="orden" class="form-control" value="{{old('orden')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bloqueunico" class="control-label">Bloque Unico</label>
                    <input type="checkbox" name="bloqueunico" {{old( 'bloqueunico')}} data-plugin="switchery" data-color="#00b19d" />
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="btn-group pull-right">

                    <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="col-md-12 m-t-15">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                @yield('title')
            </h3>
            <div class="portlet-widgets">
                <a data-toggle="collapse" class="btn btn-secondary" data-parent="#accordion{{$grado->idgrado}}" href="#grado{{$grado->idgrado}}"><i class="ion-minus-round text-light"></i></a>
                <span class="divider"></span>
                <button type="button" class="btn btn-secondary" onclick="location.href='{{route('grados.index')}}'"><i class="ti-arrow-left"></i> Regresar</button>
                <button type="button" id="btnagregar" class="btn btn-success" data-flag="true"><i class="ti-plus"></i> Agregar Asignatura</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="grado{{$grado->idgrado}}" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped wrap" wrap>
                    <thead>
                        <tr>
                            <td>Orden</td>
                            <td>Nombre</td>
                            <td>Abreviatura</td>
                            <td>Docente</td>
                            <td>Estado</td>
                            <td>Bloque Unico</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asignaturas as $asignatura)
                        <tr>
                            <td>{{$asignatura->orden}}</td>
                            <td>{{$asignatura->nombre}}</td>
                            <td>{{$asignatura->corto}}</td>
                            <td>{{$asignatura->rol->usuario->nombre}} {{$asignatura->rol->usuario->apellido}}</td>
                            <td class="text-center">
                                @if($asignatura->estado==1) <span class="badge badge-success"><i class="ti-check"></i></span>@else
                                <span class="badge badge-danger"><i class="ti-close"></i></span> @endif
                            </td>
                            <td class="text-center">
                                @if($asignatura->bloqueunico==1) <span class="badge badge-success"><i class="ti-check"></i></span>@else
                                <span class="badge badge-danger"><i class="ti-close"></i></span> @endif
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button class="btn btn-warning" onclick="location.href='{{route('asignaturas.edit',$asignatura->idasignatura)}}'"><i class="ti-pencil"></i></button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No se encontró ninguna asignatura</td>
                        </tr> @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('js')
<script>
    $("#btnagregar").click(function(){
        $(".panelingreso").toggle();
        $(".panelgrados").toggle();
        if($(this).data("flag")=="true"){
            $(this).html('<i class="ti-plus"></i> Agregar Asignatura');
            $(this).data("flag","false");
            $(this).removeClass('btn-danger'); 
            $(this).addClass('btn-success');
        }else{
            $(this).html('<i class="ti-close"></i> Cancelar');
            $(this).data("flag","true");
            $(this).removeClass('btn-success');
            $(this).addClass('btn-danger');
            
        }
        
    });
    $("#mostrar").click(function(){
        var url=$("#selectGrados").val();
        if(url==""){
            swal({
            title: 'Seleccione un grado',
            text: "Seleccione un grado valido para proceder",
            type: 'warning',
            })
        }else{
            location.href=url;
        }
        
    });

</script>
@endsection