@extends('layout_files.layout')
@section('title', 'Product vPool')

@section('content')
    <div class="container">
        <div class="row text-center p50">
            <div class="col-md-12 col-sm-12">
                <img src="/images/IAMX_OYI_Blue.png" style="width: 120px; margin-bottom:50px;" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h1></h1>
            </div>
            <div class="col-md-6 col-sm-6 text-end">
                <a class="btn btn-wallet">Connect Wallet</a>
            </div>
        </div>

        <hr>

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
                <b>vPOOL</b> & <b>vDELEGATE</b>, both of which serve as verification credentials for regulatory
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

        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <ul>
                    <li>link to the DID</li>
                    <li>the timestamp for the KYC/KYB</li>
                    <li>an attribute indicating the regulatory jurisdiction of the POOL (US, EU, etc.)</li>
                    <li>the pool ticker</li>
                </ul>
                <span class="hint">
                    <i>
                * The Token will only be created if the result of the Anti-Money Laundering (AML), Politically Exposed
                Persons
                (PEP), and Sanctions checks are positive, there will be no negative information available anywhere.
                </i>
                </span>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <a href="{{ route('wizard.show', 'vPool') }}" class="btn btn-start">Start KYC for vPOOL</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 col-sm-12">
                <span>Have your ID document available.</span><br>
                <img src="/images/1.png" style="width: 120px; margin-bottom:50px; margin-top:15px;" />
            </div>
            <div class="col-md-4 col-sm-12">
                <span>Make sure you are in a well-lit place.</span><br>
                <img src="/images/2.png" style="width: 120px; margin-bottom:50px; margin-top:15px;" />
            </div>
            <div class="col-md-4 col-sm-12">
                <span>Be ready for a Selfie.</span><br>
                <img src="/images/3.png" style="width: 120px; margin-bottom:50px; margin-top:15px;" />
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
@endpush
