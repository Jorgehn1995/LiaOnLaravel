@extends('admin.layout') 
@section('title', "Alumnos Inscritos") 
@section('css')
<style>
	.autocomplete {
		/*the container must be positioned relative:*/
		position: relative;
		display: inline-block;
	}

	.autocomplete-items {
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;

		z-index: 99;
		/*position the autocomplete items to be the same width as the container:*/
		left: 0;
		right: 0;
	}

	.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #fff;
		border-bottom: 1px solid #d4d4d4;
	}

	.autocomplete-items div:hover {
		/*when hovering an item:*/
		background-color: #e9e9e9;
	}

	.autocomplete-active {
		/*when navigating through the items using the arrow keys:*/
		background-color: DodgerBlue !important;
		color: #ffffff;
	}
</style>
@endsection
 
@section('content')

<div class="col-md-12">
	@if(count($errors)>0)
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> @foreach($errors->all() as $error)
		<li> {{$error}}</li>
		@endforeach
	</div>
	@endif
	<div id="sbox" class="m-b-20" style="display:none;">
		<form role="form" id="inscripcionform" method="POST" action="{{route('alumnos.store')}}">
			<div id="info" class="card-body">
				<div class="col-md-12">
					<p class="text-muted">Información del Alumno</p>
					<hr>
				</div>
				<div class="row">
					@csrf
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="codigo" class="control-label">Codigo <span class="text-danger">*</span></label>
								<input type="text" class="form-control" autocomplete="off" required name="codigo" id="codigo" value="{{old('codigo')}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
								<input type="text" required id="nombre" class="form-control" name="nombre" value="{{old('nombre')}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="apellido" class="control-label">Apellido <span class="text-danger">*</span></label>
								<input type="text" required class="form-control" name="apellido" value="{{old('apellido')}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="genero" class="control-label">Genero <span class="text-danger">*</span></label>
								<select name="genero" class="form-control" required>
	                                <option value="">Selecione un Genero</option>
	                                <option value="m">Masculino</option>
	                                <option value="f">Femenino</option>
	                            </select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nacimiento" class="control-label">Nacimiento <span class="text-danger">*</span></label>
								<input type="date" required name="nacimiento" class="form-control" value="{{old('nacimiento')}}" id="">
							</div>
						</div>
						<div class="col-md-4 hide-b">
							<div class="form-group">
								<label for="telefono" class="control-label">Telefono</label>
								<input type="text" disabled name="telefono" class="form-control" value="{{old('telefono')}}" id="">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="direccion" class="control-label">Dirección</label>
								<input type="text" name="direccion" class="form-control" value="{{old('direccion')}}" id="">
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="card-box">
				<div class="row">
					<div class="col-md-12">
						<h6>Información de Inscripción</h6>
						<hr>
					</div>
				</div>


				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="encargado" class="control-label">Ciclo Escolar</label>
									<input type="text" required class="form-control" readonly name="ciclo" value="{{Auth::User()->institucion->ciclo}}">
								</div>
							</div>

							<div class="col-md-9">
								<div class="form-group">
									<label for="encargado" class="control-label">Grado</label>
									<select name="idgrado" required data-route="{{route('jsonGrados')}}" id="selectGrados" class="form-control">
	                          			<option value="">Seleccione un grado</option>
	                        		</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="encargado" class="control-label">Encargado</label>
									<input type="text" class="form-control" name="encargado" value="{{old('encargado')}}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="telencargado" class="control-label">Telefono Encargado</label>
									<input type="text" class="form-control" name="telencargado" value="{{old('telencargado')}}">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="otro" class="control-label">Otros Datos</label>
									<input type="text" name="otro" class="form-control" value="{{old('otro')}}" id="">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<button type="button" id="regresar" class="btn btn-dark"><i class=" ti-angle-left"></i> Cancelar</button>
									<button type="submit" class="btn btn-success btn-save" id=""><i class="ti-save"></i> Inscribir Alumno</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</form>
	</div>


	<!--seccion de alumnos agregados-->
	<div class="row m-b-15 listalumnos">
		<div class="col-md-12 col-sm-12">
			<div class="input-group">
				<input type="text" autocomplete="off" id="busqueda" class="form-control " placeholder="Buscar por Nombre, Apellido, Codigo, Edad">
				<div class="input-group-append">
					<button class="btn btn-default btn-reload" onclick=""><i class="ti-reload"></i> </button>
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
<button class="btn btn-success btn-circle  float-btn" type="button"><span class="btn-inner--icon"><i class="ti ti-plus"></i></span></button>
<input type="hidden" id="inscritos" value="{{route('alumnos.inscritos')}}">
<input type="hidden" id="autocompletado" value="{{route('alumnos.autocompletado')}}">
<input type="hidden" id="rutagrados" value="{{route('alumnos.grados')}}">
<input type="hidden" id="datainscritos">
@endsection
 
@section('js')
<script src="{{asset('js/alumnos.js')}}"></script>
<script>
	$(document).ready(function(){
		$(".float-btn").click(function(){
			$(".listalumnos").hide();
			$("#sbox").show();
		});
		$("#regresar").click(function(){
			$(".listalumnos").show();
			$("#sbox").hide();
			$('html, body').animate({
                scrollTop: $("#info").offset().top - 90
            }, 1000);
		});
		$(".btn-reload").click(function(){
			cargaralumnos($("#inscritos").val()); //se cargan las tarjetas con la informacion de los alumnos	
		});


		cargaralumnos($("#inscritos").val()); //se cargan las tarjetas con la informacion de los alumnos
		
		datosautocompletado($("#autocompletado").val()); //se cargan los datos para el autocompletado
		
		grados($("[name='idgrado']"),$("#rutagrados").val()); //se cargan los grados en el select
		
		$("#inscripcionform").on("submit", function (event) {//se captura el submit del formulario y se dispara la funcion para guardar el alumno
			event.preventDefault();
			$(".btn-save").prop('disabled',true);
    		registraralumno($(this));
		});

		$('#busqueda').keyup(function () { //cada vez que el usuario presione una tecla se ejecutará el livesearch
    		alumnoslivesearch($(this).val(),$("#datainscritos").val());
		});
	});

</script>
@endsection