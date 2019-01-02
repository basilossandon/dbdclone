@extends('layouts.app')
@section('title', 'Escoge tus vuelos')

@section('content')

    @foreach ($routesFound as $routes)
        <table class="table" style="margin-bottom: 50px;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Origen</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Fecha salida</th>
                    <th scope="col">Fecha llegada</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($routes as $flight)
              <tr>
                    <th scope="row">#</th>
                    <td>{{$flight->origen}}</td>
                    <td>{{$flight->destino}}</td>
                    <td>{{$flight->fecha_salida}}</td>
                    <td>{{$flight->fecha_llegada}}</td>

              </tr>
              @endforeach
            </tbody>
         </table>
         {{-- <br>
            <hr class="style12">
         <br> --}}
    @endforeach

@endsection
