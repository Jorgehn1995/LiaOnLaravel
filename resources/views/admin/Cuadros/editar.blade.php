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
    <div class="col-md-12">
        <h6>Editar {{$cuadro->nombre}}</h6>
        <hr>
    </div>
    <div class="col-md-12">
        <form method="POST" action="{{route('cuadros.update',$cuadro->idcuadro)}}">
            @csrf {{ method_field('PUT') }}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="idsaber" class="control-label">Tipo</label>
                        <select name="idsaber" required id="" class="form-control">
                            @foreach ($saberes as $saber )
                            @if ($cuadro->idsaber==$loop->index+1)
                                <option selected value="{{$loop->index+1}}">{{$saber}}</option>
                            @else
                                <option value="{{$loop->index+1}}">{{$saber}}</option>
                            @endif
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input type="text" required class="form-control" name="nombre" value="{{$cuadro->nombre}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="punteo" class="control-label">Punteo</label>
                        <input type="number" name="punteo" class="form-control" value="{{$cuadro->punteo}}" id="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripcion</label>
                        <textarea name="descripcion" class="form-control" id="" cols="30" rows="3">{{$cuadro->descripcion}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="renombrar" class="control-label">¿Se puede renombrar?</label>
                        <select name="renombrar" id="" class="form-control">
                            @if ($cuadro->renombrar==1)
                                <option selected value="1">Si</option>
                                <option value="0">No</option>
                            @else
                                <option value="1">Si</option>
                                <option selected value="0">No</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="asesor" class="control-label">Califica</label>
                        <select name="asesor" id="" class="form-control">
                            @if ($cuadro->asesor==0)
                                <option selected value="0">Profesor</option>
                                <option value="1">Asesor</option>
                            @else
                                <option value="0">Profesor</option>
                                <option selected value="1">Asesor</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="btn-group">
                        <button type="button" onclick="location.href='{{route('cuadros.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                        <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-danger" id="delete"><i class="ti-trash"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </form>
        <form id="formdelete" action="{{ route('cuadros.destroy', $cuadro->idcuadro) }}" class="hide-b" method="post">
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
            confirmButtonColor: '#d2d2d2',
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