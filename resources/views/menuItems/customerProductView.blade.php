
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
    <form action="{{ route('menu.customerproduct.select') }}" method="post" id="categoryform">
        @csrf
        <select name="category" id="categoryselect" class="form-control" onchange="sendForm()">
            <option value="" disabled selected>Category...</option>
            @foreach($categories as $category)
                <option value="{{ $category}}" class="text-uppercase">{{ strtoupper($category)}}</option>
            @endforeach
        </select>
    </form>
    <br>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 category-link">
                <a href="{{ route('menu.customerproduct.product', ['id'=> $product->id]) }}">
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


