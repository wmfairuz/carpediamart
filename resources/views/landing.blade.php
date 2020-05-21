@extends('layouts.foogra')

@section('fb')
    @include('layouts.fb')
@endsection

@push('styles')
    <style>
        .main-menu > ul > li > a, ul#top_menu li a.login  {
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="hero_single version_2">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.2)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-10 col-md-8 hero-text">
                        <h1>Carpedia Mart</h1>
                        <p>Shop Bulk Groceries From Your Favourite Stores Online</p>
                        <p class="sub-title">We'll Deliver To Your Doorstep The Next Morning, Fresh and New!</p>
                        <a href="{{ route('orders.create') }}" class="btn_1 btn_lg">Shop Now</a>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
    </div>
    <!-- /hero_single -->

    <div class="container margin_60_40">
        <div class="flex-container what-box">
            <div class="what-words">
                <h2>What is <span>Carpedia Mart</span></h2>
                <p>A personal grocery shopper service to help you stock up your grocery needs from your preferred store
                    of choice. Place your order online and leave the rest to Carpedia Mart!</p>
                <a href="{{ route('orders.create') }}" class="btn_1">Shop Now</a>
            </div>
            <div class="what-image">
                <img class="img-responsive" src="{{ mix('img/whatis.png') }}" alt="whatistlg">
            </div>
        </div>
    </div>
    <!-- /container -->

    <div class="bg_gray">
        <div class="container margin_60_40">
            <div class="main_title center">
                <span><em></em></span>
                <h2>How it works</h2>
                <p>Your goods will be delivered right to your doorstep the next morning, just by following these 4
                    simple steps;​</p>
            </div>
            <div class="owl-carousel owl-theme categories_carousel">
                <div class="item">
                    <a>
                        <img class="" src="{{ mix('img/step1.png') }}">
                        <h3>Click SHOP NOW</h3>
                        <small></small>
                    </a>
                </div>
                <div class="item">
                    <a>
                        <img class="" src="{{ mix('img/step2.png') }}">
                        <h3>Key in your delivery details and confirm your order</h3>
                        {{--                        <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ipsum velit, consectetur sed lobortis at</small>--}}
                    </a>
                </div>
                <div class="item">
                    <a>
                        <img class="" src="{{ mix('img/step3.png') }}">
                        <h3>Make cashless payment </h3>
                        {{--                        <small>You will be reimbursed if real cost spent is less than the estimated cost</small>--}}
                    </a>
                </div>
                <div class="item">
                    <a>
                        <img class="" src="{{ mix('img/step4.png') }}">
                        <h3>Wait for delivery the next morning </h3>
                        {{--                        <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ipsum velit, consectetur sed lobortis at.</small>--}}
                    </a>
                </div>
                <div class="item">
                    <a href="{{ route('orders.create') }}">
                        <img class="" src="{{ mix('img/whatis.png') }}">
                        <h3>Easy? Click here to Shop Now</h3>
                        <small></small>
                    </a>
                </div>
            </div>
            <!-- /carousel -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->

    <div class="call_section lazy" data-bg="url(img/hero.jpg)">
        <div class="container clearfix">

            <div class="col-lg-5 col-md-6 float-right wow">
                <div class="box_1">
                    <h3>Thank you for trusting Carpedia Mart</h3>
                    <p>It is our pride to deliver fresh goods to your doorstep at the comfort of a few clicks
                        online.</p>
                </div>
            </div>
        </div>
    </div>
    <!--/call_section-->

@endsection
