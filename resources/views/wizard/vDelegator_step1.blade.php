@extends('layout_files.layout')
@section('title', 'Product vDelegate Step 1')

@section('content')
    <div class="container">
        @include('layout_files.subheader-nowallet')

        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <p>Product name: {{ $dbProduct->name }}</p>
                <p>Product price: {{ $dbProduct->price_in_ada }} </p>
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-md-12 col-sm-12">
                <p>We are asking you for some product specific information before we can start the external KYC verification
                    process.<br>
                This Attributes will publicly readable minted into the token metadata and act like a passport for compliant staking.</p>
            </div>
        </div>

        <form method="post" action="{{ route('wizard.getStep2', $dbProduct->name) }}">
            @csrf
            @for($i = 0; $i < count($dbProduct->custom_properties['properties']); $i++)
                <div class="row mb-5">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label style="font-weight: bold;">{{ $dbProduct->custom_properties['properties'][$i]['name'] }}</label>
                            <input type="text" class="form-control" name="custom_properties[{{ $dbProduct->custom_properties['properties'][$i]['id'] }}]"
                                   id="custom_properties[{{ $dbProduct->custom_properties['properties'][$i]['id'] }}]">
                        </div>
                    </div>
                </div>
            @endfor
            <div class="row mb-5">
                <div class="col-md-12 col-sm-12">
                    <input type="submit" name="send" value="Continue" class="btn btn-start">
                </div>
            </div>
        </form>

        @include('wizard.terms-widget')
    @endsection

    @push('scripts')
        <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    @endpush
