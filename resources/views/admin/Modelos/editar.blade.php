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
                <h4>Editar Actividad {{$item->nombre}}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('modelos.update',$item->idmodelo)}}">
                    @csrf {{ method_field('PUT') }}
                    <input type="hidden" required class="form-control" name="idnivel" value="{{$nivel->idnivel}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="idcuadro" class="control-label">Cuadro de Calificación</label>
                                    <select name="idcuadro" required id="" class="form-control">
                                        @foreach($cuadros as $cuadro)
                                            @if($item->idcuadro==$cuadro->idcuadro)
                                            <option value="{{$cuadro->idcuadro}}" selected >{{$cuadro->nombre}}</option>
                                            @else
                                            <option value="{{$cuadro->idcuadro}}">{{$cuadro->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre" class="control-label">Nombre de Actividad</label>
                                    <input type="text" required class="form-control" name="nombre" value="{{$item->nombre}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion" class="control-label">Descripción</label>
                                    <textarea name="descripcion" id="" class="form-control" cols="30" rows="3">{{$item->descripcion}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="punteo" class="control-label">Punteo Asignado</label>
                                    <input type="number" required name="punteo" class="form-control" value="{{$item->punteo}}" id="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="orden" class="control-label">Orden</label>
                                    <input type="number" required name="orden" class="form-control" value="{{$item->orden}}" id="">
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="checkbox checkbox-success">
                                    <input id="renombrar" {{$item->renombrar}} name="renombrar" type="checkbox">
                                    <label for="renombrar">Se puede renombrar la actividad</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="checkbox checkbox-success">
                                    <input id="asesor" {{$item->asesor}} name="asesor" type="checkbox">
                                    <label for="asesor">La actividad es solo para asesores</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="location.href='{{route('modelos.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection