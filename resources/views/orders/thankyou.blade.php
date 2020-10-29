@extends('layouts.foogra')

@push('styles')
    <link href="{{ asset('css/detail-page-delivery.css') }}" rel="stylesheet">
@endpush

@section('fb')
    {{--    @include('layouts.salesiq')--}}
@endsection

@push('scripts')

@endpush

@section('content')
    <div class="bg_gray pattern margin_60_40">
        <div class="container margin_60_40">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="box_booking">Ø
                        <div class="head order_top">
                            <h3>Thank you</h3>
                            <p>Amount {{ $amount }}</p>
                            <p>Transaction ID {{ $transactionId }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        dataLayer.push({
            'event':'purchase',
            'order_id':'{{ $transactionId }}',
            'order_total':'{{ $amount }}'
        });
    </script>
@endsection
