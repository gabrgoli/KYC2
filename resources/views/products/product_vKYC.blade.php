@extends('layout_files.layout')
@section('title', 'Product vKYC')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                Products view for vKYC
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js')}}"></script>
@endpush
