@extends('admin.layout') 
@section('title', "Alumnos Inscritos") 
@section('content')

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
            <div class="card-box">
                <div class="table-responsive">
                    <table id="alumnos" class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Codigo</td>
                                <td>Nombre</td>
                                <td>Grado</td>
                                <td>Nacimiento</td>
                                <td>Estado</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($alumnos as $alumno)
                            <tr>
                                <td>{{$alumno->idinscripcion}}</td>
                                <td>{{$alumno->usuario->informaciones->codigo}}</td>
                                <td>{{$alumno->usuario->nombre." ".$alumno->usuario->apellido}}</td>
                                <td>{{$alumno->grado->grado." ".$alumno->grado->nivel->corto}}</td>
                                <td>{{$alumno->usuario->nacimiento}}</td>
                                <td><span class="badge badge-{{$alumno->estado->color}}">{{$alumno->estado->estado}}</span></td>
                                <td>
                                    <div class="btn-group">
                                    
                                        <button onclick="window.location='{{route('alumnos.comprobante',$alumno->idinscripcion)}}'" class="btn btn-info btn-sm" title="Informacion"><i class="ti-info-alt"></i></button>
                                        <button class="btn btn-warning btn-sm" title="Editar"><i class="ti-pencil"></i></button>
                                        <button class="btn btn-success btn-sm" title="Pagos"><i class="ti-money"></i></button>
                                        <button class="btn btn-primary btn-sm" title="Caliicaciones"><i class="ti-clip"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection