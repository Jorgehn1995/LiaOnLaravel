@extends('admin.layout') 
@section('title', "Inicio") 
@section('css')
<style type="text/css">
    .avatar {
        width: 150px !important;
        height: 150px !important;
    }
</style>
@endsection
 
@section('content')
<div class="col-md-12">
    @if($institucion->ciclo=="")
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <li> No existe ciclo guardado</li>

    </div>
    @endif
</div>
<div class="col-xl-3 col-lg-4">
    <div class="text-center card-box">
        <div class="member-card">
            <div class="thumb-xl member-thumb m-b-10 center-block">

                @if ($institucion->logo=="")
                <img src="{{asset('images/app/user.jpg')}}" class="rounded-circle img-thumbnail avatar" alt="profile-image">                @else
                <img src="{{asset('images/users')}}/{{$institucion->logo}}" class="rounded-circle img-thumbnail avatar" alt="profile-image">@endif
            </div>

            <div class="">
                <h5 class="m-b-5">{{$institucion->abr}}</h5>
                <p class="text-muted">{{$institucion->ciclo}}</p>
            </div>

            <button type="button" onclick="location.href='{{route('institucion.index')}}'" class="btn btn-success btn-sm w-sm waves-effect  waves-light"><i class="ti-pencil"></i> Editar</button>


            <div class="text-left m-t-40">
                <p class="text-muted font-13"><strong>Institución :</strong> <span class="m-l-15"><br> {{$institucion->nombre}}</span></p>

                <p class="text-muted font-13"><strong>Dirección :</strong><span class="m-l-15"><br> {{($institucion->direccion=="")?Incompleta:$institucion->direccion}}</span></p>

                <p class="text-muted font-13"><strong>Teléfono :</strong> <span class="m-l-15"><br> {{($institucion->telefono=="")?"N/D":$institucion->telefono}}</span></p>
                <p class="text-muted font-13"><strong>Correo :</strong> <span class="m-l-15"><br> {{($institucion->correo=="")?"N/D":$institucion->correo}}</span></p>


            </div>

            <ul class="social-links list-inline m-t-30">
                <li class="list-inline-item">
                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                </li>
            </ul>

        </div>

    </div>
    <!-- end card-box -->

    <div class="card-box">
        <h4 class="m-t-0 m-b-20 header-title">Informacion</h4>

        <div class="p-b-10">
            <p>Inscritos <small>{{$cantidad['total']}} Alumnos</small></p>
            <div class="progress progress-md">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
            <p>Hombres {{round(($cantidad['hombres']/$cantidad['total'])*100,0)}}%</p>
            <div class="progress progress-md">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: {{round(($cantidad['hombres']/$cantidad['total'])*100,0)}}%;"></div>
            </div>
            <p>Mujeres {{round(($cantidad['mujeres']/$cantidad['total'])*100,0)}}%</p>
            <div class="progress progress-md">
                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{round(($cantidad['mujeres']/$cantidad['total'])*100,0)}}%"></div>
            </div>
            <p>Activos {{round(($cantidad['activos']/$cantidad['total'])*100,0)}}%</p>
            <div class="progress progress-md">
                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{round(($cantidad['activos']/$cantidad['total'])*100,0)}}%">
                </div>
            </div>
            <p>Retirados {{round(($cantidad['retirados']/$cantidad['total'])*100,0)}}%</p>
            <div class="progress progress-md">
                <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{round(($cantidad['retirados']/$cantidad['total'])*100,0)}}%">
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end col -->


<div class="col-lg-8 col-xl-9">
    <div class="row mb-3">
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
        <div class="col-lg-4">
            <div class="widget-simple text-center ">
                <h3 class="text-pink counter font-bold mt-0">{{$cantidad['mujeres']}}</h3>
                <p class="text-muted mb-0">Mujeres</p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-heading portlet-default">
                    <h3 class="portlet-title text-dark">
                        <i class="ti-bar-chart"></i> Estadistica Alumnos/Edades
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
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-heading portlet-default">
                    <h3 class="portlet-title text-dark">
                        <i class="ti-bar-chart"></i> Estadistica Alumnos/Secciones
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
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-heading portlet-default">
                    <h3 class="portlet-title text-dark">
                        <i class="ti-settings"></i> Configuracion/Visualizacion de Bloques
                    </h3>
                    <div class="portlet-widgets">

                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-default" class="panel-collapse collapse show">
                    <div class="portlet-body">
                        <table class="table table-hover table-striped wrap" wrap>
                            <thead>
                                <tr>
                                    <td colspan="2" class="text-center">Información</td>
                                    <td colspan="3" class="text-center ">Visualización</td>
                                </tr>
                                <tr>
                                    <td>Bloque</td>
                                    <td>Nombre</td>
                                    <td>Profesores</td>
                                    <td>Alumnos</td>
                                    <td>Padres</td>
                                </tr>
                            </thead>
                            <tbody id="tbody2">
                                @forelse($bloques as $bloque)
                                <tr id="{{$bloque->idcuadro}}">
                                    <td data-id="{{$loop->index+1}}">{{$loop->index+1}}</td>
                                    <td>{{$bloque->nombre}}</td>
                                    <td>
                                        <input type="checkbox" @if($bloque->profesor==1) checked @endif data-tipo="profesor"
                                        data-id="{{$bloque->idbloque}}" class="data-switch" data-plugin="switchery" data-color="#00b19d"
                                        />
                                    </td>
                                    <td>
                                        <input type="checkbox" @if($bloque->alumno==1) checked @endif data-tipo="alumno"
                                        data-id="{{$bloque->idbloque}}" class="data-switch" data-plugin="switchery" data-color="#00b19d"
                                        />
                                    </td>
                                    <td>
                                        <input type="checkbox" @if($bloque->padre==1) checked @endif data-tipo="padre" data-id="{{$bloque->idbloque}}"
                                        class="data-switch" data-plugin="switchery" data-color="#00b19d" />
                                    </td>

                                </tr>
                                @empty
                                <td class="text-center text-muted" colspan="11"> No existen cuadros registrados para este nivel</td>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <form id="ordenform" action="{{route('bloques.mostrar')}}" class="hide-b" method="POST">
                                @csrf
                                <input type="hidden" name="tipo" id="tipo">
                                <input type="hidden" name="idbloque" id="idbloque">
                                <input type="hidden" name="estado" id="estado">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end col -->


<div class="col-md-6">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                <i class="ti-list"></i> Alumnos/Secciones
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
                <i class="ti-list"></i> Alumnos/Edad
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
                <i class="ti-list"></i> Inscritos del Día
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
    $(".data-switch").change(function(){
        $("#tipo").val($(this).data('tipo'));
        $("#idbloque").val($(this).data('id'));
        var condiciones = $(this).is(":checked");
        if (!condiciones) {
            $("#estado").val("0");    
        }else{
            $("#estado").val("1");
        }
        var td=$(this);
        var form = $("#ordenform"); 
        $.ajax( {
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            beforeSend:function(){
                $("#btn-msg").html('<i class="ti-reload"></i> Guardando Cambios');
                $("#btn-msg").show();
            },
            success: function(response) {
                if(response['status']=="true"){
                    $("#btn-msg").html('<i class="ti-check"></i> Cambios Guardados');
                    $("#btn-msg").show();
                    $("#btn-msg").fadeOut(3000);
                }
            },
            error:function(error){
                $("#btn-msg").html('<i class="ti-unlink"></i> Sin conexión a internet');
                $("#btn-msg").show();
            }
            
        });
    });

</script>
@endsection