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
                                <h3>{{ __('Confirm Password') }}</h3>
                            </div>
                        </div>
                        <div class="main">
                            <p>{{ __('Please confirm your password before continuing.') }}</p>
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf
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
                                <button type="submit"
                                        class="btn_1 full-width mb_5">{{ __('Confirm Password') }}</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
