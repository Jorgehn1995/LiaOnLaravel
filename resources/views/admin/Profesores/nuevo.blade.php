@extends('admin.layout') 
@section('title', "Agregar Profesor") 
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
            <h6>Agregar un nuevo profesor</h6>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('profesores.store')}}">
                @csrf
                <div class="row">
                    <input type="hidden" name="" id="idinstitucion" value="{{Auth::User()->idinstitucion}}">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre" class="control-label">Nombres <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-input-profesor" id="nombre" name="nombre" value="{{old('nombre')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellido" class="control-label">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-input-profesor" id="apellido" name="apellido" value="{{old('apellido')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="correo" class="control-label">Usuario <span class="text-danger">*</span></label>
                            <input type="text" id="usuario" readonly class="form-control" value="{{old('usuario')}}" name="usuario">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>(<span class="text-danger">*</span>) campos obligatorios</p>
                        <p class="text-muted"><strong>NOTA:</strong> Generaremos la contraseña de acceso automaticamente</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" onclick="location.href='{{route('profesores.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i>  Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
 
@section('js')
<script>
    $(".form-input-profesor").keyup(function(){
        var username;
        var nombre =$("#nombre").val().split(" ");
        var apellido=$("#apellido").val().split(" ");
        if(!nombre[0]){
            nombre[0]="";
        }
        if(!nombre[1]){
            nombre[1]="";
        }
        if(!apellido[0]){
            apellido[0]="";
        }
        if(!apellido[1]){ 
            apellido[1]=""; 
        }
        var i1=nombre[0].substr(0,1);
        var i2=nombre[1].substr(0,1);
        var i3=apellido[0].substr(0,1);
        var i4=apellido[1]
        if(apellido[1]==""){
            if(nombre[1]==""){
                username=nombre[0]+apellido[0]+"-"+$("#idinstitucion").val();
            }else{
                username=i1+i2+apellido[0]+"-"+$("#idinstitucion").val();
            }
        }else{
            username=i1+i3+i4+"-"+$("#idinstitucion").val();
        }
        $("#usuario").val(username);
    });

</script>
@endsection