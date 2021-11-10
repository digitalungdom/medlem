<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Test --!>

    <title>Vestfold Digitale Ungdom</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    @livewireStyles
    @powerGridStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/VDU-logo.png" width=120>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li><a class="nav-link" href="{{route('events.index')}}">Arrangementer</a></li>
                            {{-- <li><a class="nav-link" href="{{route('spillservere.index')}}">Spillservere</a></li> --}}
                            <li><a class="nav-link" href="{{route('membership.index')}}">Medlemsskap</a></li>
                            <li><a class="nav-link" href="#">Bli frivillig</a></li>

                                <li class="dropdown">
                                    @canany(['events','roles','membershipType','users'])
                                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Admin</span> <span class="caret"></span></a>
                                    @endcanany
                                        <ul class="dropdown-menu">
                                        @can('events')
                                            <li><a class="nav-link" href="{{ route('events.admin') }}"> Arrangementer</a></li>
                                        @endcan

                                        @can('roles')
                                            <li><a class="nav-link" href="{{ route('role.index') }}">Tilgangsstyring</a></li>
                                        @endcan

                                        @can('membershipType')
                                            <li><a class="nav-link" href="{{ route('membershipType.index') }}">Medlemsskapstyper</a></li>
                                        @endcan

                                        @can('users')
                                            <li><a class="nav-link" href="{{ route('users.index') }}">Brukerliste</a></li>
                                        @endcan
                                    </ul>
                                </li>

                        @endauth
                    </ul>
                    <ul class="navbar-nav ml-auto align-items-baseline">
                        @auth
                            
                        
                        @if(Auth::user()->is_parent)
                            <div class="dropdown">Person: 
                                <form method=POST action='{{ route('children.changeuser') }}' name="changeuser">
                                    @csrf
                                    <select name=changeuser onchange="this.form.submit()">
                                        <option name='children' value='{{ Auth::user()->id }}'>{{ Auth::user()->FullName }}</option>
                                        @foreach(Auth::user()->children() as $child)
                                            <option name='children' value='{{ $child->id }}'>{{ $child->FullName }}</option>
                                        @endforeach
                                        <option>---</option>
                                        <option value='create'>Legg til nytt barn</option>
                                    </select>
                                </form>
                            </div>
                        @elseif(Session::has('parentuser')) 
                            <div>
                                <form method=POST action='{{ route('children.changeuser') }}' name="changeuser">
                                    @csrf
                                    <input type=hidden name=changeuser value='{{ session('parentuser') }}'>
                                    <input type=submit value='Tilbake til foresattkonto'>
                                </form>
                            </div>
                        @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Logg inn') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrer konto') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    <!-- Scripts -->
    @livewireScripts
    @powerGridScripts
</body>
</html>
