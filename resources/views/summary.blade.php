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

      <span class="num">Flight ID
        <span> 
          <h1 style="color:white;"> {{$datos->flight_code}}</h1>
        </span>
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
        <div>{{$datos->fecha_ida}}</div>
      </section>
      <section>
        <div class="title">Arrival</div>
        <div>{{$datos->fecha_vuelta}}</div>
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




@endsection

        <div class="payButtonWrapper">



          <a href="/reserve/pay"><button type="sumbit" class="btn btn-success btn-circle btn-xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill:white;" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg> 
          </button></a>
        </div>