@extends('admin.layout') 
@section('title', "Inscribir Alumno") 
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
<div class="col-md-4">
    <div class="btn-group">

        <button type="button" onclick="location.href='{{route('alumnos.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
    </div>
</div>
<div class="col-md-4">
    <div class="text-center ">
        <div class="member-card">
            <div class="thumb-xl member-thumb m-b-10 center-block" id="divfotoperfil">
                @if ($inscripcion->foto=="")
                <img src="{{asset('images/app/user.jpg')}}" class="rounded-circle img-thumbnail avatar" alt="profile-image">                @else
                <img src="{{asset('images/users')}}/{{$inscripcion->foto}}" class="rounded-circle img-thumbnail avatar" alt="profile-image">                @endif

            </div>

            <div class="">
                <h5 class="m-b-5">{{$inscripcion->nombre}} {{$inscripcion->apellido}}</h5>
                <p class="text-muted">{{$inscripcion->codigo}}</p>
            </div>


            <form action="{{ route('alumnos.subirfoto',$inscripcion->idinscripcion) }}" enctype="multipart/form-data" class="dropzone"
                id="fileupload" method="POST">
                @csrf
                <div class="fallback">
                    <input type="hidden" name="idinscripcion" value="{{$inscripcion->idinscripcion}}">
                    <input name="file" type="files" multiple accept="image/jpeg, image/png, image/jpg" />
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="btn-group pull-right">
        <form action="{{route('alumnos.fotodestroy',$inscripcion->idinscripcion)}}" method="POST">
            @csrf {{ method_field('delete') }}
            <button type="submit" class="btn btn-danger"><i class="ti-trash"></i> Eliminar</button>
        </form>

    </div>
</div>
<!-- end col -->
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