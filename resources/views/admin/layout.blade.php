<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
  <meta name="author" content="Creative Tim"> @if (Auth::User()->idinstitucion==0)
  <title>Bienvenido :. @yield('title')</title>
  @else
  <title>{{Auth::User()->institucion->abr}} :. @yield('title')</title>
  @endif



  <meta name="theme-color" content="#002b46" />
  <!-- Favicon -->
  <link href="{{asset('collegetheme/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{asset('theme 2/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('theme 2/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('theme 2/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

  <link href="{{asset('collegetheme/assets/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
  <link href="{{asset('collegetheme/assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- Argon CSS -->
  <link href="{{asset('theme 2/css/icons.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('theme 2/plugins/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />


  <link type="text/css" href="{{asset('collegetheme/assets/css/style.css')}}" rel="stylesheet">
  <link type="text/css" href="{{asset('collegetheme/assets/css/argon.css')}}" rel="stylesheet">
  <link type="text/css" href="{{asset('collegetheme/assets/css/offcanvas.css')}}" rel="stylesheet">
  <link type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.28/dist/sweetalert2.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('collegetheme/assets/css/cropper.css')}}">
  <link rel="stylesheet" href="{{asset('theme 2/plugins/jquery-ui/jquery-ui.css')}}">



  <script src="{{asset('theme 2/js/modernizr.min.js')}}"></script>
  <style>
    .float-btn {

      margin: 1em;
      position: fixed;
      bottom: 0;
      right: 0;
      width: 60px;
      height: 60px;
      z-index: 99;

      text-decoration: none;
      background-color: #00;
    }

    .float-btn span {
      font-size: 2em;
    }
  </style>
  @yield('css')
</head>

<body>
  <header class="header-global">

    <nav id="navbar-main" class="navbar navbar-main fixed-top navbar-expand-lg navbar-dark bg-college headroom">
      <div class="container">
        <a class="navbar-brand mr-lg-5" href="{{route('logincheck')}}">
					<img src="{{asset('collegetheme/assets/img/brand/white.png')}}">
				</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global"
          aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="{{route('logincheck')}}">
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
          <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
            @if ($mainmenu->admin!=0)
            <li class="nav-item ">
              <a href="{{route('admin.index')}}" class="nav-link">
                                <i class="ni ni-collection d-lg-none"></i>
                                <span class="nav-link-inner--text">{{Auth::User()->institucion->abr}}</span>
                            </a>
            </li>
            @endif @if (Auth::User()->idinstitucion!=0)
            <li class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
								<i class="ni ni-collection d-lg-none"></i>
								<span class="nav-link-inner--text">Mis Archivos</span>
							</a>
              <div class="dropdown-menu">
                <a href="{{asset('collegetheme/examples/landing.html')}}" class="dropdown-item">Primero Básico A <span class="badge badge-success">INEBCO</span></a>
              </div>
            </li>
            @endif
          </ul>
          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank" data-toggle="tooltip" title="Vincula Tu Facebook">
								<i class="fa fa-facebook-square"></i>
								<span class="nav-link-inner--text d-lg-none">Facebook</span>
							</a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                @if(Auth::User()->foto=="")
                  <img src="{{asset('images/app/user.jpg')}}" alt="Circle image" class="img-fluid rounded-circle shadow" style="width: 20px;">
                  @else
                  <img src="{{asset('collegetheme/assets/img/theme/team-2-800x800.jpg')}}" alt="Circle image" class="img-fluid rounded-circle shadow" style="width: 20px;">
                  @endif

                  <span class="nav-link-inner--text">{{Auth::User()->socialname}}</span>
              </a>

              <div class="dropdown-menu dropdown-menu-sm">
                <div class="dropdown-menu-inner">
                  @foreach(Auth::User()->roles as $admin)
                  <a href="https://demos.creative-tim.com/argon-design-system/docs/getting-started/overview.html'" class="media d-flex align-items-center">
                    <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                      @if ($admin->logo=="")
                      <i class="ni ni-hat-3"></i> @endif
                    </div>
                    <div class="media-body ml-3">
                      <h6 class="heading text-primary mb-md-1">{{$admin->institucion->abr}}</h6>
                      <p class="description d-none d-md-inline-block mb-0">Ciclo {{$admin->institucion->ciclo}}</p>
                    </div>
                  </a>
                  @endforeach

                </div>
                <a href="{{asset('collegetheme/examples/profile.html')}}" class="dropdown-item"><i class="ni ni-badge"></i> Perfil</a>
                <a href="{{asset('collegetheme/examples/register.html')}}" class="dropdown-item"><i class="ni ni-settings"></i> Ajustes</a>
                <a href="{{route('logout')}}" class="dropdown-item"><i class="ni ni-button-power"></i> Salir</a>




              </div>
            </li>
          </ul>
        </div>

      </div>
    </nav>

  </header>
  @include('admin.menus.colegio')
  <div class="row">
    <div class="col-md-12 text-center">
  @include('flash::message')
    </div>
  </div>
  <main class="container">
    <div class="row m-t-20">
      @yield('content')
    </div>


  </main>
  <footer class="footer has-cards">

    <div class="container">
      <div class="row row-grid align-items-center my-md">
        <div class="col-lg-6">
          <h3 class="text-default font-weight-light mb-2">¡Gracias por tu apoyo!</h3>
          <h5 class="mb-0 font-weight-light">Por la ignorancia se desciende a la servidumbre, por la educación se asciende a la libertad. <i><small>Diego Luís Córdoba</small></i>            </h5>
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
  <script src="{{asset('collegetheme/assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('collegetheme/assets/vendor/popper/popper.min.js')}}"></script>
  <script src="{{asset('collegetheme/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>
  <script src="{{asset('collegetheme/assets/vendor/headroom/headroom.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{asset('collegetheme/assets/vendor/onscreen/onscreen.min.js')}}"></script>
  <script src="{{asset('collegetheme/assets/vendor/nouislider/js/nouislider.min.js')}}"></script>
  <script src="{{asset('collegetheme/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('theme 2/plugins/switchery/switchery.min.js')}}"></script>
  <script src="{{asset('theme 2/plugins/switchery/switchery.min.js')}}"></script>
  <!-- Notification js -->
  <script src="{{asset('theme 2/plugins/notifyjs/dist/notify.min.js')}}"></script>
  <script src="{{asset('theme 2/plugins/jquery-ui/jquery-ui.js')}}"></script>




  <!-- Argon JS -->
  <!-- Custom main Js -->
  <script src="{{asset('theme 2/js/jquery.core.js')}}"></script>

  <script src="{{asset('collegetheme/assets/js/argon.js?v=1.0.0')}}"></script>
  <script src="https://getbootstrap.com/docs/4.1/examples/offcanvas/offcanvas.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.28/dist/sweetalert2.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
  <script>
    // Get current path and find target link
    /**
    var path = window.location.pathname.split("/").pop();

    // Account for home page with empty path
    if (path == '') {
        path = './';
    }
    console.log(path)**/
    var path = window.location;
    var target = $('nav a[href="' + path + '"]');
    //console.log(target);

    // Add active class to target link
    target.addClass('active');
  </script>
  <script src="{{asset('collegetheme/assets/js/cropper.js')}}">

  </script>
  @yield('js')
</body>
@yield('modals')

</html>