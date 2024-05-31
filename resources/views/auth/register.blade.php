@extends('layouts.app-login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6" style="margin-top: 20%;">
            <div class="card">
                <div class="card-header" style="text-align: center; font-size: 20px; font-weight: bold;">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label for="name" class="col-md-3 col-form-label">{{ __('Name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label for="email" class="col-md-3 col-form-label">{{ __('Email Address') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                            <label for="password-confirm" class="col-md-3 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <i class="fa fa-user-plus" aria-hidden="true"></i> {{ __('Register') }}
                                </button>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <a class="btn btn-warning" href="{{ url('/') }}" style="color: black; width: 100%;">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Dashboard
                                </a>
                            </div>
                            <div class="col-md-5">
                                <a class="btn btn-secondary" href="{{ route('login') }}" style="color: black; width: 100%;">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('Login') }}
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
