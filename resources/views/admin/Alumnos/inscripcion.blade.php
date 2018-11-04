@extends('admin.layout') 
@section('title', "Inscripción de Alumno") 
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
        <div class="col-lg-8 col-md-6">
            <div class="text-center card-box">
                <div class="member-card">
                    <div class="thumb-lg member-thumb m-b-10 center-page">
                        <img src="{{asset('images/icons/user.png')}}" class="rounded-circle img-thumbnail" alt="profile-image">
                    </div>

                    <div class="">
                        <h5 class="m-b-5 m-t-10">{{$usuario->nombre}}</h5>
                        <p class="text-muted">{{$usuario->apellido}}</p>
                    </div>
                    <div class="text-left m-t-40">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted font-13"><strong>Codigo : </strong> <span class="m-l-15">{{$usuario->informaciones->codigo}}</span></p>
                                <p class="text-muted font-13"><strong>Genero :</strong> <span class="m-l-15">{{$usuario->generol}}</span></p>
                                <p class="text-muted font-13"><strong>Nacimiento :</strong><span class="m-l-15">{{$usuario->nacimiento}} ({{$usuario->edad}} años)</span></p>
                                <p class="text-muted font-13"><strong>Dirección :</strong><span class="m-l-15">{{$usuario->direccion}} </span></p>

                            </div>
                            <div class="col-md-6">
                                <p class="text-muted font-13"><strong>Encargado :</strong> <span class="m-l-15">{{$usuario->informaciones->encargado}}</span></p>
                                <p class="text-muted font-13"><strong>Telefono de Encargado :</strong> <span class="m-l-15">{{$usuario->informaciones->telencargado}}</span></p>
                                <hr>
                                <p class="text-muted font-13"><strong>Usuario de Plataforma :</strong> <span class="m-l-15">{{$usuario->usuario}}</span></p>
                                <p class="text-muted font-13"><strong>Contraseña de Plataforma :</strong> <span class="m-l-15">{{$usuario->pass}}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="row center-page">
                        <a href="" class="btn btn-warning"><i class="ti-pencil"></i> Editar</a>
                    </div>

                </div>

            </div>
            <!-- end card-box -->
        </div>
        <div class="col-md-4">
            <div class="text-center card-box">
                <h6>Información de Inscripción</h6>
                <form method="POST" class="" action="{{route('alumnos.inscribir')}}">
                    @csrf
                    <input type="hidden" name="idusuario" value="{{$usuario->idusuario}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ciclo" class="control-label">Ciclo Escolar</label>
                                <input type="text" disabled class="form-control" name="ciclo" value="{{$usuario->y}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="encargado" class="control-label">Grado a Cursar</label>
                                <select name="idgrado" class="form-control" id="">
                                    @foreach($grados as $grado)

                                <option value="{{$grado->idgrado}}">{{$grado->grado." ".$grado->nivel->corto}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="location.href='{{URL::previous()}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i> Inscribir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection