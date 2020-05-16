@extends('layouts.foogra')

@push('styles')
    <link href="{{ asset('css/booking-sign_up.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="bg_gray pattern margin_60_40">
        <div class="container margin_60_40">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="sign_up">
                        <div class="head">
                            <div class="title">
                                <h3>{{ __('Reset Password') }}</h3>
                            </div>
                        </div>
                        <div class="main">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
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

                                <button type="submit"
                                        class="btn_1 full-width mb_5">{{ __('Send Password Reset Link') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
