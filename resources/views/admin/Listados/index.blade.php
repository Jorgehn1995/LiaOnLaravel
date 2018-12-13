@extends('admin.layout') 
@section('title', "Listados") 
@section('content')
<div class="col-md-12 mb-3 hide-print">
    <div class="row">
        <div class="col-md-12">
            <label for="grados">Seleccione un Grado</label>
            <div class="input-group">
                <select name="" id="selectGrados" class="form-control">
                    <option value="">Selecciona un Grado</option>
                    
                    @foreach ($grados as $grado)
                        
                        @if ($idgrado==$grado->idgrado)
                            <option selected value="{{$grado->idgrado}}">{{$grado->nombre}} {{$grado->seccion}}</option>
                        @else
                            <option value="{{route('listados.index',$grado->idgrado)}}">{{$grado->nombre}} {{$grado->seccion}}</option>
                        @endif
                        
                    @endforeach
                    
                </select>
                <div class="input-group-append">
                    <button class="btn btn-info waves-effect waves-light" id="mostrar" type="button">Mostrar Materias</button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-md-12">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark">
                <i class="ti-list"></i> Listado @foreach ($grados as $grado) @if ($idgrado==$grado->idgrado) {{$grado->nombre}}
                {{$grado->seccion}} @endif @endforeach
            </h3>
            <div class="portlet-widgets">

                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Clave</td>
                            <td>Codigo</td>
                            <td>Nombre</td>
                            <td>Estado</td>
                            <td>Edad</td>


                        </tr>
                    </thead>
                    <tbody>
                        @if($idgrado!=0) @foreach ($listado as $alumno)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$alumno->codigo}}</td>
                            <td>{{$alumno->apellido}}, {{$alumno->nombre}}</td>
                            <td>
                                @if($alumno->idestado==1)
                                <span class="badge badge-success">Activo</span> @else
                                <span class="badge badge-danger">Retirado</span> @endif
                            </td>
                            <td>{{date('d/m/Y',strtotime($alumno->nacimiento))}} <span class="badge badge-info">{{$alumno->edad}} años</span></td>


                        </tr>
                        @endforeach @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('js')
<script>
    $("#mostrar").click(function(){
        if($("#selectGrados").val()!=""){
            location.href=$("#selectGrados").val();
        }
    });

</script>
@endsection