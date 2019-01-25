    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/reserve.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>$('.select2').select2();</script>

@extends('layouts.app')
@section('title', 'Welcome')

@section('content')

<div class="reserveForm2">
	<div class="row text-center  mx-auto">
        <div class="mx-auto">
	        <br><br> <h2 style="color:white">You've paid succesfully!</h2>
	        
	        <img style="margin: 20px;" src="/images/checked.png">
	        <br>
	        <h3 style="color:white;" >Dear, {{$user->name}}</h3>
	        <p style="font-size:20px;color:white;">Thank you for your purchase.</p>
	        <a href="/" class="btn btn-success">     Continue      </a>
			<br><br>
    	</div>
	</div>
</div>
@endsection
