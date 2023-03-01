@extends('layout_files.layout')
@section('title', 'Product vPool')

@section('content')
    <div class="container">
        @include('layout_files.subheader-wallet')

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12">
                <h1>vPOOL</h1>
                <span>Create a KYC for your stakepool to offer your delegators a compliant service.</span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12">
                To ensure compliance and minimise risk for all parties, IAMX has developed an ecosystem-level solution to
                staking compliance:<br>
                <b>vPOOL</b> & <b>vDELEGATOR</b>, both of which serve as verification credentials for regulatory
                conformity and compliance, relying on robust Know Your Customer (KYC) processes and the power of
                Non-Fungible Tokens (Tokens).
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12">
                vPOOL exist as Token in the pledge wallet. Stored in the
                metadata of these Token is the minimum set of information necessary to determine (or demonstrate)
                compliance, including:
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12">
                <button class="btn-pill">Link to the DID</button>
                <button class="btn-pill">The timestamp for the KYC/KYB</button>
                <button class="btn-pill">An attribute indicating the regulatory jurisdiction of the POOL (US, EU,
                    etc.)</button>
                <button class="btn-pill">The pool ticker</button>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <span class="hint">
                    <i>
                        * The Token will only be created if the result of the Anti-Money Laundering (AML), Politically
                        Exposed
                        Persons
                        (PEP), and Sanctions checks are positive, there will be no negative information available anywhere.
                    </i>
                </span>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <a href="{{ route('wizard.getStep1', 'vPOOL') }}" class="btn btn-start">Start KYC for vPOOL</a>
            </div>
        </div>

        @include('layout_files.kyc-hint')

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
@endpush
