<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if ($_SERVER['SERVER_NAME'] == "localhost")
        <script src="{{url('js/jquery/jquery-3.0.0.min.js')}}"></script>
    @else
        <script src="https://comparadordeventas.com/pagolibre/public/js/jquery/jquery-3.0.0.min.js"></script>
    @endif
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @if ($_SERVER['SERVER_NAME'] == "localhost")
        <script src="{{ asset('js/app.js') }}" defer></script>
    @else
        <script src="https://comparadordeventas.com/pagolibre/public/js/app.js"></script>
    @endif
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @if ($_SERVER['SERVER_NAME'] == "localhost")
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <?php $urlLogout = route('logout');?>
        <?php $urlEmpresaListado = url('/empresa/listar');?>
    @else
        <link rel="stylesheet" href="https://comparadordeventas.com/pagolibre/public/css/app.css">
        <?php $urlLogout = "https://comparadordeventas.com/pagolibre/public/logout";?>
        <?php $urlEmpresaListado = "https://comparadordeventas.com/pagolibre/public/empresa/listar";?>
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <strong>{{ config('app.name', 'Laravel') }} &emsp;&emsp;</strong>
                @auth
                    @if(isset(Auth::user()->usersRolId) && Auth::user()->usersRolId==1)
                        <a class="navbar-brand" href="{{ $urlEmpresaListado }}">
                            Empresa
                        </a>
                        <a class="navbar-brand" href="{{ url('usuario/listar') }}">
                            Usuario
                        </a>
                        
                    @endif
                    <a class="navbar-brand" href="{{ url('listarProducto') }}">
                        <strong>Productos</strong>
                    </a>
                    <a class="navbar-brand" href="{{ url('listarSalsa') }}">
                        <strong>Salsas</strong>
                    </a>
                    @if(isset(Auth::user()->usersRolId) && Auth::user()->usersRolId==3)
                        <a class="navbar-brand" href="{{ url('ventaDiarioLocal') }}">
                            <strong>Ventas</strong>
                        </a>
                        <a class="navbar-brand" href="{{ url('home') }}">
                            <strong>Venta del Día</strong>
                        </a>
                    @endif
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <!--<li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>-->
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style='color:#28a745' class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <strong> {{ Auth::user()->name }} <span style='color:#28a745' class="caret"></span></strong>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ $urlLogout }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ $urlLogout }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
        @yield('js')
</body>
</html>
