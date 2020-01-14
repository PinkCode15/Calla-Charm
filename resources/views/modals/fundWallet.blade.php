<div class="modal fade wallet-modal alert-modal" id="fundWalletModal_{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="fundWalletModalLabel">FUND WALLET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body fundWalletBody">
                <form action="{{ route('wallet.fund') }}" method="post">
                    @csrf
                    <input type="hidden" name="userId" value="{{ $user->id }}">
                    <label>Amount: </label><input id="amount" type="number" class="form-control field" name="amount" required autofocus placeholder=" Enter Amount">
                    <div class="modal-footer text-center mt-20">
                        <button type="submit" class="btn btn-success">Fund</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


