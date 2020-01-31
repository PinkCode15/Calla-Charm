@extends('layouts.app')

<style>
.row{
    margin-bottom: 20px;
    padding-top: 10px;
    padding-bottom: 10px;
}
.base{
    padding-bottom: 10px;
    border-bottom: 2px solid black;
}
.base2:hover{
    background-color: lightgray !important;
}
.alert .close i{
    margin-top:20px !important;
}
</style>
<link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet" type="text/css">
@section('content')
@include('partials._alert')
<div class = "container">
    @if($cart->count() < 1)
        <h3 class="text-center" style="margin-top:25%;">No Product Added To Cart</h3>
    @else
    <div class="row base">
        <div class="col-md-3 text-center" style="font-weight:bold;">
            Name of Product
        </div>
        <div class="col-md-1 text-center" style="font-weight:bold;">
            Quantity
        </div>
        <div class="col-md-2 text-center" style="font-weight:bold;">
            Unit price
        </div>
        <div class="col-md-2 text-center" style="font-weight:bold;">
            Total Amount
        </div>
    </div>

    @foreach($cart as $item)
    <div class="row base2">
        <div class="col-md-3 text-center">
            {{$item->closedTrade->product->name}}
            @if($item->closedTrade->size != null )<span class="btn-block">Size: {{$item->closedTrade->size}}</span>@endif
        </div>
        <div class="col-md-1 text-center">
            {{$item->closedTrade->quantity}}
        </div>
        <div class="col-md-2 text-center">
            ₦ {{number_format($item->closedTrade->price)}}
        </div>
        <div class="col-md-2 text-center">
            ₦ {{number_format ($item->closedTrade->price * $item->closedTrade->quantity) }}
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-1">
            <form action="{{ route('menu.cart.pay') }}" method="post">
                @csrf
                <input type="text" name= "productId" value="{{$item->closedTrade->product->id}}" hidden >
                <button class="btn btn-success text-center">Pay</button>
            </form>
        </div>
        <div class="col-md-1">
            <form action="{{ route('menu.cart.remove') }}" method="post">
                @csrf
                <input type="text" name= "productId" value="{{$item->closedTrade->product->id}}" hidden >
                <button class="btn btn-danger text-center" type="submit">Remove</button>
            </form>
        </div>
    </div>
    @endforeach
    <br><br>
    <div class="row">
        <div class="col-md-2">
            <form action="{{ route('menu.cart.add') }}" method="post">
                @csrf
                <button class="btn btn-success text-center">Pay All</button>
            </form>
        </div>
        <div class="col-md-2">
            <form action="{{ route('menu.cart.add') }}" method="post">
                @csrf
                <button class="btn btn-danger text-center">Remove All</button>
            </form>
        </div>
    </div>
    @endif
</div>
@stop

@section('script')

@stop
