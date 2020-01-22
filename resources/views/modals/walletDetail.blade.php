@php
    $transaction = $log->transaction()->first();
    if($transaction->closedTrade()->first() !== null){
        $closedTrade =  $transaction->closedTrade()->first();
        $customer = $closedTrade->customer()->first();
        $product = $closedTrade->product()->first();
        $vendor = $product->vendor()->first();
    }
@endphp

<div class="modal fade wallet-modal alert-modal" id="walletDetailModal_{{ $log->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="walletDetailModalLabel">INVOICE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body walletDetailBody">
            @if($transaction->description == "Calla Charm: Wallet Deposit From Customer" ||
            $transaction->description == 'Calla Charm: Wallet Withdraw In-App')
                <div class="row">
                    <div class="col-md-5">
                        <div class="modal-logo">
                            Calla Charm
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div><label>Invoice ID | </label>#{{$transaction->reference}} </div>
                        <div><label>Issue Date | </label>{{ $log->created_at->format('Y-m-d') }}</div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>Product Name </label></div>
                    </div>
                    <div  class="col-md-6">{{ucwords($product->name)}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>Category </label></div>
                    </div>
                    <div  class="col-md-6">{{ucwords($product->type)}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>@if($guard == 'customer') Vendor Name @else Customer Name @endif </label></div>
                    </div>
                    <div  class="col-md-6">@if($guard == 'customer'){{ucwords($vendor->company_name)}}
                        @else {{ucwords($customer->last_name)}} {{ucwords($customer->first_name)}} @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>Quantity </label></div>
                    </div>
                    <div  class="col-md-6">{{ucwords($closedTrade->quantity)}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>Price </label></div>
                    </div>
                    <div  class="col-md-6">₦ {{ number_format($closedTrade->price)}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>Amount </label></div>
                    </div>
                    <div  class="col-md-6">₦ {{ number_format($transaction->amount)}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>Charge </label></div>
                    </div>
                    <div  class="col-md-6">{{ number_format($transaction->charge)}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>Total Amount </label></div>
                    </div>
                    <div  class="col-md-6">₦ {{ number_format($transaction->total_amount)}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div><label>Other Details </label></div>
                    </div>
                    <div  class="col-md-6">{{ucwords($closedTrade->other_details)}}</div>
                </div>
            @endIf
            @if($transaction->description == 'Calla Charm: Wallet Deposit From You' or
            $transaction->description == 'Calla Charm: Wallet Withdraw Out-Of-App')
            <div class="row">
                <div class="col-md-5">
                    <div class="modal-logo">
                        Calla Charm
                    </div>
                </div>
                <div class="col-md-7">
                    <div><label>Invoice ID | </label>#{{$transaction->reference}} </div>
                    <div><label>Issue Date | </label>{{ $log->created_at->format('Y-m-d') }}</div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <div><label>@if($transaction->description == 'Calla Charm: Wallet Deposit From You')
                        Wallet Credit @else Wallet Debit @endif
                    </label></div>
                </div>
                <div  class="col-md-6">
                    ₦ {{ number_format($transaction->total_amount)}}
                </div>
            </div>
            @endif

            </div>
            <div class="modal-footer text-center mt-20">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


