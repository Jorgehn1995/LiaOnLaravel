@extends('admin.layout') 
@section('title', "Agregar Alumno") 
@section('content')

<div class="col-md-12 m-b-15">


</div>
<div class="col-md-12">
    @if(count($errors)>0)
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> @foreach($errors->all() as
        $error)
        <li> {{$error}}</li>
        @endforeach
    </div>
    @endif
    <form method="POST" class="" action="{{route('alumnos.update',$inscripcion->idinscripcion)}}">
        @csrf {{ method_field('PUT') }}
        <div class="row">
            <div class="col-md-12">
                <div id="info" class="">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Información del Alumno</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre" class="control-label">Codigo Personal <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" name="codigo" value="{{$inscripcion->codigo}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" required class="form-control" name="nombre" value="{{$inscripcion->nombre}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido" class="control-label">Apellido <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="apellido" value="{{$inscripcion->apellido}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="genero" class="control-label">Genero <span class="text-danger">*</span></label>
                                        <select name="genero" class="form-control" required id="">
                                            @if($inscripcion->genero=="m")
                                                <option selected value="m">Masculino</option>
                                                <option value="f">Femenino</option>
                                            @else
                                                @if($inscripcion->genero=='f')
                                                    <option value="m">Masculino</option>
                                                    <option selected value="f">Femenino</option>
                                                @else
                                                    <option value="">Selecione un Genero</option>
                                                    <option value="m">Masculino</option>
                                                    <option value="f">Femenino</option>
                                                @endif
                                            @endif
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nacimiento" class="control-label">Nacimiento <span class="text-danger">*</span></label>
                                        <input type="date" required name="nacimiento" class="form-control" value="{{$inscripcion->nacimiento}}" id="">
                                    </div>
                                </div>
                                <div class="col-md-4 hide-b">
                                    <div class="form-group">
                                        <label for="telefono" class="control-label">Telefono</label>
                                        <input type="text" disabled name="telefono" class="form-control" value="{{$inscripcion->telefono}}" id="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="idestado" class="control-label">Estado Actual (Activo/Retirado)</label>
                                        <select name="idestado" class="form-control" id="">
                                                @if($inscripcion->idestado==1)
                                                <option selected value="1">Activo</option>
                                                <option value="2">Retirado</option>
                                                @else
                                                <option value="1">Activo</option>
                                                <option selected value="2">Retirado</option>
                                                @endif
                                                
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="direccion" class="control-label">Dirección</label>
                                        <input type="text" name="direccion" class="form-control" value="{{$inscripcion->direccion}}" id="">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <p><small>(<span class="text-danger">*</span>) Datos Obligatorios</small></p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Información de Inscripción</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="otro" class="control-label">Ciclo Escolar</label>
                                        <input type="text" disabled name="otro" class="form-control" value="{{$inscripcion->ciclo}}" id="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="idgrado" class="control-label">Grado <span class="text-danger">*</span></label>
                                        <select name="idgrado" class="form-control" data-idseccion="{{$inscripcion->idseccion}}" required data-route="{{route('jsonGrados')}}"
                                            data-seccionroute="{{route('jsonSecciones')}}" id="selectGrados">
                                                @forelse($grados as $grado)
                                                    @if($grado->idgrado==$inscripcion->idgrado)
                                                    <option selected value="{{$grado->idgrado}}">{{$grado->nombre." ".$grado->seccion}}</option>
                                                    @else
                                                    <option value="{{$grado->idgrado}}">{{$grado->nombre." ".$grado->seccion}}</option>
                                                    @endif
                                                @empty
                                                    <option selected value="">No existen grados registrados</option>
                                                @endforelse
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="encargado" class="control-label">Encargado</label>
                                        <input type="text" class="form-control" name="encargado" value="{{$inscripcion->encargado}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telencargado" class="control-label">Telefono</label>
                                        <input type="text" class="form-control" name="telencargado" value="{{$inscripcion->contacto}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="otro" class="control-label">Otros Datos</label>
                                        <input type="text" name="otro" class="form-control" value="{{$inscripcion->comentario}}" id="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12 ">
                <div class="btn-group pull-right">
                    <button type="button" onclick="location.href='{{route('alumnos.index')}}'" class="btn btn-dark"><i class="ti-arrow-left"></i> Regresar</button>
                    <button type="submit" class="btn btn-success"><i class="ti-save"></i> Actualizar</button>
                </div>
            </div>
        </div>
    </form>
    <div class="col-md-4 ">
        <form action="{{ route('alumnos.destroy',  $inscripcion->idinscripcion) }}" method="post"> {{ csrf_field() }} {{ method_field('delete') }}
            <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar la inscripcion del alumno {{$inscripcion->nombre."
                ".$inscripcion->apellido}}?')" type="submit"><i class="ti ti-trash"></i> Eliminar</button>
        </form>

    </div>

</div>
@endsection
 
@section('js')
<script>
    //$("#selectGrados").change(function() {
    //    cargarseccion();
    //});
    //cargarseccion($("#selectGrados").data("idseccion"));

</script>
@endsection