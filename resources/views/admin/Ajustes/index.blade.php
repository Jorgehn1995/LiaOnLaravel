@extends('admin.layout') 
@section('title', "Ajustes y Configuraciones") 
@section('content')



<div class="col-md-12">
    <div class="row">
        <div class="col-lg-9 center-page">
            <div class="text-center">
                <h3 class="m-b-30 m-t-10">Configurar Niveles</h3>
            </div>
            <div class="row m-t-20">
                <article class="pricing-column col-md-4">
                    <div class="inner-box card-box">
                        <div class="plan-header text-center">
                            <h3 class="plan-title">Profesores</h3>

                            <h2 class="plan-price"><i class="ti-briefcase"></i></h2>
                            <div class="plan-duration">Profesores de la Intitución</div>
                        </div>


                        <div class="text-center">
                            <a href="{{route('profesores.index')}}" class="btn btn-success btn-bordred btn-rounded waves-effect waves-light">Configurar Profesores</a>
                        </div>
                    </div>
                </article>
                <article class="pricing-column col-md-4">
                    <div class="inner-box card-box">
                        <div class="plan-header text-center">
                            <h3 class="plan-title">Grados</h3>

                            <h2 class="plan-price"><i class="ti-medall"></i></h2>
                            <div class="plan-duration">Grados de tu Institución</div>
                        </div>
                        <div class="text-center">
                            <a href="{{route('grados.index')}}" class="btn btn-success btn-bordred btn-rounded waves-effect waves-light">Configurar Grados</a>
                        </div>
                    </div>
                </article>
                <article class="pricing-column col-md-4">
                    <div class="inner-box card-box">
                        <div class="plan-header text-center">
                            <h3 class="plan-title">Asignaturas</h3>

                            <h2 class="plan-price"><i class="ti-book"></i></h2>
                            <div class="plan-duration">Asignaturas o Materias</div>
                        </div>


                        <div class="text-center">
                            <a href="" class="btn btn-success btn-bordred btn-rounded waves-effect waves-light">Configurar Asignaturas</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 center-page">
            <div class="text-center">
                <h3 class="m-b-30 m-t-10">Configurar Cuadros de Calificación</h3>
            </div>
            <div class="row m-t-20">
                <article class="pricing-column col-lg-6 col-md-4">
                    <div class="inner-box card-box">
                        <div class="plan-header text-center">
                            <h3 class="plan-title">Modelos</h3>

                            <h2 class="plan-price"><i class="ti-agenda"></i></h2>
                            <div class="plan-duration">Modelo de Calificación</div>
                        </div>


                        <div class="text-center">
                            <a href="{{route('cuadros.index')}}" class="btn btn-success btn-bordred btn-rounded waves-effect waves-light">Configurar Modelos</a>
                        </div>
                    </div>
                </article>



            </div>
        </div>
    </div>

</div>
@endsection