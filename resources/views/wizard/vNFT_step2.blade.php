@extends('layout_files.layout')
@section('title', 'Product vNFT Step 2')

@section('content')
    <div class="container">
        @include('layout_files.subheader-nowallet')
        
        <div class="row">
            <div class="col-md-12">
                Products vNFT Step 2
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                Please transfer {{$customer->price_in_ada}}.{!! Str::padLeft($customer->dust, 5, '0')!!} ADA to the wallet {{$iamx_wallet_address}}<br>
                UUID: {{$customer->UUID}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p id="counter"></p>
                <p id="paymentCheck"></p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('/js/jquery-3.6.3.min.js')}}"></script>
    <script>
        function sendRequest(){
            var finishInterval = false;
            $.ajax({
                url: '{{url('/checkIncomingPayment')}}',
                method: 'POST',
                async: true,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {UUID: $("#userUUID").val()},
                success:
                    function(response){
                        if (response.status==='Payment has arrived!') {
                            finishInterval = true;
                            $('#paymentCheck').text(response.status + 'tx-hash: ' + response.payment);
                        } else {
                            $('#paymentCheck').text(response.status);
                        }
                        return finishInterval;
                    }
            });
        };

        $(document).ready(function(){
            var counter = 60;
            var result;
            var interval = setInterval(function() {
                counter--;
                if (counter <= 0) {
                    result = sendRequest();
                    if (result) {
                        clearInterval(interval);
                    } else {
                        counter = 60;
                    }
                }else{
                    $('#counter').text(counter + ' seconds until refresh.');
                }
            }, 1000);

        });
    </script>
@endpush
