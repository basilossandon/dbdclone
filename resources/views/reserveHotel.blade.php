@extends('layouts.app')
@section('title', 'Pick your hotels')
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
  <form action="/reserve/rooms/chooseRoom" method="POST" >
    <div class="rows">
    <div class="reserve-options">
      <div class="columns" style="margin-top: 5px">
        <div class="column is-2">
          <label>City</label>

         <select name="city" class="form-control select2">
           @foreach ($cities as $city)
             <option>{{$city->city_name}}</option>
           @endforeach

         </select>
        </div>
        <div class="column is-1">
          <label>Stars</label>
          <select name="stars" class="form-control select2">
                 <option>1</option>
                 <option>2</option>
                 <option>3</option>
                 <option>4</option>
                 <option>5</option>
          </select>
        </div>
        <div class="column is-1">
          <label>Room type</label>
          <select name="room_type" class="form-control select2">
                 @foreach ($roomTypes as $roomType)
                 <option>{{$roomType}}</option>
                @endforeach
          </select>
        </div>

        <div class="column is-2">
            <label>Check-in</label>
            <input name="check_in" id="datelease" class="form-control" data-date-container='#myModalId'/>
              <script>
                $('#datelease').datepicker({
                  uiLibrary: 'bootstrap4'});
              </script>

        </div>
        <div class="column is-2">
          <label>Check-out</label>
            <input name="check_out" id="datereturn" class="form-control" data-date-container='#myModalId'/>
            <script>
            $('#datereturn').datepicker({
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
