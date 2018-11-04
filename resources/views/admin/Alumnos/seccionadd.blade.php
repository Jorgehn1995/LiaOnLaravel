<!--seccion de agregar alumno-->

<div id="sbox" class="m-b-20" style="display:none;">
    <form role="form" id="inscripcionform" method="POST" action="{{route('alumnos.agregar')}}">
        <div id="info" class="card-body">
            <div class="col-md-12">
                <p class="text-muted">Información del Alumno</p>
                <hr>
            </div>
            <div class="row">
                @csrf
                <input type="hidden" name="update" id="update" >
                <input type="hidden" name="idinscripcion" id="idinscripcion">
                <input type="hidden" name="inputcode" id="inputcod" name="">
                <input type="hidden" required id="idusuario" name="idusuario">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigo" class="control-label">Codigo <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" name="codigo" id="codigo" value="{{old('nombre')}}">
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
                                <button type="button" id="regresar" class="btn btn-dark"><i class=" ti-angle-left"></i> Cancelar</button>
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> Inscribir Alumno</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>