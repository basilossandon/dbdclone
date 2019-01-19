@extends('layouts.app')
@section('title', 'Escoge tus vuelos')

@section('content')



<div class="table-wrapper-scroll-y">
    @foreach ($routesFound as $routes)
        <form action="/reserve/storeChosenFlights" method="POST">
            <table class="table table-hover" style="color: white;">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Origen</th>
                        <th >Destino</th>
                        <th >Fecha salida</th>
                        <th >Fecha llegada</th>
                    </tr>
                </thead>
                        <tbody>
                            @foreach ($routes as $flight)
                            <input type="hidden" name="id{{$flight->id}}" value="{{$flight->id}}">
                            <tr>
                                <th >#</th>
                                <td>{{$flight->origen}}</td>
                                <td>{{$flight->destino}}</td>
                                <td>{{$flight->fecha_salida}}</td>
                                <td>{{$flight->fecha_llegada}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <input class="btn btn-primary" type="submit" value="Seleccionar">
            </table>
        </form>
    @endforeach
</div>
@endsection
