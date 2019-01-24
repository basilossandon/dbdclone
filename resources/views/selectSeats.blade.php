@extends('layouts.app')
@section('title', 'Select your seat')
@section('header')
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- searchbox inside dropdown --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script>$('.select2').select2();</script>
@endsection
@section('content')
    <div class="seatSelectionWrapper mx-auto">
        <div class="selectForm">
    <form action="/reserve/storeChosenSeats", method="POST">
        {{-- Para cada vuelo --}}
        @for ($i = 0; $i < $vuelos_solicitados->count(); $i++)
            <p> FLIGHT {{$vuelos_solicitados->get($i)}} </p>
            {{-- En este input se guardara los asientos seleccionados por cada pasajero en el vuelo $i.
                Tendra la forma idPasajero:numAsiento:numSeguro_idPasajero:numAsiento:numSeguro... --}}
            <input name="{{$vuelos_solicitados->get($i)}}" id="{{$vuelos_solicitados->get($i)}}" type="hidden" value="">
            {{-- Para cada pasajero --}}
            @for ($j = 0; $j < $nombres->count() ; $j++)
            <fieldset>

                <legend> Passenger: {{$nombres->get($j)}} </legend>
                <label id="{{$vuelos_solicitados->get($i)}}_{{$ids_pasajeros->get($j)}}_label"  for="{{$vuelos_solicitados->get($i)}}_{{$ids_pasajeros->get($j)}}">Seat type: </label>
                <select id="{{$vuelos_solicitados->get($i)}}_{{$ids_pasajeros->get($j)}}" onchange="updateSelection(this)" value="{{$availableSeats->get($i)->first()}}">
                    @foreach ($availableSeats->get($i) as $seat)
                        <option value="{{$seat}}">{{$seat}}</option>
                    @endforeach
                </select>

                <label for="{{$vuelos_solicitados->get($i)}}_{{$ids_pasajeros->get($j)}}_seguro">Insurance</label>
                <select disabled="disabled" id="{{$vuelos_solicitados->get($i)}}_{{$ids_pasajeros->get($j)}}_seguro" value="-1" onchange="updateInsurance(this)">
                    <option value="-1">No insurance</option>
                    @foreach ($seguros as $seguro)
                        <option value="{{$seguro->id}}">{{$seguro->insurance_type}}</option>
                    @endforeach
                </select>


            </fieldset>
            @endfor
        @endfor


        <div class="buttonWrapper">
            <button class="btn btn-primary" type="submit" value="enviar" style="
            margin-top: 25px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;">
            Continue
            </button>
        </div>
        <script>
            function updateInsurance(element){
                id = element.id;
                var seguro = element.value
                var datos = id.split('_');
                var id_vuelo = datos[0];
                var id_pasajero = datos[1];
                var asiento_seleccionado = $("#" + id_vuelo + "_" + id_pasajero).val();
                // Si el pasajero ha seleccionado un vuelo
                if (document.getElementById(id_vuelo).value.includes(id_pasajero)){
                    var substrings = document.getElementById(id_vuelo).value.split('_');
                    var nuevoValor = "";
                    for (string in substrings){
                        if (substrings[string].includes(id_pasajero)){
                            var aux = id_pasajero + ":" + asiento_seleccionado + ":" + seguro;
                            nuevoValor += aux;
                        } else {
                            nuevoValor +=  substrings[string];
                        }
                        if (string != substrings.length - 1){
                            nuevoValor += "_";
                        }
                    }
                    document.getElementById(id_vuelo).value = nuevoValor
                    console.log(document.getElementById(id_vuelo).value);
                }

            }
            function updateSelection(element){
                var asiento_seleccionado = document.getElementById(element.id).value;
                var id = document.getElementById(element.id).id;
                var datos = id.split('_');
                var id_vuelo = datos[0];
                var id_pasajero = datos[1];

                // Activar el seguro
                $("#" + id_vuelo + "_" + id_pasajero + "_seguro").prop('disabled', false);

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
               
                $.ajax({
                    url: '/asociatedSeatType',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, flight_id:id_vuelo, seat_number:asiento_seleccionado},
                    dataType: 'JSON',
                    success: function (data) { 
                        $("#" + id + "_label").html("TIPO: " + data.seat_type);
                    }
                });
            
                var seguro = $("#" + id_vuelo + "_" + id_pasajero + "_seguro").val();
                // Si el id_pasajero no habia sido seleccionado asiento para este vuelo, concaternarlo
                if (!(document.getElementById(id_vuelo).value.includes(id_pasajero))){
                    var valor_antiguo = document.getElementById(id_vuelo).value;
                    var nuevo_valor;
                    // Si es el primero que se va a agregar
                    if (valor_antiguo == ""){
                        nuevo_valor = id_pasajero + ":" + asiento_seleccionado + ":" + seguro;
                    } else {
                        nuevo_valor = "_" + id_pasajero + ":" + asiento_seleccionado + ":" + seguro;
                    }
                    document.getElementById(id_vuelo).value = valor_antiguo + nuevo_valor;
                // Sino, reemplazar el anterior seleccionado
                } else {
                    var substrings = document.getElementById(id_vuelo).value.split('_');
                    var nuevoValor = "";
                    for (string in substrings){
                        if (substrings[string].includes(id_pasajero)){
                            var aux = id_pasajero + ":" + asiento_seleccionado + ":" + seguro;
                            nuevoValor += aux;
                        } else {
                            nuevoValor +=  substrings[string];
                        }
                        if (string != substrings.length - 1){
                            nuevoValor += "_";
                        }
                    }
                    document.getElementById(id_vuelo).value = nuevoValor
                }
                console.log(document.getElementById(id_vuelo).value);
            }
        </script>
    </form>
    </div>
</div>

@endsection
