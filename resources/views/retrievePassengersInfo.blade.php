@extends('layouts.app')
<title>Pasajeros</title>
    <form action="/reserve/storePassengersInfo" method="POST">
        @for ($i = 0; $i < $passengers; $i++)
            <input name="data{{$i}}" id="data{{$i}}" type="hidden" value="">
            <label>Pasajero{{$i}}</label>
            <div class="form-group">
                <input type="text" class="form-control" onchange="updateData({{$i}})" id="nameInput{{$i}}" placeholder="Nombre">
                <input type="text" class="form-control" onchange="updateData({{$i}})" id="RUTInput{{$i}}" placeholder="Rut">
            </div>
        @endfor
        <script>
                function updateData(i){
                    document.getElementById("data"+i).value= 
                        document.getElementById("nameInput"+i).value + 
                        "_" +
                        document.getElementById("RUTInput"+i).value;
                }
            </script>
        <input type="submit" value="Enviar">
 </form>

