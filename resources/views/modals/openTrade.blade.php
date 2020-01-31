@php
@endphp

<div class="modal fade alert-modal" id="openTradeModal_{{ $openTrade->id }}">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content open-trade-modal">
            <div class="modal-header">
            <h5 class="modal-title text-uppercase" id="openTradeModalLabel">Open Trade with @if($guard == 'customer'){{$product->vendor->company_name}}@else{{$openTrade->customer->username}}@endif for {{$product->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body open-trade-modal-body">
                <div class="container " >
                    @if($messages->isEmpty())
                    @else
                        @foreach($messages as $message)
                            @if($message->sender == $guard)
                                <div class="same-msg-box">
                                    {{$message->body}}
                                    <br>
                                    <div class="badge">{{ $message->created_at->format('Y-m-d') }} {{ $message->created_at->format('H:i A') }}
                                    </div>
                                </div>
                                <br><br><br>
                            @else
                                <div class="diff-msg-box">
                                    {{$message->body}}
                                    <br>
                                    <div class="badge">{{ $message->created_at->format('Y-m-d') }} {{ $message->created_at->format('H:i A') }}
                                    </div>
                                </div>
                                <br><br><br>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="container">
                <form action="{{route('menu.customerproduct.message')}}" method="post" >
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input name="messageBody" type="text" maxlength="150" class="form-control" autofocus autocomplete="words" placeholder="Type here..." required>
                        </div>
                        <div  class="col-sm-2">
                            <span><button class="btn btn-success" type="submit">Send <span class="fa fa-paper-plane mr-3"></button></span>
                        </div>
                    </div>
                    <input type="hidden" name="openTradeId" value="{{ $openTrade->id }}">
                    <input type="hidden" name="receiver" value="@if($guard == 'customer') vendor @else customer @endif ">
                </form>
                {{-- <button class="btn btn-danger" data-dismiss="modal">Cancel</button> --}}
            </div>
        </div>
    </div>
</div>


