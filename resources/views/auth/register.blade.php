@extends('layouts.app')

@section('content')


<div class="container pleca col-md-4 mb-5 rounded padding-pleca">
    <div class="row justify-content-center">
        <img src="{{asset('/storage/logo.svg')}}" weight="150" height="150"alt="">
    </div>
    <div class="container">
     <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="my-4">
            <input id="name" type="text" class="rounded-login @error('name') is-invalid @enderror"
            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
            @error('name')
            <span class="invalid-feedback d-block mt-1" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="my-4">
            <input id="email" type="email" class="rounded-login @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">

            @error('email')
            <span class="invalid-feedback d-block mt-1" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="my-4">

            <input id="password" type="password"
            class="rounded-login @error('password') is-invalid @enderror" name="password"
            required autocomplete="new-password" placeholder="password">

            @error('password')
            <span class="invalid-feedback d-block mt-1" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="pb-5">
            <input id="password-confirm" type="password" class="rounded-login"
            name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">   
        </div>

        <div class="d-flex justify-content-center pb-5">
            <button type="submit" class="btn btn-danger">
                {{ __('Register') }}
            </button>            
        </div>

        </form>
    </div>
</div>
@endsection
