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
        <form method="POST" action="{{ route('resetpassword.send') }}">
            @csrf
            <input id="password" type="password" class="form-control field" name="password" required autocomplete="current-password" placeholder="Password">
            <input id="confirmPassword" type="password" class="form-control field" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm password">
            <br>
            <input type="hidden" name='id' value = "{{ $id}}">
            <input type="hidden" name='type' value = "{{ $type}}">
            <button type="submit" class="btn btn-primary ">Reset</button>              
        </form>
    </div>
@endsection
        