@extends('admin.layout') 
@section('title', "Comprobante de Inscripción") 
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
    <div class="row m-b-10">
        <div class="col-md-12">
            <div class="d-print-none">
                <div class="text-right">
                        <a href="{{URL::previous()}}" class="btn btn-secondary waves-effect waves-light"><i class="ti-arrow-left"></i> Regresar </a>
                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print"></i> Imprimir </a>
                
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <!-- <div class="panel-heading">
                    <h4>Invoice</h4>
                </div> -->
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h3 class="text-right"><i class="mdi mdi-radar"></i>{{Auth::User()->institucion->abr}}</h3>
                        </div>
                        <div class="pull-right">
                            <h6>Comprobante # <br>
                                <strong>{{$inscripcion->usuario->created_at."->".$inscripcion->usuario->idusuario}}</strong>
                            </h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="pull-left m-t-30">
                                <address>
                                    <strong>{{Auth::User()->institucion->abr}}</strong><br>
                                    {{Auth::User()->institucion->direccion}}<br>
                                    {{Auth::User()->institucion->telefono}}<br>
                                    {{Auth::User()->institucion->url}} <br>
                                </address>
                            </div>
                            <div class="pull-right m-t-30">
                                <p><strong>Fecha de Inscripcion: </strong> {{date("d/m/Y",strtotime($inscripcion->created_at))}}</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h6>Alumno Inscrito</h6>
                            <hr>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Codigo</th>
                                            <th>Alumno</th>
                                            <th>Ciclo</th>
                                            <th>Grado</th>
                                            <th>Sección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{$inscripcion->usuario->informaciones->codigo}}</td>
                                            <td>{{$inscripcion->usuario->nombre." ".$inscripcion->usuario->apellido}}</td>
                                            <td>{{$inscripcion->ciclo}}</td>
                                            <td>{{$inscripcion->grado->grado." ".$inscripcion->grado->nivel->corto}}</td>
                                            <td><span class="badge badge-warning">PENDIENTE</span></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-50">
                        <div class="col-md-12 text-center">
                            <h6>Datos del Encargado</h6>
                            <hr>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Encargado</th>
                                            <th>Telefono</th>
                                            <th>Otras Informaciones</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{$inscripcion->usuario->informaciones->encargado}}</td>
                                            <td>{{$inscripcion->usuario->informaciones->telencargado}}</td>
                                            <td>{{$inscripcion->usuario->informaciones->otro}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col-6">
                            <div class="clearfix ">
                                <h5 class="small"><b>ACCESO AL SISTEMA DE CALIFICACIONES</b></h5>
                                <small>
                                    El {{Auth::User()->institucion->nombre}} cuenta con una plataforma educativa avanzada de con el cual el alumno puede revisar calificaciones, enviar tareas y tener acceso al material de apoyo que el docente desee proporcionarle, a continuacion se te proporcionan los datos de acceso para el encargado con los cuales puedes monitorear y estar al tanto del nivel academico y las calificaciones del estudiante durante el ciclo escolar {{$inscripcion->ciclo}}
                                </small>
                            </div>
                        </div>
                        <div class="col-6 m-t-20">
                            <p class="text-left"><b>Página Web: </b> {{Auth::User()->institucion->url}} </p>
                            <p class="text-left"><b>Usuario: </b>{{$inscripcion->usuario->informaciones->codigo}}</p>
                            <p class="text-left"><b>Contraseña: </b> {{date("Y",strtotime($inscripcion->usuario->nacimiento))}}</p>

                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col-md-12 text-center">
                        <p class="text-muted">{{Auth::User()->institucion->abr}} | © Sistema de Calificaciones LIA {{date("Y")}}</p>
                        </div>
                    </div>
                    <hr>
                    
                </div>
            </div>
        </div>

    </div>
</div>
@endsection