@extends('layouts.foogra')

@push('styles')
    <link href="{{ asset('css/detail-page-delivery.css') }}" rel="stylesheet">
@endpush

@section('fb')
    @include('layouts.salesiq')
@endsection

@push('scripts')

@endpush

@section('content')
    <div class="call_section lazy" data-bg="url(img/hero.jpg)">
        <div class="container clearfix">

            <div class="col-lg-5 col-md-6 float-right wow">
                <div class="box_1">
                    <h3>Carpedia Mart seda membantu semasa PKPB.</h3>
                    <p>Nantikan kami bermula 15 Oktober 2020</p>
                </div>
            </div>
        </div>
    </div>
@endsection