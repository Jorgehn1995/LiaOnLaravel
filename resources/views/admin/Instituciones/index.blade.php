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
                                @if ($institucion->logo=="")
                                <img src="{{asset('images/app/user.jpg')}}" class="rounded-circle img-thumbnail avatar" alt="profile-image">                                @else
                                <img src="{{asset('images/users')}}/{{$institucion->logo}}" class="rounded-circle img-thumbnail avatar" alt="profile-image">@endif
                            </div>

                            <div class="">
                                <h5 class="m-b-5">Logo - {{$institucion->abr}}</h5>
                            </div>
                            <div class="mt-3 mb-3 form-group">

                                <p class="text-muted mb--10">Tamaño Maximo de la Imagen 5MB</p>
                                <p class="text-muted">Fondo Blanco</p>
                            </div>

                            <form action="{{ route('institucion.logo',$institucion->idinstitucion) }}" enctype="multipart/form-data" class="dropzone"
                                id="fileupload" method="POST">
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
                <form method="POST" action="{{route('institucion.update',$institucion->idinstitucion)}}">
                    @csrf {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Codigo</label>
                                <input type="text" required disabled class="form-control" value="{{$institucion->idinstitucion}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="abr" class="control-label">Abreviatura</label>
                                <input type="text" required name="abr" class="form-control" value="{{$institucion->abr}}" id="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre de la Institución</label>
                                <input type="text" required name="nombre" class="form-control" value="{{$institucion->nombre}}" id="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lema" class="control-label">Lema</label>
                                <input type="text" name="lema" value="{{$institucion->lema}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion" class="control-label">Dirección</label>
                                <input type="text" name="direccion" value="{{$institucion->direccion}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Teléfono</label>
                                <input type="text" name="telefono" value="{{$institucion->telefono}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo" class="control-label">Correo</label>
                                <input type="text" name="correo" value="{{$institucion->correo}}" class="form-control">
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
 
@section('js')
<script type="text/javascript">
    Dropzone.options.fileupload = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        uploadMultiple: false, 
        maxFiles: 3,  
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        resizeWidth:300,
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