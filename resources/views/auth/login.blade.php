@extends('layouts.app')

@section('content')


<div class="container pleca col-md-4 mb-5 rounded-new padding-pleca">
    <div class="row justify-content-center">
        <img src="{{asset('/storage/logo.svg')}}" weight="150" height="150" alt="">
    </div>
    <div class="container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="my-4">
                <input id="email" type="email" class="rounded-login @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">

                @error('email')
                <span class="invalid-feedback d-block mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mt-4">
                <input id="password" type="password" class="rounded-login @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="Password">

                @error('password')
                <span class="invalid-feedback d-block mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                @if (Route::has('password.request'))
                <a class="btn-log pt-2" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>

            <div class="d-flex justify-content-center pt-5 pb-4">
                <button type="submit" class="btn btn-danger">
                    {{ __('Login') }}
                </button>
            </div>

            <div class="d-flex justify-content-center">
                <h2 class="line-div description"><span class="text-pleca">Or</span></h2>
            </div>

            <div class="d-flex justify-content-center pt-4">
                <p class="text-secondary nav-text">Sign Up Using</p>
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ url('/auth/google') }}" class="" role="button">
                    <img src="https://img.icons8.com/fluency/48/000000/google-logo.png" />
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
