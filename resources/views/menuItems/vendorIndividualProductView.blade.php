@php
    $rating  = $product->rating;
    if ($rating != null){
        $numbers = explode('.', $rating);
        $count = $numbers[0];
        if($numbers[1][0] >= 5 || ($numbers[1][0] == 4 && $numbers[1][1] >= 5) )
        {
            $count = $count + 1;
            $remainder = 5 - $count;
        }
        else{
            $remainder = 5 - $count;
        }
    }

@endphp
@extends('layouts.app')

<style>

.col-md-5{
    /* border: 2px solid red; */
    height: 70vh;
}
.checked {
  color: orange;
}
.product-details{
    font-weight:bolder;
    font-size: 20px;
}
.carousel-item img{
    width: 100%  !important;
    height: 70% !important;
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
.rating{
    font-style: italic;
    margin-left: 5px;
}
.rating-number{
    margin-left: 15px;
}
.btn-back{
    float:right;
}
.description{
    /* border: 2px solid red; */
    height: 60vh;
    margin-bottom: 15px;
}
.btn-option{
    font-size: 17px !important;
    padding-left: 18px !important;
    padding-right: 18px!important;
    margin-bottom: 10px
}
.same-msg-box{
    border:2px solid darkseagreen;
    border-radius:5%;
    float:right;
    background-color:darkseagreen;
    padding:10px;
}
.diff-msg-box{
    border:2px solid white;
    border-radius:5%;
    background-color: white;
    float:left;
    padding:10px;
}
.open-trade-modal{
    background-color:lightgrey !important;
}
.open-trade-modal-body{
    /* background-color:lightgrey !important; */
    overflow-y: auto !important;
    height:70vh !important;
    /* border: 5px solid red; */
}
.badge{
    float:right !important;
    font-weight: lighter !important;
}
</style>
@section('content')
@include('partials._alert')
<div class = "container">
    <a href="{{ route('menu.vendorproduct')}}"><button class="btn btn-info btn-back"> Back </button></a>
    <br><br><br>
    <div class="row">
        <div class="col-md-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                @foreach($product->productPicture as $picture)
                @if ($loop->first)
                  <li data-slide-to="0" class="active indicate"></li>
                  @continue
                @endif
                <li data-slide-to="{{$loop->index}}" class="indicate"></li>
                @endforeach
                </ol>
                <div class="carousel-inner">
                  @foreach($product->productPicture as $picture)
                    @if ($loop->first)
                    <div class="carousel-item active">
                        <img class="d-block w-200 " src="{{ $product->productPicture->first()->getAvatarAttribute() }}" alt="slide">
                    </div>
                    @continue
                    @endif
                  <div class="carousel-item">
                    <img class="d-block w-200 " src="{{ $picture->getAvatarAttribute() }}" alt="{{$loop->iteration}} slide">
                  </div>
                @endforeach
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
        <div class="col-md-6 description">
            <div >Brand: <label class="vendor-name">{{ strtoupper($product->vendor->company_name) }}</label></div>
            <div>
                @if ($rating != null)
                    @for ($i = 0; $i < $numbers[0]; $i++)
                        <span class="fa fa-star checked"></span>
                    @endfor
                    @if ($numbers[1][0] >= 5 || ($numbers[1][0] == 4 && $numbers[1][1] >= 5))
                        <span class="fa fa-star-half-alt checked"></span>
                    @endif
                    @for ($i = 0; $i < $remainder; $i++)
                        <span class="far fa-star"></span>
                    @endfor
                @else
                    @for ($i = 0; $i < 5; $i++)
                        <span class="far fa-star"></span>
                    @endfor
                @endif
            <span class="rating">{{$product->rating}}</span>
            <span class="rating-number">{{$product->number_of_ratings}} rating(s)</span>
            </div>
            <br>
            {{ $product->description }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"><button class="btn btn-option btn-success">Edit Product Info</button></div>
        @if(!$openTrade->isEmpty())
            <div class="col-md-4"><button class="btn btn-option btn-dark" data-toggle="modal" data-target="#openTradeListModal">Check Open Trades</button></div>
            @include('modals.openTradeList')
        @endif
        <div class="col-md-4"><button class="btn btn-option btn-danger">Delete Product</button></div>
        {{-- @include('modals.editProduct') --}}
    </div>
</div>
@stop

@section('script')

@stop

@section('javascript')
<script>
$('.carousel').carousel({
  interval: 2000
});

</script>
@stop


