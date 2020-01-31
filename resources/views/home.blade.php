
@extends('layouts.app')

@section('otherStyles')
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/datatable/css/responsive.dataTables.min.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css"/>


@stop

<style>
    .account-number {
        font-size: 28px;
        margin: 0;
        font-weight: bolder;
    }
    .no-account-number{
        font-size: 20px;
        font-weight: lighter;
        padding: 12.82px;
    }
    .account-name {
        letter-spacing: 4px;
        margin: 0;
        font-size: 18px;
        font-weight: lighter;
        color: #888;
        margin-top:10px;
        color:#6cb2eb;
    }

    .bank-name {
        margin: 0;
        display: inline-block;
        background: #fff;
        padding: 2px 10px;
        border-radius: 4px;
        color: #5c8c8c;
        position: absolute;
        top: -10px;
        right: -2px;
        box-shadow: 0 1px 6px 0 rgba(0,0,0,0.15);
        font-weight: 100;
        text-transform: uppercase;
        font-size: 15px;
        letter-spacing: 3px;
        color:#6cb2eb;
    }
    .placeholder1 {
        border: 1px dashed #888a85;
        padding: 41px;
    }
    .placeholder {
        border: 1px dashed #888a85;
        padding: 25px;
    }
    .action{
        margin-top:10px;
    }
    label{
        font-weight:bold;
        font-size:14px;
        margin:5px;
    }
    .modal-logo{
        font-family: 'Great Vibes', cursive;
        font-size:30px;
    }
    .walletDetailBody{
        font-size:14px;
        margin-left:10px;
    }
    .alert-p{
        color:red;
        font-size:12px;
    }

    /* .logs-panel .dataTable {
        border-spacing: 0 1rem;
        border-collapse: separate;
    } */

    /* .logs-panel .dataTable tbody > tr > td {
        background: #f1f1f1;
        margin-bottom: 10px;
        border: none;
    }

    .logs-panel .dataTable tbody > tr > td:first-child {
        border-radius: 5px 0 0 5px
    }

    .logs-panel .dataTable tbody > tr > td:last-child {
        border-radius: 0 5px 5px 0
    }

    .logs-panel .dataTable tbody > tr.delayed > td:first-child {
        border-left: 4px solid #F44336;
    } */
    .table-border{
        border:2px solid grey !important;
        padding: 25px;
        border-radius: 1%;
    }
    @media screen and (max-width: 500px){
        .panel-body{
            display: none;
        }
    }
    .alert .close i{
    margin-top:20px !important;
}
</style>
@section('content')
@include('partials._alert')
<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-4">
        <div class="placeholder1 text-center">
            <h1 class="account-number">₦ {{ number_format($user->wallet->current_amount) }}</h1>
        </div>
    </div>
    <div class="col-md-4">
        <div class="placeholder text-center">
            @if($user->account_number)
                <h1 class="account-number m-0">{{ $user->account_number}}</h1>
                <h2 class="account-name text-uppercase" style="letter-spacing: 2px">{{ $user->account_name }}</h2>
                <h3 class="bank-name">{{ $user->bank }}</h3>
            @else
                <h1 class="no-account-number m-0">No account details added</h1>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group action">
            @if($guard == 'customer')
            <button class="btn btn-block btn-lg btn-secondary"  data-toggle="modal" data-target="#fundWalletModal_{{ $user->id }}">FUND</button>
            @endif
            @if($user->account_number)
            <button class="btn btn-block btn-lg btn-secondary" data-toggle="modal" data-target="#withdrawWalletModal_{{ $user->id }}"> WITHDRAW</button>
            @else
            <button class="btn btn-block btn-lg btn-secondary" id="" data-toggle="fund" disabled>WITHDRAW</button>
            @endif
            @include('modals.fundWallet')
            @include('modals.withdrawWallet')
        </div>
    </div>
</div>
<br><br><br><br><br>
<div class="panel panel-default pt-20 mt-20">
    <div class="panel-heading">
        <h3 class="panel-title">Wallet Logs</h3>
        <hr>
    </div>
    <br>
    <div class="panel-body panel-default logs-panel pt-10 table-border">
        <div class="table-responsive">
            <table class="table payments-table">
                <thead>
                <tr>
                    <th>Transaction Type</th>
                    <th>Total Amount</th>
                    <th>Balance Before Transaction</th>
                    <th>Balance After Transaction</th>
                    <!-- <th class="mobile">Reference</th>
                    <th>Status</th>
                    <th class="mobile">Transaction ID</th> -->
                    <th>Date</th>
                    <th>View Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td class = "text-uppercase">{{ $log->transaction_type }}</td>
                        <td class="td-amount">₦ {{ number_format(abs($log->previous_balance - $log->current_balance)) }}</td>
                        <td class="td-amount">₦ {{ number_format($log->previous_balance) }}</td>
                        <td class="td-amount">₦ {{ number_format($log->current_balance) }}</td>
                        <td>
                            {{ $log->created_at->format('Y-m-d') }}
                            <span class="badge ">
                                    {{ $log->created_at->format('H:i A') }}
                            </span>
                            <!-- ({{ $log->created_at->diffForHumans() }}) -->
                        </td>
                        <td>
                            <button class="btn btn-block btn-info" data-toggle="modal" data-target="#walletDetailModal_{{ $log->id }}">More</button>
                        </td>
                    </tr>
                    @include('modals.walletDetail')
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('script')

<!-- <script type="text/javascript" src="{{ asset('assets/vendor/datatable/js/datatables.min.js') }}"></script> -->


<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>


<script src="{{ asset('assets/vendor/blockui.js') }}"></script>


@stop

@section('javascript')
<script>
$('table.payments-table').DataTable({
        responsive: true,
        dom: 'lfrBtip',
        buttons: ['copy', 'pdf', 'csv', 'excel','print'],
        order: [[4, "des" ]],

    });
</script>
@stop


