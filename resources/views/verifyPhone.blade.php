@extends('layouts.miniview')
<style>
    .sub{
        width:35vw;
        height:40vh;
        box-shadow: 8px 8px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        background-color:white;
        padding:20px;
        min-width:10vw;
        text-align:center;
    }

    .field{
        border:none !important;
        border-bottom:2px solid black!important;
        margin-bottom:10px;
        margin-top:30px;
        font-size:13px;
    }
    .pop{
        position: absolute;
        top:39.3%;
        left:34%;
        width:35vw;
        height:48vh;
    }
</style>
@section('content')
    <div class="sub">
        <h2>Phone Number Verification</h2>
        @include('partials._alert')
        <p >Kindly check your phone for a 6-digit OTP</p>
        <form method="POST" action="{{ route('phone.verify') }}">
            @csrf
            <input id="otp" type="number" class="form-control field" name="otp" required autofocus placeholder=" Enter OTP">
            <br>
            <input type="hidden" name='id' value = "{{ $id}}">
            <input type="hidden" name='type' value = "{{ $type}}">
            <button type="submit" class="btn btn-primary ">OK</button>              
        </form>
    </div>
@endsection

        