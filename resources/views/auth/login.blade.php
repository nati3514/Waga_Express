@extends('layouts.app')

@section('content')
<style>
    .ending {
        margin-left: 100px;
        color: red;
    }
</style>
    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-8 border ">
                <div class="card-body">
                    <div class=" text-center mb-2">
                        <img src="{{ asset('frontend/assets/img/rm_logo.png') }}" class="img-fluid "
                            style="max-width: 100px; margin:auto;" alt="Phone image">
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 d-flex justify-content-center">

                            <div class="col-md-6">
                                <div>
                                    <label for="email" class="form-label ">{{ __('Email Address') }}</label>
                                </div>
                                <input id="email" type="email"
                                    class="form-control border border-dark  @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex justify-content-center">
                            <div class="col-md-6">
                                <div>
                                    <label for="password" class="form-label ">{{ __('Password') }}</label>
                                </div>
                                <input id="password" type="password"
                                    class="form-control border border-dark @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                        <div class="row mb-0">
                            <div class="text-center ending">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="mb-3 mt-2 text-center ">
                                <button type="submit" class="btn btn-primary col-md-6">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="text-center">
                                <p>Dont have an account? <span><a href="{{ route('register') }}">Signup here</a></span></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
