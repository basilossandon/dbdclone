@extends('layouts.app')
@section('title', 'Summary')

@section('header')
{{-- searchbox inside dropdown --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
{{-- DatePicker --}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="/js/buttons.js"></script>

@endsection

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<section id="tabs" class="project-tab">
    <div class="container">
                <div class="row">
                    <div class="col-md-12" style="
                    background: white;margin-top: 100px; border-radius: 15px;">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Flights
                                 <button type="button" style="margin-left: 30px; border-radius: 30px;" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-success btn-sm">                                        
                                    <img src="/images/add.png">
                                    </button>
                                </a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Hotels
                                 <button type="button" style="margin-left: 30px; border-radius: 30px;" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-success btn-sm">                                        
                                            <img src="/images/add.png">
                                    </button>
                                </a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Vehicles
                                 <button type="button" style="margin-left: 30px; border-radius: 30px;" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-success btn-sm">                                        
                                        <img src="/images/add.png">
                                    </button>
                                </a>
                                <a class="nav-item nav-link" id="nav-package-tab" data-toggle="tab" href="#nav-package" role="tab" aria-controls="nav-package" aria-selected="false">Packages
                                    
                                 <button type="button" style="margin-left: 30px; border-radius: 30px;" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-success btn-sm">                                        
                                        <img src="/images/add.png">
                                </button>
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Flight Code</th>
                                            <th>Departure city</th>
                                            <th>Arrival City</th>
                                            <th>Departure time</th>
                                            <th>Arrival time</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($flights as $flight)
                                        <tr>
                                            <td>{{$flight->id}}</td>
                                            <td>{{$flight->flight_code}}</td>
                                            <td>{{$flight->flight_departure}}</td>
                                            <td>{{$flight->flight_arrival}}</td>
                                            <td>{{$flight->departure_airport_id}}</td>
                                            <td>{{$flight->arrival_airport_id}}</td>
                                            <td><button type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm">
                                            <img src="/images/edit.png">
                                            </button></td>
                                            <td><button type="button" data-toggle="modal" data-target="#delete" data-uid="1" class="delete btn btn-danger btn-sm">
                                            <img src="/images/rubbish-bin.png">
                                            </button></td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Hotel Name</th>
                                            <th>Address</th>
                                            <th>Stars</th>
                                            <th>City ID</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hotels as $hotel)
                                        <tr>
                                            <td>{{$hotel->id}}</td>
                                            <td>{{$hotel->hotel_name}}</td>
                                            <td>{{$hotel->hotel_address}}</td>
                                            <td>{{$hotel->hotel_stars}}</td>
                                            <td>{{$hotel->city_id}}</td>
                                            <td><button type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm">
                                            <img src="/images/edit.png">
                                            </button></td>
                                            <td><button type="button" data-toggle="modal" data-target="#delete" data-uid="1" class="delete btn btn-danger btn-sm">
                                            <img src="/images/rubbish-bin.png">
                                            </button></td>                                      </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>License Plate</th>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle Price</th>
                                            <th>City ID</th>
                                            <th>Edit</th>
                                            <th>Delete</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td>{{$vehicle->id}}</td>
                                            <td>{{$vehicle->vehicle_licence_plate}}</td>
                                            <td>{{$vehicle->vehicle_type}}</td>
                                            <td>{{$vehicle->vehicle_price}}</td>
                                            <td>{{$vehicle->city_id}}</td>
                                            <td><button type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm">
                                            <img src="/images/edit.png">
                                            </button></td>
                                            <td><button type="button" data-toggle="modal" data-target="#delete" data-uid="1" class="delete btn btn-danger btn-sm">
                                            <img src="/images/rubbish-bin.png">
                                            </button></td>                                      </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="nav-package" role="tabpanel" aria-labelledby="nav-package-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Package Name</th>
                                            <th>Type</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Vehicle in package</th>
                                            <th>Edit</th>
                                            <th>Delete</th>     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($packages as $package)
                                        <tr>
                                            <td>{{$package->id}}</td>
                                            <td>{{$package->package_name}}</td>
                                            <td>{{$package->package_type}}</td>
                                            <td>{{$package->package_price}}</td>
                                            <td>{{$package->package_stock}}</td>
                                            <td>{{$package->vehicle_id}}</td>
                                            <td><button type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm">
                                            <img src="/images/edit.png">
                                            </button></td>
                                            <td><button type="button" data-toggle="modal" data-target="#delete" data-uid="1" class="delete btn btn-danger btn-sm">
                                            <img src="/images/rubbish-bin.png">
                                            </button></td>                                     
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection