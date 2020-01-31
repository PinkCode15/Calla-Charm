
@extends('layouts.app')

@section('otherStyles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css"/>

@stop

<style>
 .category-link{
    height: 200px;
}
.category-link a{
    text-decoration: none !important;
}

 .category-box{
    padding-top: 50px;
    height:150px;
    border-radius: 3%;
}
.category-box:hover{
    border:5px solid white;
}
</style>
{{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"> --}}
{{-- <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet" type="text/css"> --}}
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
        <div class="col-md-4 category-link">
            <a  onclick="sendToForm('all')">
                <div class="panel panel-default has-bg-image bg-grey category-box">
                    <div class="panel-body text-center">
                        {{-- <i class="icon-book" style="font-size: 25pt; color: rgba(255, 255, 255, 0.6)"></i><br/> --}}
                        <span style="font-size: 25px;color:white;">ALL</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 category-link">
            <a  onclick="sendToForm('book')">
                <div class="panel panel-default has-bg-image bg-pink category-box">
                    <div class="panel-body text-center">
                        {{-- <i class="icon-book" style="font-size: 25pt; color: rgba(255, 255, 255, 0.6)"></i><br/> --}}
                        <span style="font-size: 25px;color:white;">BOOKS</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 category-link">
            <a onclick="sendToForm('cloth')">
                <div class="panel panel-default has-bg-image bg-blue category-box">
                    <div class="panel-body text-center">
                        {{-- <i class="icon-square" style="font-size: 25pt; color: rgba(255, 255, 255, 0.6)"></i><br/> --}}
                        <span style="font-size: 25px;color:white;">CLOTHES</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 category-link">
            <a onclick="sendToForm('hair')">
                <div class="panel panel-default has-bg-image bg-brown category-box">
                    <div class="panel-body text-center">
                        {{-- <i class="icon-cloud" style="font-size: 25pt; color: rgba(255, 255, 255, 0.6)"></i><br/> --}}
                        <span style="font-size: 25px;color:white;">HAIR</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 category-link">
            <a onclick="sendToForm('shoe')">
                <div class="panel panel-default has-bg-image bg-violet category-box">
                    <div class="panel-body text-center">
                        {{-- <i class="icon-triangle" style="font-size: 25pt; color: rgba(255, 255, 255, 0.6)"></i><br/> --}}
                        <span style="font-size: 25px;color:white;">SHOES</span>
                    </div>
                </div>
            </a>
        </div>
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
function sendToForm($category){
    var x = document.getElementById("categoryselect");
    for (i = 0; i < x.options.length; i++) {
        if (x.options[i].value == $category){
            x.options[i].selected = true;
            break;
        }
    }
    document.getElementById("categoryform").submit();
}
</script>
@stop


