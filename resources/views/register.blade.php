<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Sistema de Calificación y Administración Educativa</title>
    <!-- Favicon -->
    <meta name="theme-color" content="#002b46" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="{{asset('theme 2/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('theme 2/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('theme 2/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{asset('collegetheme/assets/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link href="{{asset('collegetheme/assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{asset('collegetheme/assets/css/argon.css')}}" rel="stylesheet">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.28/dist/sweetalert2.css" rel="stylesheet">
    <script src="{{asset('theme 2/js/modernizr.min.js')}}"></script>
</head>

<body>
    <header class="header-global">
        <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light">
            <div class="container">
                <a class="navbar-brand mr-lg-5" href="../index.html"><img src="{{asset('collegetheme/assets/img/brand/white.png')}}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="navbar-collapse collapse" id="navbar_global">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="../index.html">
                    <img src="{{asset('collegetheme/assets/img/brand/blue.png')}}">
                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global"
                                    aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="section section-shaped section-lg my-0 ">
            <div class="shape shape-style-1 bg-default ">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container pt-lg-md " style="padding-top: 1rem !important;">
                <div class="row ">
                    <div class="col-lg-5 align-middle">
                        <h1 class="display-3 m-t-20   text-white">¡Registra tu colegio!
                            <span> </span>
                        </h1>
                        <p class="lead  text-white">
                            <p class="text-muted"> y accede a las herramientas tecnologicas del siglo XXI y cubre todas las necesidades de gestión
                                y comunicación de tu centro educativo </p>
                        </p>
                    </div>
                    <div class="col-lg-7">
                        <form role="form" method="POST" action="{{route('registrar.store')}}">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-header bg-white pb-3">
                                    <div class=" text-muted mt-10 mb-2">
                                        <strong>1. </strong><small>Información Personal</small>
                                    </div>

                                </div>
                                @if(count($errors)>0)
                                <div class="card-header bg-red pb-3">
                                        <div class=" text-muted mt-10 mb-2">
                                                @foreach($errors->all() as $error)
                                                <li class="text-white"> {{$error}}</li>
                                                @endforeach
                                        </div>
    
                                    </div>
                                @endif
                                <div class="card-body px-lg-4 py-lg-5 mt-20">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="nombre" class="text-muted">Nombre</label>
                                                <input class="form-control" placeholder="Nombre" name="nombre" type="text" required autocomplete="off" value="{{old('nombre')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="apellido" class="text-muted">Apellido</label>
                                                <input class="form-control" placeholder="Apellido" name="apellido" type="text" required autocomplete="off" value="{{old('apellido')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="genero" class="text-muted">Genero</label>
                                                <select name="genero" id="" required class="form-control">
                                                    <option value="">Genero</option>
                                                    @if(old('genero')=="M")
                                                    <option selected value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    @elseif(old('genero')=="F")
                                                    <option value="M">Masculino</option>
                                                    <option selected value="F">Femenino</option>
                                                    @else
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="apellido" class="text-muted">Nacimiento</label>
                                                <input class="form-control" name="nacimiento" required autocomplete="off" value="{{old('nacimiento')}}" type="date">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="apellido" class="text-muted">Correo</label>
                                                <input class="form-control" placeholder="Correo Electrónico" name="correo" required autocomplete="off" value="{{old('correo')}}"
                                                    type="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="apellido" class="text-muted">Contraseña</label>
                                                <input class="form-control" placeholder="Correo Electrónico" name="pass" required autocomplete="off" value="{{old('pass')}}"
                                                    type="password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="apellido" class="text-muted">Repetir Contraseña</label>
                                                <input class="form-control" placeholder="Repetir Contraseña" name="pass_confirmation" required autocomplete="off" value="{{old('pass_confirmation')}}"
                                                    type="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header bg-white pb-3">
                                    <div class=" text-muted mt-10 mb-2">
                                        <strong>2. </strong><small>Información de la Institución</small>
                                    </div>
                                </div>
                                <div class="card-body px-lg-4 py-lg-5 mt-20">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="nombre" class="text-muted">Nombre Institución</label>
                                                <input class="form-control" placeholder="Institución" name="institucion" required autocomplete="off" value="{{old('institucion')}}"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="apellido" class="text-muted">Abreviatura</label>
                                                <input class="form-control" placeholder="Ejemplo: INED" name="abr" required autocomplete="off" value="{{old('abr')}}" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="apellido" class="text-muted">Dirección</label>
                                                <input class="form-control" placeholder="Dirección" name="direccion" required autocomplete="off" value="{{old('direccion')}}"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="apellido" class="text-muted">Telefono</label>
                                                <input class="form-control" placeholder="Telefono" required autocomplete="off" value="{{old('tel')}}" name="tel" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group btn-group">

                                                <button class="btn btn-dark"><i class="ti-return"></i> Regresar</button>
                                                <button type="submit" class="btn btn-success"> Registrarme</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer has-cards">

        <div class="container">
            <div class="row row-grid align-items-center my-md">
                <div class="col-lg-6">
                    <h3 class="text-default font-weight-light mb-2">¡Comunicate el equipo de desarrollo!</h3>
                    <h5 class="mb-0 font-weight-light">Por la ignorancia se desciende a la servidumbre, por la educación se asciende a la libertad. <i><small>Diego Luís Córdoba</small></i>                        </h5>
                </div>
                <div class="col-lg-6 text-lg-center btn-wrapper">
                    <a target="_blank" href="https://twitter.com/creativetim" class="btn btn-neutral btn-icon-only btn-twitter btn-round btn-lg"
                        data-toggle="tooltip" data-original-title="Follow us">
                    <i class="fa fa-twitter"></i>
                </a>
                    <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg"
                        data-toggle="tooltip" data-original-title="Like us">
                    <i class="fa fa-facebook-square"></i>
                </a>
                    <a target="_blank" href="https://dribbble.com/creativetim" class="btn btn-neutral btn-icon-only btn-dribbble btn-lg btn-round"
                        data-toggle="tooltip" data-original-title="Follow us">
                    <i class="fa fa-dribbble"></i>
                </a>
                    <a target="_blank" href="https://github.com/creativetimofficial" class="btn btn-neutral btn-icon-only btn-github btn-round btn-lg"
                        data-toggle="tooltip" data-original-title="Star on Github">
                    <i class="fa fa-github"></i>
                </a>
                </div>
            </div>
            <hr>
            <div class="row align-items-center justify-content-md-between">
                <div class="col-md-6">
                    <div class="copyright">
                        &copy; 2018
                        <a href="https://www.creative-tim.com" class="text-default" target="_blank">LIA Solutions</a>.
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-footer justify-content-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Equipo</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">Sobre Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://github.com/creativetimofficial/argon-design-system/blob/master/LICENSE.md" class="nav-link" target="_blank">Empleos
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Core -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/popper/popper.min.js"></script>
    <script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/vendor/headroom/headroom.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>