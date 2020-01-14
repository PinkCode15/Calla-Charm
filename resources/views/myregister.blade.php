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
                margin-bottom: 0px;
                text-align:center;
                margin-top:-10px;
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
                width:40vw;
                height:78vh;
                box-shadow: 8px 8px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                background-color:white;
                padding:20px;
                min-width:10vw;
            }
            .login > h1{
                margin-top : -8px;
                text-align:center;
            }
            .field{
                border:none !important;
                border-bottom:2px solid black!important;
                margin-bottom:6px;
                margin-top:6px;
                font-size:13px;
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
                top:19.3%;
                left:31%;
                width:40vw;
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
                    <h1>Register</h1>
                    @include('partials._alert')
                    <form method="POST" action="{{ route('register.create') }}">
                        @csrf
                        <input id="firstName" type="text" class="form-control field" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="First Name">
                        <input id="lastName" type="text" class="form-control field" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Last Name">
                        <input id="email" type="email" class="form-control field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        <input id="phoneNumber" type="tel" class="form-control field" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus placeholder="Phone Number">
                        <select class="custom-select field" id="inputGroupSelect01" required name="type">
                            <option value="" disabled selected>Choose...</option>
                            <option value="customer">Customer</option>
                            <option value="vendor">Vendor</option>
                        </select>
                        <input id="uname" type="text" class="form-control field" name="uname" value="{{ old('uname') }}" required autocomplete="uname" autofocus placeholder="Username / Company Name">
                        <input id="password" type="password" class="form-control field" name="password" required autocomplete="current-password" placeholder="Password">
                        <input id="confirmPassword" type="password" class="form-control field" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm password">
                        <br>
                        <button type="submit" class="btn btn-primary ">Register</button> 
                        <a class="btn btn-link" href="{{ route('login') }}">
                            Login to account
                        </a>              
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
        