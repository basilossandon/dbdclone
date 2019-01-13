<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Collection;
use App\Http\Controllers\FlightController;
use App\City;
use App\Flight;
use App\Seat;
use Carbon\Carbon;
use Cart;
use App\FlightController;

class ReserveController extends Controller{

    public function searchFlights()
    {
        $cities = City::all();
        $seats = Seat::all();
        return view('reserve', compact('cities', 'seats'));
    }

    /**
    * Dado un origen, destino, fecha_ida y fecha_vuelta, busca vuelos que cumplan
    * con esas condiciones y retorna la vista chooseFlights.
    */
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
                $departure_date->isSameDay($fecha_ida)){

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
        Cart::add(array(
            'id' => 1,
            'name' => 'Sample Item',
            'price' => 0,
            'quantity' => 1,
            'attributes' => array(
                'passengers' => 2
            )
        ));
        return view('chooseFlights', compact('routesFound'));
    }

    public function storeChosenFlights(Request $request){
        $cart_id = 1;
        // Ids recibidos desde request luego de que el usuario escogiera
        $flights_ids = $request->all();
        // Obteniendo el carrito del usuario
        $reserve = Cart::get($cart_id);
        $reserve->attributes->flightIds = flights_ids;
        return redirect('/reserve/retrievePassengersInfo');
    }
    /**
     * Muestra la vista para que el usuario ingrese la informacion de los pasajeros del vuelo
     */
    public function retrievePassengersInfo(){
        //Cart::session($userId);
        $cartData = Cart::get(1);
        //return $cartData->attributes->passengers;
        return view('retrievePassengersInfo', compact('cartData'));
    }

    /**
     * Almacena informacion de pasajeros
     * 
     */
    public function storePassengersInfo(Request $request){
        foreach ($request->all() as $pasajero){
            echo $pasajero . PHP_EOL;
        }
        return redirect('/reserve/selectSeats');
    }

    /**
     * Retorna la vista para seleccionar asiento
     */
    public function selectSeats(FlightController $fc){

        $availableSeats = fc->availableSeats();
        return view('selectSeats', compact('availableSeats'));
    }
}
