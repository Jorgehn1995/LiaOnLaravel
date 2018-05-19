@extends('master.layout') 
@section('title', "Agregar Usuarios") 
@section('content')

<div class="col-md-12 m-b-15">

</div>
<div class="col-md-12">
    @if(count($errors)>0)
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @foreach($errors->all() as $error)
        <li> {{$error}}</li> 
        @endforeach
    </div>
    @endif
    <div class="card-box">
        <div class="row">
            <div class="col-md-12">
                <h4>Agregar Usuario</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('usuarios.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombres</label>
                                <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido" class="control-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellido" value="{{old('apellido')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="genero" class="control-label">Genero</label>
                                <select name="genero" required id="" value="{{old('genero')}}" class="form-control">
                                    <option value="">Genero</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nacimiento" class="control-label">Nacimiento</label>
                                <input type="date" class="form-control" value="{{old('nacimiento')}}" name="nacimiento">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="direccion" class="control-label">Direccion</label>
                                <input type="text" class="form-control" value="{{old('direccion')}}" name="direccion">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Telefono</label>
                                <input type="text" class="form-control" value="{{old('telefono')}}" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="correo" class="control-label">Correo</label>
                                <input type="email" class="form-control" value="{{old('correo')}}" name="correo">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="usuario" class="control-label">Usuario</label>
                                <input type="text" required class="form-control" value="{{old('usuario')}}" name="usuario">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password" class="control-label">Contraseña</label>
                                <input type="password" required class="form-control" name="password">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="idtipousuario" class="control-label">Tipo Usuario</label>
                                <select name="idtipousuario" class="form-control" id="">
                                     @foreach ($tipousuario as $tp)
                                        <option value="{{$tp->idtipousuario}}">{{$tp->tipo}}</option>
                                     @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <button type="button" onclick="location.href='{{route('usuarios.index')}}'" class="btn btn-danger">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection