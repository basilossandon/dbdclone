@extends('layouts.app')
@section('title', 'Ingresa la informacion del pasajero')
@section('content')


    <div class="reservationFormWrapper">
        <div class="reserveForm">

        <form action="/reserve/storePassengersInfo" method="POST">
            @for ($i = 0; $i < $passengers; $i++)
                <input name="data{{$i}}" id="data{{$i}}" type="hidden" value="">
                <label>Pasajero {{$i + 1}}</label>
                <div class="form-group" >
                    <input type="text" class="form-control" onchange="updateData({{$i}})" id="nameInput{{$i}}" placeholder="Nombre completo">
                    <input type="text" class="form-control" onchange="updateData({{$i}})" id="RUTInput{{$i}}" placeholder="RUT">
                    <input type="text" class="form-control" onchange="updateData({{$i}})" id="docType{{$i}}" placeholder="Tipo de documento">
                    <input type="text" class="form-control" onchange="updateData({{$i}})" id="docCountry{{$i}}" placeHolder="Pais de origen del documento">
                </div>
            @endfor
            <script>
                    function updateData(i){
                        document.getElementById("data"+i).value= 
                            document.getElementById("nameInput"+i).value + 
                            "_" +
                            document.getElementById("RUTInput"+i).value +
                            "_" +
                            document.getElementById("docCountry"+i).value + 
                            "_" +
                            document.getElementById("docType"+i).value + 
                            "_" + "-1";
                    }
            </script>
            <div class="buttonWrapper">
            <input class="btn btn-primary" type="submit" value="Enviar"></div>
        </form>
    </div>
</div>

@endsection

