<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Collection;
use App\Http\Controllers\FlightController;
use App\City;
use App\Flight;
use Carbon\Carbon;

class ReserveController extends Controller{

    public function searchFlights()
    {
        $cities = City::all();
        return view('reserve', compact('cities'));
    }

    public function chooseFlights(Request $request){
        $origen = $request->input('origen');
        $destino = $request->input('destino');
        $fecha_ida = Carbon::parse($request->input('fecha_ida'));
        $fecha_vuelta = Carbon::parse($request->input('fecha_vuelta'));
        $flightController = new FlightController;
        $flightController->flightsFound = Collection::make();
        // Filtrar los vuelos que tengan el origen y fecha deseada para buscar
        // escalas posibles a partir de ellos
        Flight::all()->each(function ($flight) use($origen, $destino, $flightController, $fecha_ida, $fecha_vuelta){
            $departure_date = Carbon::parse($flight->flight_departure);
            if ($flightController->originCity($flight->id) == $origen &&
                $departure_date->equalTo($fecha_ida)){

                $flightController->findFlights(collect([$flight]), $destino);
            }
        });
        $foundFlights = $flightController->flightsFound;
        $routesFound = Collection::make();
        $foundFlights->each(function ($routes) use ($routesFound){
            $route = Collection::make();
            foreach($routes as $flight){
                $origen = FlightController::originCity($flight->id);
                $destino = FlightController::destinyCity($flight->id);
                $fecha_salida = $flight->flight_departure;
                $fecha_llegada = $flight->flight_arrival;

                $route->push(new class($origen, $destino, $fecha_salida, $fecha_llegada){
                    public $origen;
                    public $destino;
                    public $fecha_salida;
                    public $fecha_llegada;
                    public function __construct($origen, $destino, $fecha_salida, $fecha_llegada){
                        $this->origen = $origen;
                        $this->destino = $destino;
                        $this->fecha_salida = $fecha_salida;
                        $this->fecha_llegada = $fecha_llegada;
                    }
                });
            }
            $routesFound->push($route);
        });
        return view('chooseFlights', compact('routesFound'));
    }
}
