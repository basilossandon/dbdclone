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

        <div class="rows" style="padding-right: 20px;">
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked="">
          <label class="custom-control-label" for="customRadio1">One way</label>
        </div>

        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
          <label class="custom-control-label" for="customRadio2">Round trip</label>
        </div>
        </div>
        </div>

      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="qty mt-5">Quantity: 
            <span class="minus bg-dark " id="decrease" value="Decrease Value">-</span>
            <input name="quantity" type="number" class="count"  id="qty" value="1" min="1" max="4">
            <span class="plus bg-dark" onclick="incrementValue()" id="increase" value="Increment Value">+</span>
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
