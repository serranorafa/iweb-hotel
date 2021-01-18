<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="jumbotron">
            <div style="float: right;margin-right: 10%; margin-top:0.5%;text-align: center">
            @guest
                <a class="btn btn-secondary" style="width:100%" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                @if (Route::has('register'))
                <br>
                <br>
                    <a class="btn btn-secondary" style="width:100%" href="{{ route('register') }}">{{ __('Registro') }}</a>
                @endif
            @else
                <a class="btn btn-secondary" style="width:100%;pointer-events: none">
                                                    {{ Auth::user()->nombre }}
                </a>
                <br>
                <br>
                <a class="btn btn-secondary" style="width:100%" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Cerrar sesión') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
        @endguest
            </div>
            <div class="container">
            <a href="/" style="color: black;text-decoration: none"><h1 href="/home" class="display-1" style="margin-left: 1%; margin-top:1%; padding-top:1%;">IWEBHotel</h1></a>
            </div>
            <div style="clear: both"></div>
        </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav" style="width:100%;text-align: center">
                        @if (!Auth::check() || Auth::user()->rol == "CLIENTE")
                        <li class="nav-item active" style="width:100%">
                            <a class="nav-link" href="/news">Noticias y novedades</a>
                        </li>
                        <li class="d-none d-md-block">
                            <a class="nav-link">|</a>
                        </li>
                        <li class="nav-item active" style="width:100%">
                            <a class="nav-link" href="/gallery">Galería</a>
                        </li>
                        <li class="d-none d-md-block">
                            <a class="nav-link">|</a>
                        </li>
                        <li class="nav-item active" style="width:100%">
                            <a class="nav-link" href="/whoarewe">¿Quiénes somos?</a>
                        </li>
                        <li class="d-none d-md-block">
                            <a class="nav-link">|</a>
                        </li>
                        <li class="nav-item active" style="width:100%">
                            <a class="nav-link" href="/contact">Contacto</a>
                        </li>
                        <li class="d-none d-md-block">
                            <a class="nav-link">|</a>
                        </li>
                        <li class="nav-item active" style="width:100%">
                            <a class="nav-link" href="/reservas/create">¡Reserva ya!</a>
                        </li>
                        @elseif (Auth::user()->rol == "RECEPCIONISTA")
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/reservas">Reservas</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/bloqueos">Bloqueos</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/reservas/create">Crear reserva</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/bloqueos/create">Crear bloqueo</a>
                            </li>
                        @elseif (Auth::user()->rol == "WEBMASTER")
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="#">Informes</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/users">Usuarios</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/estancias">Estancias</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/reservas">Reservas</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/servicios">Servicios</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/temporadas">Temporadas</a>
                            </li>
                            <li class="d-none d-md-block">
                                <a class="nav-link">|</a>
                            </li>
                            <li class="nav-item active" style="width:100%">
                                <a class="nav-link" href="/bloqueos">Bloqueos</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
