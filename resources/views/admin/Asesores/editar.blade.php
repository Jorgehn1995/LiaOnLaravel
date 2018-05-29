@extends('admin.layout') 
@section('title', "Editar Asesor") 
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
                <h4>Editar Asesor</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('asesores.update',$founds->idasesor)}}">
                    @csrf {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idseccion" class="control-label">Grado</label>
                                <select name="idseccion" required id="" class="form-control">
                                    @foreach($items as $item)
                                        @if($founds->idseccion==$item->idseccion)
                                            <option selected value="{{$item->idseccion}}">{{$item->grado." ".$item->corto." ".$item->letra}}</option>
                                        @else
                                            <option value="{{$item->idseccion}}">{{$item->grado." ".$item->corto." ".$item->letra}}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idusuario" class="control-label">Profesor</label>
                                <select name="idusuario" required id="" class="form-control">
                                    @foreach($usuarios as $usuario)
                                        @if($founds->idusuario==$usuario->idusuario)
                                            <option selected value="{{$usuario->idusuario}}">{{$usuario->nombre." ".$usuario->apellido}}</option>
                                        @else
                                            <option value="{{$usuario->idusuario}}">{{$usuario->nombre." ".$usuario->apellido}}</option>
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
                        <button type="button" onclick="location.href='{{route('asesores.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
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