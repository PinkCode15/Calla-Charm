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
                margin-bottom: 10px;
                text-align:center;
                margin-top:-15px;
                font-weight:bold;
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

            .login{
                width:37vw;
                height:57vh;
                box-shadow: 8px 8px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                background-color:white;
                padding:20px;
            }
            .login > h1{
                text-align:center;
            }
            .field{
                border:none !important;
                border-bottom:2px solid black!important;
                margin-bottom:10px;
                margin-top:10px;
                font-size:15px;
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
            }
            .close{
                width:30vw;
            }
            .close i{
                float:right;
            }
            .pop{
                position: absolute;
                top:30.3%;
                left:31.5%;
                width:39vw;
                height:78vh;
            }
            .alert-danger > li{
                background-color:red;
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
                <div class="login">
                    <h1>Login</h1>
                    @include('partials._alert')
                    <form method="POST" action="{{ route('login.begin') }}">
                        @csrf
                        <input id="email" type="email" class="form-control field @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                        <select class="custom-select field" id="inputGroupSelect01" required name="type">
                            <option value="" disabled selected>Choose...</option>
                            <option value="customer">Customer</option>
                            <option value="vendor">Vendor</option>
                        </select>
                        <input id="password" type="password" class="form-control field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div><br>
                        <button type="submit" class="btn btn-primary ">Login</button>
                            @if (Route::has('forgotpassword'))
                                <a class="btn btn-link" href="{{ route('forgotpassword') }}">
                                    Forgot Your Password?
                                </a>
                            @endif  
                            <a class="btn btn-link" href="{{ route('register') }}">
                                    Create an account
                            </a>                 
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
        