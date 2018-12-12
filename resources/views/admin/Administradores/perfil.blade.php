@extends('admin.layout') 
@section('title', "Información") 
@section('css')
<style type="text/css">
    .dropzone {
        border: 2px dashed #999999;
        border-radius: 10px;
    }

    .dropzone .dz-default.dz-message {
        height: 171px;
        background-size: 132px 132px;
        margin-top: -101.5px;
        background-position-x: center;

    }

    .dropzone .dz-default.dz-message span {
        display: block;
        margin-top: 145px;
        font-size: 20px;
        text-align: center;
    }

    .avatar {
        width: 150px !important;
        height: 150px !important;
    }
</style>
@endsection
 
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
            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="text-center ">
                        <div class="member-card">
                            <div class="thumb-xl member-thumb m-b-10 center-block" id="divfotoperfil">
                                @if ($perfil->foto=="")
                                <img src="{{asset('images/app/user.jpg')}}" class="rounded-circle img-thumbnail avatar" alt="profile-image">                                @else
                                <img src="{{asset('images/users')}}/{{$perfil->foto}}" class="rounded-circle img-thumbnail avatar" alt="profile-image">@endif
                            </div>

                            <div class="">
                                <h5 class="m-b-5">{{$perfil->socialname}}</h5>
                            </div>
                            <div class="mt-3 mb-3 form-group">

                                <p class="text-muted mb--10">Tamaño Maximo de la Imagen 5MB</p>
                            </div>

                            <form action="{{ route('admin.perfil.updatefoto') }}" enctype="multipart/form-data" class="dropzone" id="fileupload" method="POST">
                                @csrf
                                <div class="fallback">

                                    <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h6>Información</h6>
                        <hr>
                        <form method="POST" action="{{route('admin.perfil.update')}}">
                            @csrf {{ method_field('PUT') }}
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="control-label">Nombre</label>
                                        <input type="text" required name="nombre" class="form-control" value="{{$perfil->nombre}}" id="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido" class="control-label">Apellido</label>
                                        <input type="text" required name="apellido" class="form-control" value="{{$perfil->apellido}}" id="">

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="correo" class="control-label">Correo</label>
                                        <input type="text" name="correo" value="{{$perfil->correo}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar Información</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <h6>Cambiar Contraseña</h6>
                        <hr>
                        <form method="POST" action="{{route('admin.perfil.changepassword')}}">
                            @csrf {{ method_field('PUT') }}
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="actual" class="control-label">Contraseña Actual</label>
                                        <input type="password" required name="actual" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nueva" class="control-label">Contraseña Nueva</label>
                                        <input type="text" required name="nueva" class="form-control" id="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="repetir" class="control-label">Repetir Contraseña Nueva</label>
                                        <input type="text" required name="repetir" class="form-control">
                                        <p class="text-danger nocoinciden" style="display:none;">Las contraseñas no coinciden</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group pull-right">
                                        <button type="submit" disabled class="btn btn-success btn-changepass"><i class="ti-save"></i> Cambiar Contraseña</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
 
@section('js')
<script type="text/javascript">
    $("[name='repetir']").keyup(function(){
        coincidencias();
    });
    $("[name='nueva']").keyup(function(){
        coincidencias();
    });
    function coincidencias(val1,val2,msg){
        msg=$(".nocoinciden");
        var repetir = $("[name='repetir']").val();
        var nueva =$("[name='nueva']").val();
        if(repetir===nueva){
            msg.hide();
            $(".btn-changepass").prop('disabled',false);
        }else{
            msg.show();
            $(".btn-changepass").prop('disabled',true);
        }
    }

    Dropzone.options.fileupload = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        uploadMultiple: false, 
        maxFiles: 3,  
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        accept: function(file, done) {
           done(); 
        },
        init: function() {
            this.on("success", function(file, responseText) {
                $("#divfotoperfil").html('<img src="'+responseText+'" class="rounded-circle img-thumbnail avatar" alt="profile-image">');
            });
        }
    }

</script>
@endsection