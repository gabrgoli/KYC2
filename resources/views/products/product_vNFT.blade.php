@extends('layout_files.layout')
@section('title', 'Product vNFT')

@section('content')
    <div class="container">
        @include('layout_files.subheader-wallet')

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12">
                <h1>vNFT</h1>
                <span>Verify your NFT project through your social medial accounts (KYC optional).</span>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
@endpush
