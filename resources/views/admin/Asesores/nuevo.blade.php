@extends('admin.layout') 
@section('title', "Agregar Grado") 
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
                <form method="POST" action="{{route('secciones.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="letra" class="control-label">Letra</label>
                                <input type="text" required class="form-control" name="letra" max="1" value="{{old('letra')}}" placeholder="Letra para la sección">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombresec" class="control-label">Descripción</label>
                                <input type="text" class="form-control" name="nombresec" value="{{old('nombresec')}}" placeholder="Descripción de la sección">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idgrado" class="control-label">Grado</label>
                                <select name="idgrado" required id="" class="form-control">
                                    @foreach($items as $item)
                                        <option value="{{$item->idgrado}}">{{$item->grado." ".$item->corto}}</option>
                                    @endforeach
                                </select>
                            
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="location.href='{{route('secciones.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection