@extends('layouts.foogra')

@section('fb')
    @include('layouts.fb')
@endsection

@push('styles')
    <link href="{{ mix('css/booking-sign_up.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="bg_gray pattern margin_60_40">
    <div class="container margin_60_40">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="sign_up">
                    <div class="head">
                        <div class="title">
                            <h3>Sign Up</h3>
                        </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <a href="#0" class="social_bt facebook">Sign up with Facebook</a>
                        <a href="#0" class="social_bt google">Sign up with Google</a>
                        <div class="divider"><span>Or</span></div>
                        <h6>Personal details</h6>
                        <div class="form-group">
                            <input class="form-control" placeholder="First and Last Name">
                            <i class="icon_pencil"></i>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Email Address">
                            <i class="icon_mail"></i>
                        </div>
                        <div class="form-group add_bottom_15">
                            <input class="form-control" placeholder="Password" id="password_sign" name="password_sign">
                            <i class="icon_lock"></i>
                        </div>
                        <a href="confirm.html" class="btn_1 full-width mb_5">Sign up Now</a>
                    </div>
                </div>
                <!-- /box_booking -->
            </div>
            <!-- /col -->

        </div>
        <!-- /row -->
    </div>
</div>
@endsection