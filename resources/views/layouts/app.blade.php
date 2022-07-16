<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @if(request()->cookie('theme') !== null)
        <link href="{{ request()->cookie('theme') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
{{--  https://stackoverflow.com/questions/52951922/how-do-i-place-these-2-buttons-in-different-forms-side-by-side--}}
    <style>
        form + form {
            display: inline-block;
            transform:translate(100%,-100%);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <div class="dropdown show">
                        <a class="nav-link nav-item" role="button" href="#" id="themeDropdownLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Themes <span class="caret"> </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="themeDropdownLink">
                            @foreach(\App\Theme::all() as $theme)
                                @if($theme->cdn_url == request()->cookie('theme'))
                                    <li class="divider"></li>
                                    <form action="/themes/set/{{ $theme->id }}" method="post">
                                        @csrf
                                        <button class="nav-link nav-item border-0 bg-transparent">{{ $theme->name }}<strong>&check;</strong></button>
                                    </form>
                                @else
                                    <li class="divider"></li>
                                    <form action="/themes/set/{{ $theme->id }}" method="post">
                                        @csrf
                                        <button class="nav-link nav-item border-0 bg-transparent">{{ $theme->name }}
                                            @if($theme->name == "Default" and !$theme->cdn_url == request()->cookie('theme'))
                                                <strong>&check;</strong>@endif</button>
                                    </form>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{--Source code: https://stackoverflow.com/questions/30712420/displaying-navbar-according-to-user-roles-and-permisions-laravel--}}
                            @if (Auth::user()->isThemeManager('Theme Manager'))
                            <li><a class="nav-link" href="/themes">Manage Themes</a></li>
                            @endif
                            <li><a class="nav-link" href="/home">Posts</a></li>
                            <li><a class="nav-link" href="/admin/users">Manage Users</a></li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
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
            @include('flash-message')
            @yield('content')
        </main>
    </div>
</body>
</html>
