@extends('admin.layout') 
@section('title', "Inicio") 
@section('content')
<div class="col-md-4">
    <div class="widget-simple text-center ">
        <h3 class="text-primary counter font-bold mt-0">{{$cantidad['total']}}</h3>
        <p class="text-muted mb-0">Alumnos Inscritos</p>
    </div>
</div>
<div class="col-md-4">
    <div class="widget-simple text-center">
        <h3 class="text-info counter font-bold mt-0">{{$cantidad['hombres']}}</h3>
        <p class="text-muted mb-0">Hombres</p>
    </div>
</div>
<div class="col-lg-4 col-md-6">
    <div class="widget-simple text-center ">
        <h3 class="text-pink counter font-bold mt-0">{{$cantidad['mujeres']}}</h3>
        <p class="text-muted mb-0">Mujeres</p>
    </div>
</div>
<div class="col-md-6 mt-5">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                Estadistica Alumnos/Secciones
            </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5 " style="color:#039cfd;"></i>Hombres</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5 " style="color:#ededed;"></i>Mujeres</h5>
                        </li>
                    </ul>
                </div>
                <div id="graficaGrados" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 mt-5">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                Estadistica Alumnos/Edades
            </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5 " style="color:#039cfd;"></i>Hombres</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5 " style="color:#ededed;"></i>Mujeres</h5>
                        </li>
                    </ul>
                </div>
                <div id="graficaEdades" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                Alumnos/Secciones
            </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Grado</td>
                            <td>Hombres</td>
                            <td>Mujeres</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grados as $grado)
                        <tr>
                            <td>{{$grado['grado']}}</td>
                            <td>{{$grado['hombres']}}</td>
                            <td>{{$grado['mujeres']}}</td>
                            <td>{{$grado['total']}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="text-right"><strong>Total</strong></td>
                            <td>{{array_sum(array_column($grados, 'hombres'))}}</td>
                            <td>{{array_sum(array_column($grados, 'mujeres'))}}</td>
                            <td>{{array_sum(array_column($grados, 'total'))}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                Alumnos/Edad
            </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Edad</td>
                            <td>Hombres</td>
                            <td>Mujeres</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($edades as $edad)
                        <tr>
                            <td>{{$edad['edad']}}</td>
                            <td>{{$edad['hombres']}}</td>
                            <td>{{$edad['mujeres']}}</td>
                            <td>{{$edad['total']}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="text-right"><strong>Total</strong></td>
                            <td>{{array_sum(array_column($edades, 'hombres'))}}</td>
                            <td>{{array_sum(array_column($edades, 'mujeres'))}}</td>
                            <td>{{array_sum(array_column($edades, 'total'))}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                Inscritos del Día
            </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Grado</td>
                            <td>Hombres</td>
                            <td>Mujeres</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscritosdia as $inscrito)
                        <tr>
                            <td>{{$inscrito['grado']}}</td>
                            <td>{{$inscrito['hombres']}}</td>
                            <td>{{$inscrito['mujeres']}}</td>
                            <td>{{$inscrito['total']}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="text-right"><strong>Total</strong></td>
                            <td>{{array_sum(array_column($inscritosdia, 'hombres'))}}</td>
                            <td>{{array_sum(array_column($inscritosdia, 'mujeres'))}}</td>
                            <td>{{array_sum(array_column($inscritosdia, 'total'))}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="grados" value="{{json_encode($grados)}}">
<input type="hidden" id="edades" value="{{json_encode($edades)}}">
@endsection
 
@section('js')
<script src="{{asset('js/inicio.js')}}"></script>
<script>
    $barData = JSON.parse($("#grados").val());
    stackedchart('graficaGrados', $barData, 'grado', ['hombres', 'mujeres'], ['Hombres', 'Mujeres'], ["#039cfd", "#ededed"]);
    $barData = JSON.parse($("#edades").val());
    stackedchart('graficaEdades', $barData, 'edad', ['hombres', 'mujeres'], ['Hombres', 'Mujeres'], ["#039cfd", "#ededed"]);

</script>
@endsection