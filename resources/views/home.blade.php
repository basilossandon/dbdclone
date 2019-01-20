@extends('layouts.app')
@section('content')
<div class="container">
    <div class="login-form-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" >
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body" >
                        <p>Nombre:</p>
                            <p><strong>{{ Auth::user()->name }}</strong></p>
                            <hr>
                            <p>Email:</p>
                            <p><strong>{{ Auth::user()->email }}</strong></p>

                        <div class="col-md-4">
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="img-responsive img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection