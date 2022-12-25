<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href={{ asset('plugins/fontawesome-free/css/all.min.css') }}> --}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    {{-- <link rel="stylesheet" href={{ asset('dist/css/adminlte.min.css') }}> --}}

    <link rel="stylesheet" href={{ asset('css/vendor/adminLte.core.css') }}>
    @yield('css')
    {{-- Css mandiri --}}
    <link rel="stylesheet" href={{ asset('css/dashboard.css') }}>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Docseeker</b></a>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('info'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>                
                </div>
            @endif
            <div class="card-body">
                <form action="{{route('authenticateAdmin')}}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="icheck-primary text-right">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                    </div>
                    <p class="mb-1">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </p>
                </form>

                
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <script src={{ asset('js/vendor/adminLte.core.js') }}></script>

    <!-- jQuery UI 1.11.4 -->
    {{-- <script src={{ asset('plugins/jquery-ui/jquery-ui.min.js') }}></script> --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        // $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    {{-- <script src={{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script> --}}

    <!-- AdminLTE App -->
    {{-- <script src={{ asset('dist/js/adminlte.js') }}></script> --}}


    @yield('js')

</body>

</html>