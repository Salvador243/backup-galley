<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Gallery', 'HadarA') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="main-pleca">
    <div id="app">
        <!--Navbar-->
        <nav class="navbar navbar-expand navbar-light nav-pleca shadow-sm py-0 mb-5 fixed-top">
            <div class="container">
                <!--Logo-->
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="/storage/logo.svg" width="60" height="60" class="d-line-block my-0">
                </a>
                <!-- Nav items -->
                <ul class="navbar-nav ml-auto mr-auto">
                    <!-- Search bar -->
                    <form action="{{ route('index') }}" method="GET" id="search-form" class="form-inline mr-2">
                        <div class="input-group">
                            <!--Search input-->
                            <input type="search" name="search" id="search_input" class="form-control search-bar"
                                placeholder="Buscar" aria-describedby="search-button" size="50">
                            <div class="input-group-append">
                                <!-- Example split danger button -->
                                <div class="btn-group">
                                    <button class="search-button" id="search-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                            class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </button>
                                    <button type="button"
                                        class="btn search-toggle dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="form-check dropdown-item">
                                            <input class="form-check-input" type="radio" name="radioSearch"
                                                id="radio_pictures" value="pictures" checked>
                                            <label class="form-check-label" for="radioPictures">
                                                Pictures
                                            </label>
                                        </div>
                                        <div class="form-check dropdown-item">
                                            <input class="form-check-input" type="radio" name="radioSearch"
                                                id="radio_profiles" value="profiles">
                                            <label class="form-check-label" for="radioProfiles">
                                                Profiles
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link nav-text" href="{{ route('login') }}">Iniciar Sesi&oacute;n</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link nav-text" href="{{ route('register') }}">Registro</a>
                    </li>
                    @endif
                    @else
                    <!--Notifications bell-->
                    <li class="nav-item mr-2">
                        <a href="#" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bell-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                            </svg>
                        </a>
                    </li>
                    <!--Upload picture option-->
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ route('Upload') }}" role="button">
                            Subir
                        </a>
                    </li>
                </ul>
                <!-- Profile -->
                <div class="dropdown ml-auto">
                    <a id="userDropdown" class="navbar-brand dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{ asset(Auth::user()->avatar) }}" class="avatar" width="35px" height="30px">
                    </a>
                    <!--User dropdown options-->
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <!--Profile option-->
                        <a href="{{ route('Pdetails', Auth::user()->email) }}" class="dropdown-item">
                            Profile
                        </a>
                        <!--Logout option-->
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                @endguest
            </div>
        </nav>

        <main id="main_container mt-5" class="help">
            <div class="mt-5 pt-5">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer-new mb-0 mt-3">
        <div class="container pt-4 mb-2" id="footer-cols">
            <div class="d-flex justify-content-center">
                <!-- Sitemap column -->
                <div class="footer-col pr-4 pr-md-5">
                    <b>SITEMAP</b>
                    <ul class="footer-list">
                        <li><a href="/">Home</a></li>
                        @guest
                        <li><a href="{{ route('login') }}">Iniciar Sesi&oacute;n</a></li>
                        <li><a href="{{ route('register') }}">Registro</a></li>
                        @else
                        <li><a href="{{ route('Pdetails', Auth::user()->email) }}">Perf&iacute;l</a></li>
                        <li><a href="{{ route('Upload') }}">Subir foto</a></li>
                        @endguest
                    </ul>
                </div>
                <!-- Social media column -->
                <div class="footer-col pr-4 pr-md-5 pl-4 pl-md-4">
                    <div class="d-flex justify-content-between mt-4 mb-4">
                        <a href="#" id="facebook-icon" class="mr-4 mr-md-5">
                            <img src="/storage/Facebook.svg" width="50" height="50" alt="">
                        </a>

                        <a href="#" id="instagram-icon">
                            <img src="/storage/Instagram.svg" width="50" height="50" alt="">

                        </a>

                        <a href="#" id="twitter-icon" class="ml-4 ml-md-5">
                            <img src="/storage/Twitter.svg" width="50" height="50" alt="">
                        </a>
                    </div>
                    <p class="text-center"><b>Sugerencias</b><br>
                        example@gmail.com
                    </p>
                </div>
                <!-- Developers information column -->
                <div class="pl-4 pl-md-5">
                    <b>Programadores</b>
                    <ul class="footer-list">
                        <li>Salvador Garc&iacute;a</li>
                        <li>Kevin Arias</li>
                    </ul>
                    <br>
                    <b>Diseñador</b>
                    <ul class="footer-list">
                        <li>Isaias Espinosa</li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <hr id="footer-hr">
        <p class="text-center py-2 mb-0" id="footer-bottom">
            <small class="nav-text">&copy;Copyright 2021, HadarA.</small>
        </p>
    </footer>
</body>

</html>
