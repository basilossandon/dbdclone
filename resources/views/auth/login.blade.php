@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/login.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<div class="container">
    <div class="login-form-container">
        <div id="loginform">
        <div id="facebook"><i onclick="window.location.href='/login/facebook'" class="fa fa-facebook"></i><div id="connect">Connect with Facebook</div></div>
        <div id="mainlogin">
        <div id="or">or</div>
        <h1>Log in or use facebook!</h1>
        <form method="POST" action="{{ route('login') }}">
        <input id="email" placeholder="Email" type="email" class="customForm form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
            <input id="password" type="password" placeholder="Password" class="customForm form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            <div class="rememberWrapper" style="padding-left: 25px;">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
            </div>
        <button class="customButton" type="submit"><i class="fa fa-arrow-right">{{ __('')}}</i></button>
        </form>
        @if (Route::has('password.request'))
        <div id="note"><a href="{{ route('password.request') }}">Forgot your password?</a></div>
        @endif


        </div>
        </div>
    </div>
</div>
@endsection



