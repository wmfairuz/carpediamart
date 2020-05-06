@extends('layouts.foogra')

@section('content')
    <div class="hero_single version_2">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.2)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1>Carpedia Mart</h1>
                        <p>Shop and deliver to your doorstep with a few clicks</p>
                        <a href="#" class="btn_1 btn_lg">Shop Now</a>
                        {{--                        <form method="post" action="grid-listing-filterscol.html">--}}
                        {{--                            <div class="row no-gutters custom-search-input">--}}
                        {{--                                <div class="col-lg-4">--}}
                        {{--                                    <div class="form-group">--}}
                        {{--                                        <select class="form-control">--}}
                        {{--                                            <option>ABC</option>--}}
                        {{--                                        </select>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col-lg-6">--}}
                        {{--                                    <div class="form-group">--}}
                        {{--                                        <input class="form-control no_border_r" type="text" id="autocomplete"--}}
                        {{--                                               placeholder="Address, neighborhood...">--}}
                        {{--                                        <i class="icon_pin_alt"></i>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col-lg-2">--}}
                        {{--                                    <input type="submit" value="Search">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- /row -->--}}
                        {{--                        </form>--}}
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
    </div>
    <!-- /hero_single -->

    <div class="container margin_60_40">
        {{--        <div class="main_title">--}}
        {{--            <span><em></em></span>--}}
        {{--            <h2>Popular Restaurants</h2>--}}
        {{--            <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>--}}
        {{--            <a href="#0">View All</a>--}}
        {{--        </div>--}}
        <div class="flex-container what-box">
            <div class="what-words">
                <h2>What is <span>Carpedia Mart</span></h2>
                <p>A new delivery service aimed at fulfilling your needs for fresh groceries and other home essentials.
                    Place your order online and we’ll take it from there!​</p>
                <a href="grid-listing-filterscol.html" class="btn_1">Shop Now</a>
            </div>
            <div class="what-image">
                <img class="img-responsive" src="{{ asset('img/step1.png') }}" alt="whatistlg">
            </div>
        </div>
    </div>
    <!-- /container -->

    <div class="bg_gray">
        <div class="container margin_60_40">
            <div class="main_title center">
                <span><em></em></span>
                <h2>How it works</h2>
                <p>Grocery delivery with Carpedia Mart is made simple so you can get what you need quick and safe, just
                    follow these simple steps:​</p>
            </div>
            <div class="owl-carousel owl-theme categories_carousel">
                <div class="item">
                    <a href="">
                        <img class="" src="{{ asset('img/step1-1.png') }}">
                        <h3>Click on Shop Now</h3>
                        <small></small>
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img class="" src="{{ asset('img/step2-1.png') }}">
                        <h3>Key in your delivery details​ and confirm your order</h3>
                        <small></small>
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img class="" src="{{ asset('img/step3-1.png') }}">
                        <h3>Pay for the estimated cost plus driver's fee</h3>
                        <small></small>
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img class="" src="{{ asset('img/step4-1.png') }}">
                        <h3>Done! Wait for delivery the next day</h3>
                        <small></small>
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img class="" src="{{ asset('img/step1.png') }}">
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

    <div class="call_section lazy" data-bg="url(img/hero4_cropped.jpg)">
        <div class="container clearfix">
            <div class="col-lg-5 col-md-6 float-right wow">
                <div class="box_1">
                    <h3>Thank you for choosing Carpedia Mart as your grocery delivery service.</h3>
                    <p>We know your time is valuable, which is why we make every effort to ensure that your groceries
                        are delivered right to your doorstep to make your life a little less hectic. We take great pride
                        in providing quality customer service in the delivery of groceries and fine spirits.</p>
                </div>
            </div>
        </div>
    </div>
    <!--/call_section-->

@endsection
