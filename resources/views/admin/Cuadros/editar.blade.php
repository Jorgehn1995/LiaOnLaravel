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
                <h4>Editar {{$item->grado}}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('grados.update',$item->idgrado)}}">
                    @csrf {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="orden" class="control-label">Orden</label>
                                <input type="number" required class="form-control" name="orden" value="{{$item->orden}}" placeholder="Se utiliza para ordenar los grados">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="grado" class="control-label">Grado</label>
                                <input type="text" required name="grado" class="form-control" value="{{$item->grado}}">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idnivel" class="control-label">Nivel Educativo</label>
                                <select name="idnivel" required id="" class="form-control">
                                    @foreach($niveles as $nivel)
                                        @if($item->idnivel==$nivel->idnivel)
                                            <option selected value="{{$nivel->idnivel}}">{{$nivel->nombre}}</option>
                                        @else
                                            <option value="{{$nivel->idnivel}}">{{$nivel->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>

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