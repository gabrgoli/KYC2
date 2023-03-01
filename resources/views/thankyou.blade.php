@extends('layout_files.layout')
@section('title', 'Thank you')

@section('content')
    <div class="container">
        @include('layout_files.subheader-logo')
        @include('layout_files.subheader-wizard')

        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <h1 class="blue-h1">Thank you</h1>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                @if (isset($data))
                    <ul class="thank-you-list">
                        @if ($data->token_data)
                            @isset($data->token_data)
                                <li>Your data is processed!</li>
                                <li>UUID: {{ $data->UUID }}</li>
                                <li>Token: {{ $data->token_data }}</li>
                            @endisset
                        @else
                            <li>We are waiting to process your data!</li>
                        @endif
                    </ul>
                @else
                    <h2>Customer does not exist!</h2>
                @endif
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        setInterval(function() {
            location.reload();
        }, 30000);
    </script>
@endpush
