@extends('admin.layout') 
@section('title', "Editar Actividad Obligatoria") 
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
                <h4>Editar Asignatura {{$item->nombre}}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('asignaturas.update',$item->idasignatura)}}">
                    @csrf {{ method_field('PUT') }}
                    <input type="hidden" required class="form-control" name="idgrado" value="{{$item->idgrado}}">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre</label>
                                <input type="text" required class="form-control" name="nombre" value="{{$item->nombre}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="corto" class="control-label">Nombre Corto</label>
                                <input type="text" required class="form-control" name="corto" value="{{$item->corto}}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="orden" class="control-label">Orden</label>
                                <input type="number" required name="orden" class="form-control" value="{{$item->orden}}" id="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <div class="checkbox checkbox-success">
                                <input id="mostrar" {{$item->mostrar}} name="mostrar" type="checkbox">
                                <label for="mostrar">Se muestra en la ficha</label>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="checkbox checkbox-success">
                                <input id="activo" {{$item->activo}} name="activo" type="checkbox">
                                <label for="activo">La asignatura se encuentra activa</label>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="location.href='{{route('asignaturas.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection