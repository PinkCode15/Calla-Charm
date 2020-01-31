@php
@endphp

<div class="modal fade alert-modal" id="openTradeListModal">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content open-trade-modal">
            <div class="modal-header">
            <h5 class="modal-title text-uppercase" id="openTradeModalLabel">Open Trades for {{$product->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body open-trade-modal-body">
                <div class="container " >
                    @foreach($openTrade as $openTrade )
                    <button data-toggle="modal" data-target="#openTradeModal_{{$openTrade->id}}" data-dismiss="modal"><div class="form-control">Open Trade with {{$openTrade->customer->username}}</div></button>
                    <br>
                    @include('modals.openTradeVendor')
                    @endforeach
                </div>
            </div>
            <div class="container">
            </div>
        </div>
    </div>
</div>


