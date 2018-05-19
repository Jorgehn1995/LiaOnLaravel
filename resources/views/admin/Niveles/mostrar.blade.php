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
    <div class="card-box">
        <div class="row">
            <div class="col-md-12">
                <h4>Editar {{$item->nombre}}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre del Nivel</label>
                                <input disabled type="text" class="form-control" name="nombre" value="{{$item->nombre}}" placeholder="Ejem: Ciclo Básico">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="corto" class="control-label">Nombre Corto del Nivel</label>
                                <input disabled type="text" class="form-control" name="corto" value="{{$item->corto}}" placeholder="Ejem: Básico">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion" class="control-label">Descripción</label>
                                <textarea disabled name="descripcion" id="" class="form-control" rows="5"  placeholder="Agregue una descripción al nivel educativo">{{$item->descripcion}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('niveles.destroy',  $item->idnivel) }}" method="post">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <button type="button" onclick="location.href='{{route('niveles.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                                <button type="button" title="Editar" onclick="location.href='{{ route('niveles.edit', $item->idnivel) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i> Editar</button>
                                <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar a {{$item->nombre}}?')"
                                    type="submit"><i class="ti ti-trash"></i> Eliminar</button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection