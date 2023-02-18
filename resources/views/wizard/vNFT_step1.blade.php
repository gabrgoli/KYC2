@extends('layout_files.layout')
@section('title', 'Product vNFT Step 1')

@section('content')
    <div class="container">
        @include('layout_files.subheader-nowallet')

        <div class="row">
            <div class="col-md-12">
                <p>Product name: {{$dbProduct->name}}</p>
                <p>Product price:  {{$dbProduct->price_in_ada}} </p>
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
                    <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js')}}"></script>
@endpush
