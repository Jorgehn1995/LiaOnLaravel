@extends('admin.layout') 
@section('title', "Editar Asignación") 
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
    <div class="card-box">
        <div class="row">
            <div class="col-md-12">
                <h4>@yield('title') a {{$grado->grado." ".$grado->nivel->corto}}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('asignaciones.update',$item->idasignacion)}}">
                    @csrf {{ method_field('PUT') }}
                    <input type="hidden" required class="form-control" name="idgrado" value="{{$grado->idgrado}}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idasignatura" class="control-label">Nombre</label>
                                <select name="idasignatura" class="form-control" id="">
                                    @foreach($grado->asignaturas as $asignatura)
                                        @if($asignatura->idasignatura==$item->idasignatura)
                                            <option value="{{$asignatura->idasignatura}}" selected >{{$asignatura->nombre}}</option>
                                        @else
                                            <option value="{{$asignatura->idasignatura}}">{{$asignatura->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="idusuario" class="control-label">Profesor a Cargo </label>
                                <select name="idusuario" class="form-control" id="">
                                    @foreach($usuarios as $usuario)
                                        @if($usuario->idusuario==$item->idusuario)
                                            <option selected value="{{$usuario->idusuario}}">{{$usuario->nombre." ".$usuario->apellido}}</option>
                                        @else
                                            <option value="{{$usuario->idusuario}}">{{$usuario->nombre." ".$usuario->apellido}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idseccion" class="control-label">Seccion</label>
                                <select name="idseccion" class="form-control" id="">
                                    @foreach($grado->secciones as $seccion)
                                        @if($seccion->idseccion==$item->idseccion)
                                            <option selected value="{{$seccion->idseccion}}">{{$seccion->letra}}</option>
                                        @else
                                            <option value="{{$seccion->idseccion}}">{{$seccion->letra}}</option>
                                        @endif  
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="location.href='{{route('asignaciones.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection