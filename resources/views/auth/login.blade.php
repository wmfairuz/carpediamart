@extends('layouts.foogra')

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
                                <h3>{{ __('Login') }}</h3>
                            </div>
                        </div>
                        <!-- /head -->
                        <div class="main">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" type="email" placeholder="Email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <i class="icon_mail"></i>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" placeholder="Password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password">
                                    <i class="icon_lock"></i>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group add_bottom_15">
                                    <div class="checkboxes float-left add_bottom_15 add_top_15">
                                        <label class="container_check">Remember Me
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                            <button type="submit" class="btn_1 full-width mb_5">Log In</button>
                            </form>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <div class="divider"><span>Or</span></div>
                            <a href="{{ route('register') }}" class="btn_1 full-width mb_5">Sign up Now</a>
                        </div>
                    </div>
                    <!-- /box_booking -->
                </div>
            </div>
        </div>
    </div>
@endsection
