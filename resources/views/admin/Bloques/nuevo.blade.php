@extends('admin.layout') 
@section('title', "Agregar Bloque de Calificación") 
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
            <h6>@yield('title')</h6>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('bloques.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="bloque" class="control-label">Bloque</label>
                            <select name="bloque" required id="" class="form-control">
                                @for ($i = 1; $i <= 4; $i++)
                                    <option value="{{$i}}">Bloque {{$i}}</option>
                                @endfor
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" required class="form-control" name="nombre" value="{{old('nombre')}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="porcentaje" class="control-label">Porcentaje</label>
                            <input type="number" name="porcentaje" class="form-control" value="{{old('porcentaje')}}" id="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h6>Visualizaciones</h6>
                        <hr>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="profesor" class="control-label">Profesor</label>
                            <input type="checkbox" name="profesor" data-plugin="switchery" data-color="#00b19d" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="alumno" class="control-label">Alumno</label>
                            <input type="checkbox" name="alumno" data-plugin="switchery" data-color="#00b19d" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="padre" class="control-label">Padre</label>
                            <input type="checkbox" name="padre" data-plugin="switchery" data-color="#00b19d" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" onclick="location.href='{{route('bloques.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                        <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection