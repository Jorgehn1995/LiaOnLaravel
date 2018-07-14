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
    <form method="POST" class="" action="{{route('alumnos.store')}}">
        @csrf
        <div id="sbox" class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <h6>Codigo Personal</h6>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group">
                                <input type="text" id="busqueda" name="codigo" class="form-control" placeholder="Codigo Personal">
                                <div class="input-group-append">
                                    <button id="buscar" class="btn btn-info waves-effect waves-light" type="button"><i class="ti-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="info" class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <h6>Información del Alumno</h6>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="nombre" value="{{old('nombre')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido" class="control-label">Apellido <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="apellido" value="{{old('apellido')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="genero" class="control-label">Genero <span class="text-danger">*</span></label>
                                <select name="genero" class="form-control" required id="">
                                    @if(old('genero')=="M")
                                        <option selected value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    @else
                                        @if(old('genero')=='F')
                                            <option value="M">Masculino</option>
                                            <option selected value="F">Femenino</option>
                                        @else
                                            <option value="">Selecione un Genero</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        @endif
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nacimiento" class="control-label">Nacimiento <span class="text-danger">*</span></label>
                                <input type="date" required name="nacimiento" class="form-control" value="{{old('nacimiento')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Telefono</label>
                                <input type="text" disabled name="telefono" class="form-control" value="{{old('telefono')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="correo" class="control-label">Correo</label>
                                <input type="text" name="correo" class="form-control" value="{{old('correo')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion" class="control-label">Dirección</label>
                                <input type="text" name="direccion" class="form-control" value="{{old('direccion')}}" id="">
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
                    <h6>Información del Encargado</h6>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="encargado" class="control-label">Nombre y Apellido</label>
                                <input type="text" class="form-control" name="encargado" value="{{old('encargado')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telencargado" class="control-label">Telefono</label>
                                <input type="text" class="form-control" name="telencargado" value="{{old('telencargado')}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="otro" class="control-label">Otros Datos</label>
                                <input type="text" name="otro" class="form-control" value="{{old('otro')}}" id="">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="col-md-12">
                <button type="button" onclick="location.href='{{route('alumnos.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Inscribir</button>
            </div>
        </div>
    </form>
</div>
@endsection