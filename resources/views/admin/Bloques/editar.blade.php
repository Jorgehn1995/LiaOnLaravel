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
        <h6>Editar {{$bloque->nombre}}</h6>
        <hr>

    </div>
    <div class="col-md-12">
        <form method="POST" action="{{route('bloques.update',$bloque->idbloque)}}">
            @csrf {{ method_field('PUT') }}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bloque" class="control-label">Bloque</label>
                        <select name="bloque" required id="" class="form-control">
                            @for ($i = 1; $i <= 4; $i++)

                            <option @if($bloque->bloque==$i) selected @endif value="{{$i}}">Bloque {{$i}} </option>
                             @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input type="text" required class="form-control" name="nombre" value="{{$bloque->nombre}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="porcentaje" class="control-label">Porcentaje</label>
                        <input type="number" name="porcentaje" class="form-control" value="{{$bloque->porcentaje}}" id="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="btn-group">
                        <button type="button" onclick="location.href='{{route('bloques.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
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
        <form id="formdelete" action="{{ route('bloques.destroy', $bloque->idbloque) }}" class="hide-b" method="post">
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