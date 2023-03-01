@extends('layout_files.layout')
@section('title', 'Product vDelegate Step 2')

@section('content')
    <div class="container">
        @include('layout_files.subheader-wallet') 
        @include('layout_files.subheader-wizard')
        
        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <h1 class="blue-h1 ">Product price: {{ $dbProduct->price_in_ada }} ADA</h1>
                <div>Cardano Transaction Payload  {{ env('CARDANO_PAYLOAD')}} ADA (You will receive this 2 ADA back together with your {{$dbProduct?->name}} Token)</div>
                <div>Cardano Wallet DustMatching  0.{!! Str::padLeft($customer->dust, 5, '0') !!} ADA (service fee to verify your Wallet Address)</div>
                <div>Transaction Total {{ $customer->price_in_ada }}.{!! Str::padLeft($customer->dust, 5, '0') !!} ADA</div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                Please transfer {{ $customer->price_in_ada }}.{!! Str::padLeft($customer->dust, 5, '0') !!} ADA to the wallet
                {{ $iamx_wallet_address }}<br>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <button class="btn-pill-blue" onclick="navigator.clipboard.writeText('{{ $customer->UUID }}');">{{ $customer->UUID }}</button>
                <div class="counter" id="counter"></div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                <a href="#" class="btn btn-start disabled">Continue</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.countdown360.min.js') }}"></script>
    <script>
        function sendRequest() {
            var finishInterval = false;
            $.ajax({
                url: '{{ url('/checkIncomingPayment') }}',
                method: 'POST',
                async: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    UUID: $("#userUUID").val()
                },
                success: function(response) {
                    if (response.status === 'Payment has arrived!') {
                        finishInterval = true;
                        var current = location.href;
                        window.location.href = current + "/" . $("#userUUID").val();
                        $('#paymentCheck').text(response.status + 'tx-hash: ' + response.payment);
                    } else {
                        $('#paymentCheck').text(response.status);
                    }
                    return finishInterval;
                }
            });
        };

        $(document).ready(function() {
            var result;
            var countdown = $("#counter").countdown360({
                radius: 24,
                seconds: 60,
                smooth: true,
                label: false,
                strokeWidth: 1,
                fillStyle: '#ffffff',
                strokeStyle: '#888888',
                fontSize: 20,
                fontColor: '#888888',
                clockwise: true,
                autostart: false,
                onComplete: function() {
                    result = sendRequest();
                    if (result) {
                        console.log('done');
                    } else {
                        countdown.start();
                    }
                }
            });
            countdown.start();
        });
    </script>
@endpush