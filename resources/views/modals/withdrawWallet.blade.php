<div class="modal fade wallet-modal alert-modal" id="withdrawWalletModal_{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="fundWalletModalLabel">FUND WALLET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body fundWalletBody">
                <p class = "alert-p">This request attracts a fee of ₦55</p>
                <form action="{{ route('wallet.withdraw') }}" method="post">
                    @csrf
                    <input type="hidden" name="userId" value="{{ $user->id }}">
                    <input type="hidden" name="type" value="{{ $guard }}">
                    <label>Amount: </label><input id="amount" type="number" class="form-control field" name="amount" required autofocus placeholder=" Enter Amount">
                    <div class="modal-footer text-center mt-20">
                        <button type="submit" class="btn btn-success">Withdraw</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


