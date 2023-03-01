@extends('layout_files.layout')
@section('title', 'FAQ')

@section('content')
    <div class="container">
        @include('layout_files.subheader-wallet')

        <hr>

        <div class="row mb-3">
            <div class="col-md-12 col-sm-12">
                <h1>FAQ</h1>
                <span>R</span>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
@endpush
