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
use App\PassenngerController;
use App\Passenger;

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
        $num_pasajeros = 2;
        $fecha_ida = Carbon::parse($request->input('fecha_ida'));
        $fecha_vuelta = Carbon::parse($request->input('fecha_vuelta'));
        $user_id = 1; // Id del usuario que esta logeado
        Cart::session($user_id);
        // En el primer elemento del carrito guardaremos cuantos pasajeros
        // ingreso el usuario (en al atributo quantity)
        Cart::add(array(
            'id' => 1,
            'name' => 'aux',
            'price' => 0,
            'quantity' => $num_pasajeros,
        ));

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
        return view('chooseFlights', compact('routesFound'));
    }

    public function storeChosenFlights(Request $request){
        $user_id = 1; // El usuario logeado
        Cart::session($user_id);
        // Ids recibidos desde request luego de que el usuario escogiera
        // Se espera un array de ids de vuelos
        $flights_ids = $request->all();
        // Numero de vuelos
        $num_vuelos = $flights_ids->count();
        // Numero de pasajeros seleccionados en el primer paso
        $reserve = Cart::get(1);
        $num_pasajeros = $reserve->quantity;
        // Crear un pasaje por cada vuelo y pasajero
        for ($i=0; $i<$num_vuelos; $i++){
            for($j=0; $j<$num_pasajeros; $j++){
                Cart::add(array(
                    'id' => Cart::getContent()->count() + 1,
                    'name' => "",
                    'price' => 0,
                    'attributes' => array(
                        'id_pasajero' => 0,
                        'id_seguro' => 0,
                        'id_vuelo' => $flights_ids[$i],
                        'num_doc' => "",
                        'pais_doc' => "",
                        'tipo_doc' => "",
                        'num_asiento' => 0,
                        )
                    ));
            }
        }
        return redirect('/reserve/retrievePassengersInfo');
    }
    /**
     * Muestra la vista para que el usuario ingrese la informacion de los pasajeros del vuelo
     */
    public function retrievePassengersInfo(PassengerController $pc){
        $user_id = 1; // Usuario loggeado
        Cart::session($user_id);
        $cartData = Cart::get(1);
        $passengers = $cartData->quantity;
        //return $cartData->attributes->passengers;
        return view('retrievePassengersInfo', compact('passengers'));
    }

    /**
     * Almacena informacion de pasajeros en la DB
     * 
     */
    public function storePassengersInfo(Request $request){
        $user_id = 1; // Usuario loggeado
        Cart::session($user_id);
        // Separar elementos del carrito por id_vuelo
        // $tickets_por_vuelo = Collection::make();
        
        $passengers_ids = Collection::make();
        foreach ($request->all() as $pasajero){
            // $datos[0] = nombre ; $datos[1] = num_doc
            // $datos[2] = pais_doc ; $datos[3] = tipo_doc
            // $datos[4] = id_seguro (-1 si no desea) 
            $datos_pasajero = explode("_", $pasajero);
            // Crear un modelo de Passenger por cada pasajero
            $passenger = new Passenger;
            $passenger->name = $datos_pasajero[0];
            $passenger->doc_number = $pasajero[1];
            $passenger->save();
            $passengers->push($passenger->id);
            //Cart::update('')
        }
        //$cart->update();
        //return redirect('/reserve/selectSeats');
    }

    /**
     * Retorna la vista para seleccionar asiento
     */
    public function selectSeats(FlightController $fc){

        $availableSeats = $fc->availableSeats();
        return view('selectSeats', compact('availableSeats'));
    }
}
