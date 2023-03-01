@extends('layout_files.layout')
@section('title', "Product $dbProduct->name Step 1")

@section('content')
    <div class="container">
        @include('layout_files.subheader-wallet')
        @include('layout_files.subheader-wizard')

        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <h1 class="blue-h1 ">Product price: {{ $dbProduct?->price_in_ada }} ADA</h1>
                <h1 class="blue-h1 ">Product discount: {{ $dbProduct?->price_in_ada * (1 - $dbProduct?->discount / 100)  }} ADA</h1>
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-md-12 col-sm-12">
                <p>We are asking you for some product specific information before we can start the external KYC verification
                    process.<br>
                These attributes will be publicly readable, minted into the token metadata and act like a passport for compliant staking.</p>
            </div>
        </div>

        <form method="post" action="{{ route('wizard.getStep2', $dbProduct->name) }}">
            @csrf
            @for($i = 0; $i < count($dbProduct->custom_properties['properties']); $i++)
                <div class="row mb-5">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="fw-bold">{{ $dbProduct->custom_properties['properties'][$i]['name'] }}</label>
                            <input type="text" class="form-control @if ($errors->has('custom_properties.'.$dbProduct->custom_properties['properties'][$i]['id'])) is-invalid @endif" name="custom_properties[{{ $dbProduct->custom_properties['properties'][$i]['id'] }}]"
                                   id="custom_properties[{{ $dbProduct->custom_properties['properties'][$i]['id'] }}]">
                                   @if ($errors->has('custom_properties.'.$dbProduct->custom_properties['properties'][$i]['id']))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('custom_properties.'.$dbProduct->custom_properties['properties'][$i]['id']) }}
                                        </div>
                                    @endif
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
