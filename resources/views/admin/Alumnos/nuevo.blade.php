@extends('admin.layout') 
@section('title', "Inscribir Alumno") 
@section('content')

<div class="col-md-12 m-b-15">

</div>
<div class="col-md-12">
  @if(count($errors)>0)
  <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> @foreach($errors->all() as $error)
    <li> {{$error}}</li>
    @endforeach
  </div>
  @endif
  <div id="sbox" class="m-b-20">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="input-group">
          <input type="text" id="busqueda" name="codigo" class="form-control " placeholder="Codigo Personal">
          <div class="input-group-append">
            <button id="buscar" class="btn btn-info waves-effect waves-light" type="button"><i class="ti-search"></i> Buscar</button>


          </div>
        </div>
      </div>
    </div>
    <div class="row m-t-10 text-center  loadicon hide-b">


    </div>
  </div>
  <div id="info" class="card-body">
    <div class="col-md-12">
      <p class="text-muted">Información del Alumno</p>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input type="hidden" id="inputcod" name="">

      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Codigo </label>
          <p id="tcodigo">Codigo del Alumno</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Nombre </label>
          <p id="tnombre">Nombre del Alumno</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Apellido </label>
          <p id="tapellido">Apellido del Alumno</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Nacimiento </label>
          <p id="tnacimiento">dd-mm-aaaa</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Genero </label>
          <p id="tgenero">Genero</p>
        </div>
      </div>
      <div class="col-md-4 hide-b">
        <div class="form-group">
          <div class="btn-group">
            <button class="btn btn-warning btn-sm"><i class="ti-pencil"></i> Editar</button>
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
    <form id="inscripcionform" action="{{route('alumnos.inscribir')}}" method="POST">
      @csrf
      <input type="hidden" required id="idusuario" name="idusuario">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="encargado" class="control-label">Ciclo Escolar</label>
                <input type="text" required class="form-control" readonly name="ciclo" value="{{Auth::User()->institucion->ciclo}}">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="encargado" class="control-label">Grado</label>
                <select name="idgrado" required data-route="{{route('jsonGrados')}}" data-seccionroute="{{route('jsonSecciones')}}" id="selectGrados"
                  class="form-control">
                  <option value="">Seleccione un grado</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="encargado" class="control-label">Seccion</label>
                <select name="idseccion" required id="selectSecciones" class="form-control">
                                        <option value="">Seleccione una sección</option>
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
                <button type="button" onclick="location.href='{{route('alumnos.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>

                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Inscribir Alumno</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-4">
    <div class="modal fade" id="modalregistro" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

          <div class="modal-body p-0">
            <div class="card bg-secondary shadow border-0">
              <div class="card-header bg-white ">
                <div class="text-muted text-center "><small>No se ha encontrado el usuario, registralo para continuar</small></div>
              </div>
              <div class="card-body px-lg-5 ">
                <div class="text-center text-muted mb-4">
                  <small>Datos del Usuario</small>
                </div>
                <form role="form" id="registerform" method="POST" action="{{route('alumnos.store')}}">
                  @csrf
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="codigo" class="control-label">Codigo <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" name="codigo" value="{{old('nombre')}}">
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
                        <select name="genero" class="form-control" required id="">
                                                        <option value="">Selecione un Genero</option>
                                                        <option value="M">Masculino</option>
                                                        <option value="F">Femenino</option>
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
                        <label for="correo" class="control-label">Correo</label>
                        <input type="text" name="correo" class="form-control" value="{{old('correo')}}" id="">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="direccion" class="control-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{old('direccion')}}" id="">
                      </div>
                    </div>

                  </div>

                  <div class="text-center">
                    <button type="submit" id="registrar" class="btn btn-black my-4">Guardar Información</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
 
@section('js')
<script>
  $("#buscar").click(function(){
        consultarcodigo();
    });
$("#registerform").on( "submit", function( event ) {
  event.preventDefault();
  registraralumno($(this));
});
$("#inscripcionform").on( "submit", function(e) {
  e.preventDefault();
  //alert($(this).serialize());
  inscribiralumno($(this));
});
$("#selectGrados").change(function(){
    cargarseccion();
});
cargargrado();

</script>
@endsection