<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Calla Charm') }}</title>

    <!-- Scripts -->
    
    <script src="{{ asset('js/main.js') }}" type="a5b93a45ef1c8e2122a81543-text/javascript"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="a5b93a45ef1c8e2122a81543-|49" defer=""></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
        rel="stylesheet"  type='text/css'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href = "{{asset('css/sidebar.css') }}" rel = "stylesheet">
    @yield('otherStyles')
    <style>
    .title {
        font-family: 'Great Vibes', cursive;
        font-size:37px;
        text-align:center;
        margin-top:-10px;
        margin-bottom: -15px;
        margin-left:-10px;
        color:white !important;
    }
    .navbar{
        background-color:#20B2AA !important;
        color:white !important;
    }
    .pic{
        border-radius:20px;
        border:2px outset white;
        height:35px;
        width:35px;
        /* background-color:pink; */
        float:left;
        margin-right:10px;
        /* margin-left:-5px; */
    }
    /* .dropdown-menu-right{
        margin-top:5px !important;
    } */
    .dropdown-menu{
        margin-right:-10px !important;
        background-color:#20B2AA !important;
    }
    .dropdown-item{
        color:white !important;
    }
    .dropdown-item:hover{
        background-color:black;
    }
    
    .nav-link{
        color:white !important;
    }
    /* .dropdown-toggle{
        margin-right:40px;
        width:100px;
        background-color:red;
    } */

    /* @media (min-width: 760px) {
        .dropdown-toggle{
            margin-right:0px;
        } */
    .mr-3{
        color:white!important;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand title" href="{{ url('/') }}">
                    Calla Charm
                </a>
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
                        @guest($guard)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <span class="pic" style="background-color:{{Auth::guard($guard)->user()->photo}}">
                                </span>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ $user->first_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        Edit Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name= "type" value = "{{$guard}}">
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="wrapper d-flex align-items-stretch side ">
            <nav id="sidebar">
                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                    </button>
                </div>
                <div class="p-4">
                    <!-- <h1><a href="index.html" class="logo">Portfolic <span>Portfolio Agency</span></a></h1> -->
                    <ul class="list-unstyled components mb-5">
                        @include('partials._sideBar')
                    </ul>
                </div>
            </nav>

            <div id="content" class="p-4 p-md-5 pt-5">
                @yield('content')
                <!-- <h2 class="mb-4">Sidebar #05</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
@yield('script')
@yield('javascript')
</body>
</html>
