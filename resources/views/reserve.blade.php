@extends('layouts.app')
@section('title', 'Reserva tu vuelo')
@section('header')
    {{-- searchbox inside dropdown --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    {{-- DatePicker --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    {{-- searchbox inside dropdown --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>$('.select2').select2();</script>

@endsection
@section('content')
<form action="/reserve/select_flight" method="GET">
    <div class="row">
      <div class="col">
          <label>ORIGEN</label>
             <select name="origen" class="form-control select2">
               @foreach ($cities as $city)
                   <option>{{$city->city_name}}</option>
               @endforeach
             </select>
      </div>
      <div class="col">
          <label>DESTINO</label>
             <select name="destino" class="form-control select2">
                 @foreach ($cities as $city)
                     <option>{{$city->city_name}}</option>
                 @endforeach
             </select>
      </div>
    </div>
  <div class="row">
    <div class="col">
        <label>FECHA DE IDA</label>
        <input name="fecha_ida" id="datepickerida" class="form-control"/>
          <script>
            $('#datepickerida').datepicker({
            uiLibrary: 'bootstrap4'
            });
        </script>
    </div>
    <div class="col">
        <label>FECHA DE VUELTA</label>
        <input name="fecha_vuelta" id="datepickervuelta" class="form-control"/>
          <script>
            $('#datepickervuelta').datepicker({
            uiLibrary: 'bootstrap4'
            });
          </script>
    </div>
  </div>
  <div class="row">
      <div class="col">
          <button
            type="submit"
            style="margin-top: 200px";
            class="btn btn-outline-primary">
            Buscar
        </button>
      </div>
  </div>
</form>
@endsection
