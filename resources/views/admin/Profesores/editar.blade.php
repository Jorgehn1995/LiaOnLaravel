@extends('master.layout') 
@section('title', "Editar Usuarios") 
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
                <h4>Editar Usuario {{$usuario->nombre." ".$usuario->apellido}}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('profesores.update',$usuario->idusuario)}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombres</label>
                                <input type="text" class="form-control" name="nombre" value="{{$usuario->nombre}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido" class="control-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellido" value="{{$usuario->apellido}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="genero" class="control-label">Genero</label>
                                <select name="genero" required id="" class="form-control">
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
                                <input type="date" class="form-control" value="{{$usuario->nacimiento}}" name="nacimiento">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="direccion" class="control-label">Direccion</label>
                                <input type="text" class="form-control" value="{{$usuario->direccion}}" name="direccion">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Telefono</label>
                                <input type="text" class="form-control" value="{{$usuario->telefono}}" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="correo" class="control-label">Correo</label>
                                <input type="email" class="form-control" value="{{$usuario->correo}}" name="correo">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="usuario" class="control-label">Usuario</label>
                                <input type="text" required class="form-control" value="{{$usuario->usuario}}" name="usuario">
                            </div>
                        </div>

                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" onclick="location.href='{{route('profesores.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection