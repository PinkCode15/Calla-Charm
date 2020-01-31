
@extends('layouts.app')

<style>
.category-link{
    /* border:3px solid red; */
    height: 200px;
    margin-bottom: 90px;
}
.category-link:hover{
    border:3px solid white;
}
.category-link a{
    text-decoration: none !important;
    color: black;
}
.category-link a:hover{
    border:5px solid white;
    color:lightseagreen;
}

.product-img{
    width: 100%;
    height: 100%;
}
.product-detail{
    border-left: 2px solid black;
    padding-left: 5px;
}
</style>
<link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet" type="text/css">
@section('content')
@include('partials._alert')
<div class = "container">
    <div class="row">
        @if($products->isEmpty())
            <div class="col-md-12">
                No Products Added
            </div>
        @else
            @foreach($products as $product)
                <div class="col-md-4 category-link">
                    <a href="{{ route('menu.vendorproduct.product', ['id'=> $product->id]) }}">
                        <div class="">
                            <img src="{{ $product->productPicture->first()->getAvatarAttribute() }}" alt="{{ $product->name }}" class=" product-img">
                        </div>
                        <br>
                        <div class="product-detail">
                            <div>
                                {{ $product->name }}
                            </div>
                            <div>
                                ₦ {{ number_format( $product->price )}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    <br>
    <div>
        <a href="{{route('menu.vendorproduct.new')}}"><button class="btn btn-primary">Add Product  <span class="fas fa-plus "></span></button></a>
    </div>
</div>
@stop

@section('script')

@stop

@section('javascript')
<script>
function sendForm(){
    document.getElementById("categoryform").submit();
}
</script>
@stop


