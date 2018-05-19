@extends('master.layout') 
@section('title', "Mostar Usuarios") 
@section('content')

<div class="col-md-12 m-b-15">
<button type="button" onclick="location.href='{{route('usuarios.index')}}'" class="btn btn-secondary">Regresar</button>
<button type="button" onclick="location.href='{{ route('usuarios.edit', $usuario->idusuario) }}'" class="btn btn-warning"> Editar</button>
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
                <h4>Mostrando Datos del Usuario {{$usuario->nombre." ".$usuario->apellido}}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('usuarios.update',$usuario->idusuario)}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombres</label>
                                <input disabled type="text" class="form-control" name="nombre" value="{{$usuario->nombre}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido" class="control-label">Apellidos</label>
                                <input disabled type="text" class="form-control" name="apellido" value="{{$usuario->apellido}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="genero" class="control-label">Genero</label>
                                <select disabled name="genero" required id="" class="form-control">
                                    <option value="">Genero</option>

                                    @if($usuario->genero=='m')
                                        <option selected value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    @else
                                    <option  value="m">Masculino</option>
                                    <option selected value="f">Femenino</option>
                                    @endif
                                    
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nacimiento" class="control-label">Nacimiento</label>
                                <input disabled type="date" class="form-control" value="{{$usuario->nacimiento}}" name="nacimiento">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="direccion" class="control-label">Direccion</label>
                                <input disabled type="text" class="form-control" value="{{$usuario->direccion}}" name="direccion">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Telefono</label>
                                <input disabled type="text" class="form-control" value="{{$usuario->telefono}}" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="correo" class="control-label">Correo</label>
                                <input disabled type="email" class="form-control" value="{{$usuario->correo}}" name="correo">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="usuario" class="control-label">Usuario</label>
                                <input disabled type="text" required class="form-control" value="{{$usuario->usuario}}" name="usuario">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="idtipousuario" class="control-label">Tipo Usuario</label>
                                <select disabled name="idtipousuario" class="form-control" id="">
                                     @foreach ($tipousuario as $tp)
                                        @if($usuario->idtipousuario==$tp->idtipousuario)
                                            <option value="{{$tp->idtipousuario}}" selected>{{$tp->tipo}}</option>
                                        @else
                                            <option value="{{$tp->idtipousuario}}">{{$tp->tipo}}</option>
                                        @endif
                                     @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection