<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calla Charm</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css"
        rel="stylesheet"  type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Baskervville&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body {
                background-image: url("{{asset('images/callacharm11.png')}}");
                background-size:cover;
                background-repeat: no-repeat;
                color: black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-family: 'Great Vibes', cursive;
                font-size:120px;
                margin-bottom: -40px;
                font-weight:bold;
            }
            .slogan{
                font-family: 'Baskervville', serif;
                font-weight:bold;
            }

            .links > a {
                color: white;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .top-right > a{
                color:black;
                font-size: 18px;
            }
            .m-b-md {
                margin-bottom: 50px;
            }
            .products{
                margin-top:30px;
                font-size: 18px !important;
                font-family: 'Baskervville', serif;
            }
            i{
                margin-left:5px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            @if (Route::has('login'))
                <div class="top-right links">
                    @auth($guard)
                        <a href="{{ route('menu.wallet') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class ="m-b-md">
                    <div class="title">
                        Calla Charm
                    </div>
                    <div class ="slogan">
                        your one stop store for convenient and elegant trade...
                    </div>
                </div>

                <div class = "products">
                    <a href="#" class="btn btn-success btn-lg active" role="button" aria-pressed="true">See Products <i class="fa fa-arrow-right fa-1x"></i></a>
                </div>
            </div>
        </div>
    </body>
</html>
