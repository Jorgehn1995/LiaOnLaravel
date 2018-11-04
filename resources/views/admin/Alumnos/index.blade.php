@extends('admin.layout') 
@section('title', "Alumnos Inscritos") 

 
@section('content')
<div class="col-md-4">
	<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
		<div class="modal-dialog modal-success modal-dialog-centered modal-" role="document">
			<div class="modal-content bg-gradient-success">

				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-notification">Agregar Alumno</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>

				<div class="modal-body">
					<div class="py-3 text-center">
						<i class="ni ni-hat-3 ni-3x"></i>
						<p>Para agregar un nuevo alumno debes proporcionar el codigo</p>
						<p><strong>NOTA: </strong> <small>Revisa que el código este correctamente escrito</small></p>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control " id="codigonuevo" data-showroute="{{route('jsonConsultaCodigo')}}" placeholder="Codigo Estudiantil">
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-white" id="btn-bgeneral">Continuar</button>

				</div>

			</div>
		</div>
	</div>
</div>
<div class="col-md-12">
	@if(count($errors)>0)
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> @foreach($errors->all() as $error)
		<li> {{$error}}</li>
		@endforeach
	</div>
	@endif
	@include('admin.alumnos.seccionadd')


	<!--seccion de alumnos agregados-->
	<div class="row m-b-15 listalumnos">
		<div class="col-md-12 col-sm-12">
			<div class="input-group">
				<input type="text" autocomplete="off" id="busqueda" class="form-control " placeholder="Buscar por Nombre, Apellido, Codigo, Edad">
				<div class="input-group-append">
					<button class="btn btn-default " onclick=" btnreload();"><i class="ti-reload"></i> </button>
					<button class="btn btn-success hide-b " id="add"><i class="ti-plus"></i> </button>

				</div>
			</div>
		</div>
	</div>
	<!--seccion de loadicon-->
	<div class="row divload justify-content-md-center" id="divload">
		<div class="col-md-4 text-center">
			<img src="{{asset('images/app/load7.gif')}}" width="100" alt="">

			<p class="text-muted">Cargando</p>
		</div>
	</div>
	<div class="row listalumnos" id="searchbox" style="display:none;">

	</div>

</div>
<button class="btn btn-success btn-circle  float-btn" data-toggle="modal" data-target="#modal-notification" type="button"><span class="btn-inner--icon"><i class="ti ti-plus"></i></span></button>
<input type="hidden" id="inscritos" value="{{route('jsonInscritos')}}">
<input type="hidden" id="info" value="{{route('jsonConsultaCodigo')}}">
@endsection
 
@section('js')

<script>
	$("#btn-bgeneral").click(function() {
		
		consultarcodigo($('#codigonuevo'));
	});
	$("#regresar").click(function(){
		$("#sbox").hide();
		$(".listalumnos").show();
		$('html, body').animate({
			scrollTop: 0
		}, 1000);
	});
	$("#registerform").on("submit", function(event) {
		event.preventDefault();
		registraralumno($(this));
	});
	$("#inscripcionform").on("submit", function(e) {
		e.preventDefault();
		//alert($(this).serialize());
		inscribiralumno($(this));
	});
	$("#selectGrados").change(function() {
		cargarseccion();
	});
	cargargrado();


	var data;

	function btnreload() {
		consultarinscritos($("#inscritos").val());
	}
	btnreload();
	$('#busqueda').keyup(function() {
		alumnoslivesearch($(this).val());
	});
	$("#add").click(function() {
		$("#sbox").show(500);
		$(".listalumnos").hide(500);
	});
	$("#closeadd").click(function() {
		$("#sbox").hide(500);
		$(".listalumnos").show(500);
	});

</script>
@endsection