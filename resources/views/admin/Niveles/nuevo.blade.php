@extends('admin.layout') 
@section('title', "Agregar Nivel Educativo") 
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
                <h4>@yield('title')</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('niveles.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre del Nivel</label>
                                <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}" placeholder="Ejem: Ciclo Básico">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="corto" class="control-label">Nombre Corto del Nivel</label>
                            <input type="text" class="form-control" name="corto" value="{{old('corto')}}" placeholder="Ejem: Básico">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion" class="control-label">Descripción</label>
                                <textarea name="descripcion" id="" class="form-control" rows="5" value="{{old('descripcion')}}" placeholder="Agregue una descripción al nivel educativo"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="location.href='{{route('niveles.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection