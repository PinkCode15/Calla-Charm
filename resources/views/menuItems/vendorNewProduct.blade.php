
@extends('layouts.app')

<style>
.btn-back{
    float:right;
}
.about-input{
    font-style: italic;
    font-weight: bold;
    font-size: 17px;
    margin-bottom: 10px;
}
textarea {
  width:auto;
}
</style>
@section('content')
@include('partials._alert')
<div class = "container">
    <a href="{{ route('menu.vendorproduct')}}"><button class="btn btn-info btn-back"> Back </button></a>
    <br><br>
    <h2>Add Your New Product <div class="btn-back"><button class="btn btn-info btn-back"> See Example</button></div></h2>
    <br>
    <form action="{{route('menu.vendorproduct.add')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="about-input">Name of Product</div>
        <input id="Name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name of Product">
        <br>
        <div class="about-input">Type of Product</div>
        <select name="category" id="categoryselect" class="form-control" onchange="unhideOption()">
            <option value="" disabled selected>Category...</option>
            @foreach($categories as $category)
                <option value="{{ $category}}" class="text-uppercase">{{ strtoupper($category)}}</option>
            @endforeach
        </select>
        <br>
        <div id="sizeInput" hidden>
            <div class="about-input">Available Sizes of Product</div>
            <input type="number" class="form-control" name="size"  required autocomplete="size" autofocus placeholder="Available sizes of Product e.g UK-21, UK-22" >
            <br>
        </div>
        <div class="about-input">Quantity of Product Available</div>
        <input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity" autofocus placeholder="Quantity of Product Available">
        <br>
        <div class="about-input">Price of Product</div>
        <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus placeholder="Price of Product">
        <br>
        <div class="about-input" maxlength="150">Details of the Product</div>
        <textarea  class="form-control" wrap="hard" cols="70" rows="10" placeholder="Product Details" required name="details"></textarea>
        <br>
        <div class="about-input" maxlength="150">Key features of the Product</div>
        <textarea  class="form-control" wrap="hard" cols="70" rows="10" placeholder="Features of the product" required name="features"></textarea>
        <br>
        <div class="about-input" maxlength="150">Specifications of the Product</div>
        <textarea  class="form-control" wrap="hard" cols="70" rows="10" placeholder="Specifications of the product" required name="specifications"></textarea>
        <br>
        <div class="about-input">Picture 1</div>
        <input type="file" class="form-control" name="picture1" accept="image/*" required>
        <br>
        <div class="about-input">Picture 2</div>
        <input type="file" class="form-control" name="picture2" accept="image/*" required>
        <br>
        <div class="about-input">Picture 3</div>
        <input type="file" class="form-control" name="picture3" accept="image/*" required>
        <br>
        <button type="submit" class="btn btn-secondary">Add Product</button>
    </form>
</div>
@stop

@section('script')

{{-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> --}}
@stop

@section('javascript')
<script>
function unhideOption(){
    var option = document.getElementById("categoryselect");
    var selectedText = option.options[option.selectedIndex].value;
    if(selectedText == 'shoe' || selectedText == 'cloth' ){
        document.getElementById("sizeInput").hidden = false;
    }
    else{
        document.getElementById("sizeInput").hidden = true;
    }
}
</script>
@stop


