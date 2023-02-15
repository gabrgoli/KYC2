 @extends('layout_files.layout')
@section('title', 'Home')

@section('content')
    <div class="container">

        <div class="row text-center p50">
            <div class="col-md-12 col-sm-12">
                <img src="/images/IAMX_OYI_Blue.png" style="width: 120px; margin-bottom:50px;" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h1>My IAMX</h1>
            </div>
            <div class="col-md-6 col-sm-6 text-end">
                <a class="btn btn-wallet">Connect Wallet</a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>rKYC</h1>
                <span>Create your reusable KYC easily and safely for more than 200 countries.</span>
            </div>
            <div class="col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vKYC') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>rKYB</h1>
                <span>Create a reusable KYC for a group of people (entitier,projects,etc.).</span>
            </div>
            <div class="col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vKYC') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>vNFT</h1>
                <span>Verify your NFT project through your social medial accounts (KYC optional).</span>
            </div>
            <div class="col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vNFT') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>vPOOL</h1>
                <span>Create a KYC for your stakepool to offer your delegators a compliant service.</span>
            </div>
            <div class="col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vPool') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>vDELEGATE</h1>
                <span>Delegate to a stakepool in a compliant way.</span>
            </div>
            <div class="col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vDelegate') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>Request API access</h1>
                <span></span>
            </div>
            <div class="col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'API') }}" class="btn btn-arrow">-></a>
            </div>
        </div>






    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
@endpush
