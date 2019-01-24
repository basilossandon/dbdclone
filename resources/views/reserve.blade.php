@extends('layouts.app')
@section('title', 'Pick your flight')

@section('header')
{{-- searchbox inside dropdown --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
{{-- DatePicker --}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="/js/buttons.js"></script>
@endsection

@section('scripts')
    {{-- searchbox inside dropdown --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>$('.select2').select2();</script>
@endsection

@section('content')

<div class="reservationFormWrapper">
<div class="reserveForm">
  <form action="/reserve/choose_flights" method="POST" >
    <div class="rows">
    <div class="reserve-options">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <button type="button" class="btn btn-primary">One way/Round trip</button>
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 45px, 0px);">
            <a class="dropdown-item" href="#">Round trip</a>
            <a class="dropdown-item" href="#">One way</a>
          </div>
        </div>
      </div>
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
      <div class="qty mt-5">Quantity: 
            <span class="minus bg-dark">-</span>

            <input type="number" name="quantity" class="count"  value="1">

            <span class="plus bg-dark">+</span>
        </div>
      </div>
      </div>
      <div class="columns" style="margin-top: 5px">
        <div class="column is-2">
          <label>From</label>
         <select name="origen" class="form-control select2">
           @foreach ($cities as $city)
             <option>{{$city->city_name}}</option>
           @endforeach
         </select>
        </div>
        <div class="column is-2">
          <label>To</label>
          <select name="destino" class="form-control select2">
             @foreach ($cities as $city)
                 <option>{{$city->city_name}}</option>
             @endforeach
          </select>
        </div>
        <div class="column is-2">
            <label>Depart</label>
            <input name="fecha_ida" id="datepickerida" class="form-control" data-date-container='#myModalId'/>
              <script>
                $('#datepickerida').datepicker({
                  uiLibrary: 'bootstrap4'});
              </script>

        </div>
        <div class="column is-2">
          <label>Return</label>
            <input name="fecha_vuelta" id="datepickervuelta" class="form-control" data-date-container='#myModalId'/>
            <script>
            $('#datepickervuelta').datepicker({
            uiLibrary: 'bootstrap4'
            });
            </script>
          </div>
    </div>
    <div class="buttonWrapper">
            <button class="btn btn-primary" type="submit" style="
            margin-top: 25px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;">
            Search
            </button>
        </div>
          </form>
  </div>
</div>


@endsection
