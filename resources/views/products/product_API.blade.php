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
                <h1>API</h1>
                <span>Request API access</span>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
@endpush
