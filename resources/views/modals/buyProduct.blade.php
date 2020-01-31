@php
$sizeSelection = explode(',',$product->size);
@endphp
<style>
    .close i{
        float:left;
    }
</style>
<div class="modal fade wallet-modal alert-modal" id="buyProductModal_{{ $product->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="fundWalletModalLabel">BUY PRODUCT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{ route('menu.cart.add') }}" method="post">
                    @csrf
                    <input type="hidden" name="productId" value="{{ $product->id }}">
                    @if ($product->type == 'cloth' || $product->type == 'shoe')
                        <select name="size" class="form-control" required>
                            <option value="" disabled selected>Size</option>
                            @foreach($sizeSelection as $size)
                                <option value="{{$size}}" class="text-uppercase">{{$size}}</option>
                            @endforeach
                        </select>
                        <br>
                    @endif
                    <input type="number" class="form-control" name="quantity" required autofocus placeholder=" Quantity" min="1" max="{{$product->quantity}}">
                    <br>
                    <div class="modal-footer text-center mt-20">
                        <button type="submit" class="btn btn-success">Buy</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
