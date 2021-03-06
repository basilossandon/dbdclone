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
<div class="welcomeCards">
	<div class="columns">
		<div class="cardWrapperWelcome">
			<div class="card text-white bg-dark mb-3 h-100" style="max-width: 20rem;">
			  	<div class="card-header">
					<a href="/reserve" style="color: white">
					<img src="/images/plane-icon.png">
					<a href="/reserve" style="color: white">
						Book a flight
					<img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
					</a>



				</div>
				<div class="card-body">
					<h4 class="card-title">Where do you want to go?</h4>
					<p class="card-text">Check our extensive list of flight to anywhere on the world.</p>
					<p class="card-text">Book your flight with us here.</p>
					<div class ="button-card-container">
					<a class="btn btn-lg btn-primary"  href="/reserve" role="button">View flights</a>
					</div>
				</div>
			</div>
		</div>


		<div class="cardWrapperWelcome">
			<div class="card text-white bg-dark mb-3 h-100" style="max-width: 20rem;">
			  	<div class="card-header">
					<a href="/packages" style="color: white">
					<img src="/images/vacations-icon.svg">
					<a href="/reserve/packages" style="color: white">
						Vacation packages
					<img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
					</a>
				</div>
				<div class="card-body">
					<h4 class="card-title">Check out our vacation deals</h4>
					<p class="card-text">Up for some deals? Check our package section.</p>
					<p class="card-text">Check the awesome vacation packages we offer here.</p>
					<div class ="button-card-container">
					<a class="btn btn-lg btn-primary" href="/reserve/packages" role="button">View packages</a>
					</div>
				</div>
			</div>
		</div>

		<div class="cardWrapperWelcome">
		<div class="card text-white bg-dark mb-3 h-100" style="max-width: 20rem;">
			<div class="card-header">
				<a  href="/reserve/rooms" style="color: white">
				<img src="/images/hotel-icon.svg">
					Shop Hotels
				<img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
				</a>
				</div>
				<div class="card-body">
				<h4 class="card-title">Book a room</h4>
				<p class="card-text">Look for the best hotel room in your destination!</p>
				<p class="card-text">Book a hotel room with us so you can relax without a worry.</p>
				<div class ="button-card-container">
				<a class="btn btn-lg btn-primary" href="/reserve/rooms" role="button">Book room</a>
				</div>
			</div>
		</div>
		</div>
		<div class="cardWrapperWelcome">
			<div class="card text-white bg-dark mb-3 h-100" style="max-width: 20rem;">
			  	<div class="card-header">
				    <a href="/reserve/vehicles" style="color: white">
					<img src="/images/car-icon.svg">
				    Rent a car
					<img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
				    </a>
			  	</div>
			 	<div class="card-body">
			    	<h4 class="card-title">Pick any vehicle</h4>
				    <p class="card-text">We offer the best vehicles you will need anywhere on the planet.</p>
				    <p class="card-text">Pick a vehicle in the country you are going so that you don't have to walk on your vacation.</p>
				    <div class ="button-card-container">
				    <a class="btn btn-lg btn-primary" href="/reserve/vehicles" role="button">Rent car</a>
				    </div>
			  	</div>
			</div>
		</div>
		</div>
	</div>
</div>
@endsection
