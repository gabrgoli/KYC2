@extends('layout_files.layout')
@section('title', 'Product vDelegate Step 2')

@section('content')
    <div class="container">
        @include('layout_files.subheader-logo') 
        @include('layout_files.subheader-wizard')

        <div class="row mb-5">
            <div class="col-md-12 col-sm-12">
                &nbsp;
            </div>
            <div>

                <div class="row mb-5">
                    <div class="col-md-12 col-sm-12">
                        <iframe src="{{ $dbProduct->outlink }}{{ $customer->UUID }}" title="KYC-Validation"
                            style="width: 100%; height: 2800px;" ></iframe>
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
                                window.location.href = current + "/start/".$("#userUUID").val();
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
