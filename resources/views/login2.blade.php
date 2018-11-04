<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Minton - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- App css -->
    <link href="{{asset('theme 1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('theme 1/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('theme 1/css/style.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('theme 1/js/modernizr.min.js')}}"></script>

</head>

<body>

    <div class="wrapper-page">

        <div class="log-page">
            <div class="text-center">
                <a href="index.html" class="logo-lg"><i class="mdi mdi-radar"></i> <span>INEBCO</span> </a>
                <p>Bienvenido al sistema de calificaciones LIA del </p>
                <hr>
            </div>
            <form class="form-horizontal m-t-20" method="POST" action="{{route('authlogin')}}">
                @csrf
            
                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="ti ti-user"></i></span>
                        <input class="form-control" name="usuario" type="text" required="" placeholder="Usuario" value="{{old('usuario')}}">
                        </div>
                    </div>
                </div>
            
                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="ti ti-key"></i></span>
                            <input class="form-control" type="password" name="password" required="" placeholder="Contraseña">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        @include('flash::message')
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" name="recordar" type="checkbox">
                            <label for="checkbox-signup">
                                            Recuerdame
                                        </label>
                        </div>
            
                    </div>
                </div>
            
                <div class="form-group text-right m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Log In
                                    </button>
                    </div>
                </div>
            
                <div class="form-group row m-t-30">
                    <div class="col-sm-7">
                        <a href="pages-recoverpw.html" class="text-muted"><i class="ti ti-lock  m-r-5"></i> Olvidé mi contraseña</a>
                    </div>
            
                </div>
            </form>
        </div>
    </div>


    <!-- jQuery  -->
    <script src="{{asset('theme 1/js/jquery.min.js')}}"></script>
    <script src="{{asset('theme 1/js/popper.min.js')}}"></script>
    <!-- Popper for Bootstrap -->
    <!-- Tether for Bootstrap -->
    <script src="{{asset('theme 1/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('theme 1/js/waves.js')}}"></script>
    <script src="{{asset('theme 1/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('theme 1/js/jquery.scrollTo.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('theme 1/js/jquery.core.js')}}"></script>
    <script src="{{asset('theme 1/js/jquery.app.js')}}"></script>

</body>

</html>