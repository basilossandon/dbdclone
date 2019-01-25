@extends('layouts.app')
@section('title', 'Select your Vehicle')

@section('content')

<div class="welcomeCards">
	<div class="columns">

    @foreach ($available_vehicles as $vehicle)
    <div class="cardWrapperWelcome">

			<div class="card text-white bg-dark mb-3" style="max-width: 20rem;">


			  	<div class="card-header">
					<a href="/reserve/store_vehicle_reservation/{{$vehicle->id}}/" style="color: white">
					<img src="/images/car-icon.svg">
					<a href="/reserve/store_vehicle_reservation/{{$vehicle->id}}/" style="color: white">
					{{$vehicle->vehicle_type}}
					<img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
					</a>	
				</div>

				
				<div class="card-body" style="
					border-bottom-left-radius: 20px;
					border-bottom-right-radius: 20px;
					border-top-left-radius: 20px;
					border-top-right-radius: 20px;">
					<h4 class="card-title">Price: ${{$vehicle->vehicle_price}}</h4>
					<p class="card-text">License plate: {{$vehicle->vehicle_licence_plate}}</p>
					<p class="card-text">Car type: {{$vehicle->vehicle_type}}</p>
					<div class ="button-card-container">
					<a class="btn btn-primary" style="
					border-bottom-left-radius: 20px;
					border-bottom-right-radius: 20px;
					border-top-left-radius: 20px;
					border-top-right-radius: 20px;"  href="/reserve/store_vehicle_reservation/{{$vehicle->id}}/" role="button">
					Choose Vehicle</a>
					</div>
				</div>
			</div>
		</div>

        @endforeach
		</div>
		</div>

@endsection
