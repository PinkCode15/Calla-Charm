@extends('layouts.app')
@@section('content')
<style>
    .account-number {
        font-size: 40px;
        margin: 0;
        font-weight: bolder;
    }

    .account-name {
        letter-spacing: 4px;
        margin: 0;
        font-size: 18px;
        font-weight: lighter;
        color: #888;
    }

    .bank-name {
        margin: 0;
        display: inline-block;
        background: #fff;
        padding: 2px 10px;
        border-radius: 4px;
        color: #5c8c8c;
        position: absolute;
        top: -15px;
        right: -2px;
        box-shadow: 0 1px 6px 0 rgba(0,0,0,0.15);
        font-weight: 100;
        text-transform: uppercase;
        font-size: 15px;
        letter-spacing: 3px;
    }

    .placeholder {
        border: 1px dashed #888a85;
        padding: 20px;
    }

    .balance-col .account-name {
        letter-spacing: 1px !important;
        margin-top: -5px;
    }
</style>
    <div class="placeholder text-center">
        <h1 class="account-number m-0">{{ $user->acount_number}}</h1>
        <h2 class="account-name text-uppercase" style="letter-spacing: 2px">{{ $user->account_name }}</h2>
        <h3 class="bank-name">{{ $user->bank }}</h3>
    </div>
@endsection