@extends('layouts.miniview')
<style>
    .sub{
        width:35vw;
        height:42vh;
        box-shadow: 8px 8px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        background-color:white;
        padding:20px;
        min-width:10vw;
        text-align:center;
    }
    .field{
        border:none !important;
        border-bottom:2px solid black!important;
        margin-bottom:5px;
        margin-top:20px;
        font-size:13px;
    }
    .pop{
        position: absolute;
        top:38.3%;
        left:34%;
        width:35vw;
        height:48vh;
    }
</style>
@section('content')
    <div class="sub">
        <h2>Forgot Password</h2>
        @include('partials._alert')
        <form method="POST" action="{{ route('forgotpassword.send') }}">
            @csrf
            <input id="email" type="email" class="form-control field @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
            <select class="custom-select field" id="inputGroupSelect01" required name="type">
                <option value="" disabled selected>Choose...</option>
                <option value="customer">Customer</option>
                <option value="vendor">Vendor</option>
            </select>
            <br><br>
            <button type="submit" class="btn btn-primary ">Reset</button>              
        </form>
    </div>
@endsection
        