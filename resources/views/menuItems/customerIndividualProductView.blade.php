
@extends('layouts.app')

<style>
.category-link{
    /* border:3px solid red; */
    height: 200px;
    margin-bottom: 90px;
}

.product-img{
    width: 100%;
    height: 100%;
}
.product-details{
    font-weight:bolder;
    font-size: 20px;
}
.carousel-item img{
    width: 100%  !important;
    height: 150% !important;
}
.carousel-control-next-icon{
    background-color: black !important
}
.carousel-control-prev-icon{
    background-color: black !important
}
.indicate{
    background-color: black !important;
}
.vendor-name{
    font-weight: 20px;
    font-weight: bold;
}
</style>
<link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet" type="text/css">
@section('content')
@include('partials._alert')
<div class = "container">
    <a href="{{ URL::previous() }}"><button class="btn btn-info pull-right"> Back </button></a>
    <br><br><br>
    <div class="row">
        <div class="col-md-5 category-link">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-slide-to="0" class="active indicate"></li>
                  <li data-slide-to="1" class="indicate"></li>
                  <li data-slide-to="2" class="indicate"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-200 " src="{{ $product->productPicture->first()->getAvatarAttribute() }}" alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-200" src="{{ $product->productPicture->first()->getAvatarAttribute() }}" alt="Second slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-200" src="{{ $product->productPicture->first()->getAvatarAttribute() }}" alt="Third slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <br>
            <div class="product-details">
                <div>
                    {{ $product->name }}
                </div>
                <div>
                    ₦ {{ number_format( $product->price )}}
                </div>
            </div>
        </div>
        <div class="col-md-1 ">
        </div>
        <div class="col-md-6 ">
            <div >Brand: <label class="vendor-name">{{ strtoupper($product->vendor->company_name) }}</label></div>
            <div>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
            {{ $product->description }}
        </div>
    </div>
    <div>

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
$('.carousel').carousel({
  interval: 2000
})
</script>
@stop


