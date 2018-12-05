@extends('admin.layout') 
@section('title', "Agregar Nivel Educativo") 
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
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <h6>Editar {{$grado->grado}}</h6>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('grados.update',$grado->idgrado)}}">
                    @csrf {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-4 hidden-b">
                            <div class="form-group">
                                <label for="idrol" class="control-label">Encargado / Asesor</label>
                                <select name="idrol" required class="form-control" id="">
                                    <option value=""> Seleccione un Profesor</option>
                                    @foreach ($profesores as $profesor)
                                        @if($grado->idrol==$profesor->idrol) <option selected value="{{$profesor->idrol}}">{{$profesor->usuario->nombre}} {{$profesor->usuario->apellido}}</option>@else<option value="{{$profesor->idrol}}">{{$profesor->usuario->nombre}} {{$profesor->usuario->apellido}}</option> @endif
                                    @endforeach
                                    </select>
                                <input type="hidden" required class="form-control" name="orden" value="1" placeholder="Se utiliza para ordenar los grados">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nivel" class="control-label">Nivel</label>
                                <select name="nivel" required id="" class="form-control">
                                                        <option value="">Seleccionar Nivel Educativo</option>
                                                        @if($grado->idnivel=="0")
                                                        <option selected value="0">Pre-Primario / Preescolar</option>@else
                                                        <option value="0">Pre-Primario</option>@endif
                    
                                                        @if($grado->idnivel=="1")
                                                        <option selected value="1">Primaria</option>@else
                                                        <option value="1">Primaria</option>@endif
                    
                                                        @if($grado->idnivel=="2")
                                                        <option selected value="2">Básico / Secundaria</option>@else
                                                        <option value="2">Básico / Secundaria</option>@endif
                    
                                                        @if($grado->idnivel=="3")
                                                        <option selected value="3">Diversificado / Preparatoria</option>@else
                                                        <option value="3">Diversificado / Preparatoria</option>@endif
                    
                                                        @if($grado->idnivel=="4")
                                                        <option selected value="4">Curso</option>@else
                                                        <option value="4">Curso</option>@endif
                                                    </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="grado" class="control-label">Nombre del Grado</label>
                                <input type="text" required name="grado" placeholder="Ejemplo: Primer Grado Básico" class="form-control" value="{{$grado->nombre}}"
                                    id="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="corto" class="control-label">Nombre Corto</label>
                                <input type="text" required name="corto" class="form-control" placeholder="Ejemplo: Primero Básico" value="{{$grado->corto}}"
                                    id="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="seccion" class="control-label">Sección</label>
                                <input type="text" name="seccion" required placeholder="Ejemplo: A" value="{{$grado->seccion}}" class="form-control">
                            </div>
                        </div>
                    </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="button" onclick="location.href='{{route('grados.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
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