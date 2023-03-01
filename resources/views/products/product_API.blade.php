@extends('layout_files.layout')
@section('title', 'Product vPool')

@section('content')
    <div class="container">
        @include('layout_files.subheader-wallet')

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
