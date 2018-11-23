@extends('admin.layout') 
@section('title', "Agregar Profesor") 
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
    <div class="row">
        <div class="col-md-12">
            <h4>@yield('title')</h4>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('profesores.store')}}">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correo" class="control-label">Correo</label>
                            <input type="email" class="form-control" value="{{old('correo')}}" name="correo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" onclick="location.href='{{route('profesores.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i>  Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection