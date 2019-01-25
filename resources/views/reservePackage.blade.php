@extends('layouts.app')

@section('title', 'Pick your package')

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
  <form action="/reserve/packages" method="POST" >
    <div class="rows">
    <div class="reserve-options">


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
