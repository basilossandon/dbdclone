@extends('layouts.app')
@section('title', 'Select your room')

@section('content')

<div class="welcomeCards">
	<div class="columns">
	
    @foreach ($availableRooms as $room)
    <div class="cardWrapperWelcome">

			<div class="card text-white bg-dark mb-3" style="max-width: 20rem;">
			  	<div class="card-header">
					<a href="/reserve" style="color: white">
					<img src="/images/car-icon.png">
					<a href="/reserve" style="color: white">
					<img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
          <h1>
            {{$room->room_type}}

					</a>
				</div>
				<div class="card-body">
					<h4 class="card-title">Precio: ${{$room->room_price}}</h4>
					<p class="card-text"></p>
					<div class ="button-card-container">
					<a class="btn btn-lg btn-primary"  href="/reserve/store_room_reservation/{{$room->id}}/" role="button">Select room</a>
					</div>
				</div>
			</div>
		</div>

        @endforeach
		</div>
		</div>

@endsection
