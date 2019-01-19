@extends('layouts.app')
@section('title', 'Selecciona el asiento')
@section('content')
    <div class="reservationFormWrapper">
        <div class="reserveForm">
    <form action="/reserve/storeChosenSeats", method="POST">
        {{-- Para cada vuelo --}}
        @for ($i = 0; $i < $vuelos_solicitados->count(); $i++)
            <p> VUELO {{$vuelos_solicitados->get($i)}} </p>
            {{-- En este input se guardara los asientos seleccionados por cada pasajero en el vuelo $i.
                Tendra la forma idPasajero:numAsiento_idPasajero:numAsiento... --}}
            <input name="{{$vuelos_solicitados->get($i)}}" id="{{$vuelos_solicitados->get($i)}}" type="hidden" value="">
            {{-- Para cada pasajero --}}
            @for ($j = 0; $j < $nombres->count() ; $j++)
                <p> Pasajero: {{$nombres->get($j)}} </p>
                <select id="{{$vuelos_solicitados->get($i)}}_{{$ids_pasajeros->get($j)}}" onchange="updateSelection(this)">
                    @foreach ($availableSeats->get($i) as $seat)
                        <option value="{{$seat}}">{{$seat}}</option>
                    @endforeach
                </select>
            @endfor
        @endfor



        <input type="submit" value="enviar">
        <script>
            function updateSelection(element){
                var asiento_seleccionado = document.getElementById(element.id).value;
                var id = document.getElementById(element.id).id;
                var datos = id.split('_');
                var id_vuelo = datos[0];
                var id_pasajero = datos[1];
                // Si el id_pasajero no habia sido seleccionado asiento para este vuelo, concaternarlo
                if (!(document.getElementById(id_vuelo).value.includes(id_pasajero))){
                    var valor_antiguo = document.getElementById(id_vuelo).value;
                    var nuevo_valor;
                    // Si es el primero que se va a agregar
                    if (valor_antiguo == ""){
                        nuevo_valor = id_pasajero + ":" + asiento_seleccionado;
                    } else {
                        nuevo_valor = "_" + id_pasajero + ":" + asiento_seleccionado;
                    }
                    document.getElementById(id_vuelo).value = valor_antiguo + nuevo_valor;
                // Sino, reemplazar el anterior seleccionado
                } else {
                    var substrings = document.getElementById(id_vuelo).value.split('_');
                    var nuevoValor = "";
                    for (string in substrings){
                        if (substrings[string].includes(id_pasajero)){
                            var aux = id_pasajero + ":" + asiento_seleccionado;
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
