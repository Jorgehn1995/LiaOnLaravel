@extends('admin.layout') 
@section('title', "Editar Materia - ".$asignatura->corto) 
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
    <div class="col-md-12">
        <h6 class="portlet-title text-dark">Agregar Materia</h6>
        <hr>
        <form method="POST" action="{{route('asignaturas.update',$asignatura->idasignatura)}}">
            @csrf {{ method_field('PUT') }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre Materia</label>
                        <input type="text" name="nombre" required class="form-control" value="{{$asignatura->nombre}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="corto" class="control-label">Abreviatura de Materia</label>
                        <input type="text" name="corto" required class="form-control" value="{{$asignatura->corto}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="idrol" class="control-label">Docente Asignado</label>
                        <select name="idrol" required id="" class="form-control">
                            <option value="">Seleccionar Profesor</option>
                             @foreach ($profesores as $profesor)
                               @if ($asignatura->idrol==$profesor->idrol)
                                 {{$sl="selected"}}
                                    @else
                                   {{$sl=""}}
                                @endif
                                 <option {{$sl}} value="{{$profesor->idrol}}">{{$profesor->usuario->nombre." ".$profesor->usuario->apellido}}</option>
                                 @endforeach
                              </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="orden" class="control-label">Orden</label>
                        <input type="text" name="orden" class="form-control" value="{{$asignatura->orden}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="estado" class="control-label">Estado</label>
                        <select name="estado" id="" class="form-control">
                            @if($asignatura->estado==1)
                            <option selected value="1"><span class="badge badge-success"> Activo</span></option>
                            <option value="2"><span class="badge badge-danger"> Inactivo</span></option>
                            @else
                            <option value="1"><span class="badge badge-success"> Activo</span></option>
                            <option selected value="2"><span class="badge badge-danger"> Inactivo</span></option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bloqueunico" class="control-label">Bloque Unico</label>
                        <input type="checkbox" name="bloqueunico" @if($asignatura->bloqueunico==1) checked @endif data-plugin="switchery"
                        data-color="#00b19d" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <button type="button" id="delete" data-url="{{route('asignaturas.destroy',$asignatura->idasignatura)}}" class="btn btn-danger"><i class="ti-trash"></i> Eliminar</button>
                        <button type="button" class="btn btn-secondary">|</button>
                        <a href="{{route('asignaturas.index',$asignatura->idgrado)}}" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">

                </div>
            </div>
        </form>
        <form id="formdelete" action="{{ route('asignaturas.destroy', $asignatura->idasignatura) }}" class="hide-b" method="post">
            {{ csrf_field() }} {{ method_field('delete') }}
        </form>
    </div>
</div>
@endsection
 
@section('js')
<script>
    $("#delete").click(function(){
        swal({
            title: '¿Estas seguro de eliminar?',
            text: "Esta acción no se puede revertir",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f0f0f0',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarlo'
        }).then((result) => {
          if (result.value) {
           var form = $("#formdelete"); 
            form.submit();
          }
        })
         
    });

</script>
@endsection