@extends('layouts.app-login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6" style="margin-top: 20%;">
            <div class="card">
                <div class="card-header" style="text-align: center; font-size: 20px; font-weight: bold;">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @if(isset($message))
                            <div class="row content-center">
                            <div class="col-sm-10 col-md-10 col-lg-10 pl-0">
                                <div class="alert alert-danger" role="alert">
                                {!! $message !!}
                                </div>
                            </div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label for="email" class="col-md-3 col-form-label">{{ __('Email Address') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label for="password" class="col-md-3 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="float: right;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <a class="btn btn-warning" href="{{ url('/') }}" style="color: black; width: 100%;">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Dashboard
                                </a>
                            </div>
                            <div class="col-md-5">
                                <a class="btn btn-secondary" href="{{ route('register') }}" style="color: black; width: 100%;">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i> {{ __('Register') }}
                                </a>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
