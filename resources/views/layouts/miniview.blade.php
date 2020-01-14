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
                /* background-color: #9fa2a8; */
            }
            .title {
                font-family: 'Great Vibes', cursive;
                font-size:70px;
                margin-bottom: 5px;
                text-align:center;
                font-weight:bold;
                /* margin-top:-10px; */
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

            .sub > h2{
                margin-bottom : 10px;
                text-align:center;
            }
            .sub > p{
                color:red;
                font-weight:bold;
            }
            
            .content {
                text-align: center;
            }
            .m-b-md > a{
                text-decoration:none;
                color:black;
            }
            li{
                list-style:none;
                color:black; 
                font-weight:bold;
                margin-left:-60px;
            }
            .close{
                width:30vw;
            }
            .close i{
                float:right;
            }
            .alert-danger > li{
                background-color:red !important;
                color:white !important;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class ="m-b-md">
                <a href="{{ route('welcome') }}"><div class="title">
                    Calla Charm
                </div></a>
                @yield('content')
            </div>
        </div>
    </body>
</html>