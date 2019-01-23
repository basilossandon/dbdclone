@extends('layouts.app')
@section('title', 'Ingresa la informacion del pasajero')
@section('content')


    <div class="reservationFormWrapper">
        <div class="reserveForm">

        <form action="/reserve/storePassengersInfo" method="POST">
            @for ($i = 0; $i < $passengers; $i++)
                <input name="data{{$i}}" id="data{{$i}}" type="hidden" value="">
                <label>Passenger N#{{$i + 1}}</label>
                <div class="form-group" >
                    <input type="text" class="form-control" onchange="updateData({{$i}})" id="nameInput{{$i}}" placeholder="Full name">
                    <input type="text" class="form-control" onchange="updateData({{$i}})" id="RUTInput{{$i}}" placeholder="RUT">
                    <input type="text" class="form-control" onchange="updateData({{$i}})" id="docType{{$i}}" placeholder="Type of document">
                    <input type="text" class="form-control" onchange="updateData({{$i}})" id="docCountry{{$i}}" placeHolder="Country origin of document">
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
            <input class="btn btn-primary" type="submit" value="Continue"></div>
        </form>
    </div>
</div>

@endsection

