@extends('layout_files.layout')
@section('title', 'Home')

@section('content')
    <div class="container">

        @include('layout_files.subheader-wallet')

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>rKYC</h1>
                <span>Create your reusable KYC easily and safely for more than 200 countries.</span>
            </div>
            <div class="spinner1 col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vKYC') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>rKYB</h1>
                <span>Create a reusable KYC for a group of people (entitier, projects, etc.).</span>
            </div>
            <div class="spinner2 col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vKYC') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>vNFT</h1>
                <span>Verify your NFT project through your social medial accounts (KYC optional).</span>
            </div>
            <div class="spinner3 col-md-4 col-sm-4 text-end">
                <!-- <a href="{{ route('product.show', 'vNFT') }}" class="btn btn-arrow">-></a> -->
                <a href="https://nftidentity.iamx.id/" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>vPOOL</h1>
                <span>Create a KYC for your stakepool to offer your delegators a compliant service.</span>
            </div>
            <div class="spinner4 col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vPOOL') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>vDELEGATOR</h1>
                <span>Delegate to a stakepool in a compliant way.</span>
            </div>
            <div class="spinner5 col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'vDELEGATOR') }}" class="btn btn-arrow">-></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>Request API access</h1>
                <span></span>
            </div>
            <div class="spinner6 col-md-4 col-sm-4 text-end">
                <a href="{{ route('product.show', 'API') }}" class="btn btn-arrow">-></a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        let spinner = document.querySelector('.spinner-border');
        let mainPage = document.querySelector('.mainPage');
        let footer = document.getElementById('footer');
        let header = document.getElementById('header');

        document.querySelector('.spinner1').onclick = disableButtonShowSpinner;
        document.querySelector('.spinner2').onclick = disableButtonShowSpinner;
        document.querySelector('.spinner3').onclick = disableButtonShowSpinner;
        document.querySelector('.spinner4').onclick = disableButtonShowSpinner;
        document.querySelector('.spinner5').onclick = disableButtonShowSpinner;
        document.querySelector('.spinner6').onclick = disableButtonShowSpinner;

        function disableButtonShowSpinner(e) {

            e.target.classList.add('disabled');
            spinner.classList.remove('hidden');
            mainPage.classList.add('opacity-50');
            footer.classList.add('opacity-50');
            header.classList.add('opacity-50');
            //document.body.classList.add('opacity-50');
        }
    </script>
@endpush
