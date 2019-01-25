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
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tickets
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Flight ID</th>
                                            <th>Passenger ID</th>
                                            <th>Seat ID</th>
                                            <th>Seat Number</th>
                                            <th>Check-in</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vuelosPorReserva as $reservations)
                                        @foreach ($reservations as $tickets)
                                        <tr>
                                            <td>{{$tickets->id}}</td>
                                            <td>{{$tickets->flight_id}}</td>
                                            <td>{{$tickets->passenger_id}}</td>
                                            <td>{{$tickets->seat_id}}</td>
                                            <td>{{$tickets->seat_number}}</td>
                                            <td><div class="custom-control custom-switch">
                                                  <input type="checkbox" class="custom-control-input" id="customSwitch{{$tickets->id}}" checked="false">
                                                  <label class="custom-control-label" for="customSwitch{{$tickets->id}}">Check-in</label>
                                                </div> </td>

                                        </tr>
                                        @endforeach
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