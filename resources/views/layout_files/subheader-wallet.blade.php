<div class="row text-center p50">
    <div class="col-md-4 col-sm-4 text-start">
        <a id="identityBtn" class="btn btn-identity">
            <span id="identityaddr">Connect Identity &or;</span>
            <div id="identity-options" class="idropdown">
            </div>
        </a>
    </div>
    <div class="col-md-4 col-sm-4">
        <img src="/images/IAMX_OYI_Blue.png" class="logo" />
    </div>
    <div class="col-md-4 col-sm-4 text-end">
        <a id="walletBtn" class="btn btn-wallet">
            <span id="walletaddr">Connect Wallet &or;</span>
            <div id="wallet-options" class="wdropdown">
            </div>
        </a>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('/js/cardano-connect.js') }}"></script>
    <script src="{{ asset('/js/cbor.js') }}"></script>
    <script src="{{ asset('/js/iamx-bech32.js') }}"></script>
    <script src="{{ asset('/js/iamx-cardano.js') }}"></script>
    <script src="{{ asset('/js/iamx-identity.js') }}"></script>
    <script>
        $(document).ready(function() {
            IAMX.bech32.init();
            IAMX.Wallet.init();
            IAMX.Identity.init();
            @if(Session::has('bech32'))
            IAMX.Wallet.resume('{{Session::get('wallet')}}','{{Session::get('bech32')}}');
            @endif
        });
    </script>
@endpush
