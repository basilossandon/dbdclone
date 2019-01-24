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
@foreach ($datos_por_vuelo as $datos)

<div class="ticket">
  <div class="stub">
    <div class="top">
      <span class="admit">{{$datos->pasajero}}</span>
      <span class="line"></span>
      <span class="num">
        Reservation ID
        <span> <h1 style="color:white">IED234</h1></span>
      </span>
    </div>
    <div class="number">${{$datos->precio_vuelo}}</div>
    <div class="invite" style="color:white">
    <h4>{{$datos->tipo_asiento}}</h4>
    </div>
  </div>
  <div class="check">
    <div class="big">
      {{$datos->ciudad_origen}}  <br> {{$datos->ciudad_destino}}
    </div>
    <div class="number"><img style="width:25px; /* you can use % */
    height: auto;"src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt=""></div>
    <div class="info" style="bottom: 0px!important;">
      <section>
        <div class="title">Departure</div>
        <div>4/27/2016 14:00</div>
      </section>
      <section>
        <div class="title">Arrival</div>
        <div>4/27/2016</div>
      </section>
      <section>
        <div class="title">Seat number</div>
        <div >  {{$datos->num_asiento}} </div>
      </section>
      <section>
        <div class="title">Insurance</div>
        <div> {{$datos->tipo_seguro}} </div></div>
      </section>
    </div>
  </div>
</div>
    @endforeach
        <div class="payButtonWrapper">
          <button type="button" class="btn btn-success btn-circle btn-xl"><i class=" https://material.io/tools/icons/static/icons/baseline-shopping_cart-24px.svg
"></i></button>
        </div>



@endsection
