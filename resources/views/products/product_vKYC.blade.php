@extends('layout_files.layout')
@section('title', 'Product vKYC')

@section('content')
    <div class="container">
        @include('layout_files.subheader-wallet')

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12">
                <h1>vKYC</h1>
                <span>Create your reusable KYC easily and safely for more than 200 countries.</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
@endpush
