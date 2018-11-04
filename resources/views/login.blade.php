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
                    <div class="col-lg-7 align-middle">
                        <h1 class="display-3 m-t-20   text-white">Revisa Tus Calificaciones
                            <span>¡Donde quieras!</span>
                        </h1>
                        <p class="lead  text-white">Bienvenido al sistema de Gestión y Administración escolar, la plataforma para los colegios del Siglo XXI</p>
                        <div class="btn-wrapper mobilehide">
                            <a href="https://demos.creative-tim.com/argon-design-system/docs/components/alerts.html" class="btn btn-warning btn-icon mb-3 mb-sm-0">
                                    <span class="btn-inner--icon"><i class="fa fa-code"></i></span>
                                    <span class="btn-inner--text">¡Registra tu Colegio! 0.99 <small><small><small>Por Alumno*Mes</small></small></small></span>
                                  </a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card bg-secondary shadow border-0">
                            <div class="card-header bg-white pb-3">
                                <div class="text-muted text-center mb-3">
                                    <small>¿Tienes vinculada tu cuenta? </small>
                                </div>
                                <div class="btn-wrapper text-center">
                                    <a href="#" class="btn btn-neutral btn-icon"><span class="btn-inner--icon"><i class="fa fa-facebook-square"></i></span><span class="btn-inner--text">Facebook</span></a>
                                    <a href="#" class="btn btn-neutral btn-icon">
                    <span class="btn-inner--icon text-warning">
                      <i class="fa fa-google"></i>
                    </span>
                    <span class="btn-inner--text text-warning">Google</span>
                  </a>
                                </div>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <small>O ingresa con tus credenciales</small>
                                </div>
                                <form role="form" method="POST" action="{{route('authlogin')}}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Usuario" name="usuario" {{old('usuario')}} type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" name="password" placeholder="Contraseña" type="password">
                                        </div>
                                    </div>
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                        <label class="custom-control-label" for=" customCheckLogin">
                      <span>Recuerdame</span>
                    </label>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            @include('flash::message')
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success my-4">Ingresar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <a href="#" class="text-light">
                  <small>Olvidó su contraseña?</small>
                </a>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#" class="text-light">
                  
                </a>
                            </div>
                        </div>
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