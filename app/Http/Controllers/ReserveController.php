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
use App\Ticket;

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
        Cart::clear();
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
                $id = $flight->id;
                $route->push(new class($origen, $destino, $fecha_salida, $fecha_llegada, $id){
                    public $id;
                    public $origen;
                    public $destino;
                    public $fecha_salida;
                    public $fecha_llegada;
                    public function __construct($origen, $destino, $fecha_salida, $fecha_llegada, $id){
                        $this->id = $id;
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

    /**
     * Almacena los vuelos seleccionados en el carrito
     */
    public function storeChosenFlights(Request $request){
        $user_id = 1; // El usuario loggeado
        Cart::session($user_id);
        // Ids recibidos desde request luego de que el usuario escogiera
        $flights_ids = $request->all();
        // Se espera un array de ids de vuelos
        // Guardar los ids de los vuelos seleccionados en 'attributes' del elemento 1 del carro
        Cart::update(1, array('attributes' => $flights_ids));
        return redirect('/reserve/retrievePassengersInfo');
    }
    /**
     * Muestra la vista para que el usuario ingrese la informacion de los pasajeros del vuelo
     */
    public function retrievePassengersInfo(PassengerController $pc){
        $user_id = 1; // Usuario loggeado
        Cart::session($user_id);
        $cartData = Cart::get(1);
        // Obtiene el numero de pasajeros seleccionados para saber cuantos formularios
        // desplegar en la vista
        $passengers = $cartData->quantity;
        return view('retrievePassengersInfo', compact('passengers'));
    }

    /**
     * Almacena informacion de pasajeros en la DB
     * Se espera que Request sea una lista de strings con la info de pasajeros
     * en donde cada pasajero tiene sus datos separados por _
     */
    public function storePassengersInfo(Request $request){
        $user_id = 1; // Usuario loggeado
        Cart::session($user_id);
        // Elemento 1 del carro
        $aux = Cart::get(1);
        $ids_vuelos = $aux->attributes;
        // Por cada pasajero, agregar un elemento al carrito por vuelo en ids_vuelos
        foreach ($request->all() as $pasajero){
            // $pasajero[0] = nombre ; $pasajero[1] = num_doc
            // $pasajero[2] = pais_doc ; $pasajero[3] = tipo_doc
            // $pasajero[4] = id_seguro (-1 si no desea)
            // Separar los datos por guion bajo 
            $datos_pasajero = explode("_", $pasajero);
            // Crear un modelo de Passenger por cada pasajero
            $passenger = new Passenger;
            $passenger->passenger_name = $datos_pasajero[0];
            $passenger->doc_number = $datos_pasajero[1];
            $passenger->doc_country_emission = $datos_pasajero[2];
            $passenger->doc_type = $datos_pasajero[3];
            // Guardar al pasajero en la DB
            $passenger->save();
            // Crear un ticket para este pasajero para cada vuelo
            foreach ($ids_vuelos as $id_vuelo){
                $ticket = new Ticket;
                $ticket->passenger_id = $passenger->id;
                $ticket->seat_number = 0; // se va a seleccionar en el proximo paso
                $ticket->seat_id = 1; // se va a seleccionar en el proximo paso
                $ticket->reservation_id = 1; // la reserva se crea al momento de pagar
                $ticket->flight_id = $id_vuelo;
                // Guardar el ticket en la DB
                $ticket->save();
                // Añadir al carrito este ticket
                Cart::add(array(
                    'id' => $ticket->id,
                    'name' => $passenger->passenger_name,
                    'price' => 0, // se calcula a la hora de escoger asiento (proximo paso)
                    'quantity' => 1,
                    'attributes' => array(
                        'id_pasajero' => $passenger->id,
                        'id_seguro' => $datos_pasajero[4],
                    )
                ));
            }
        }
        return Cart::getContent();
        return redirect('/reserve/selectSeats');
    }

    /**
     * Retorna la vista para seleccionar asiento
     */
    public function selectSeats(FlightController $fc){
        $user_id = 1; // Usuario loggeado
        Cart::session($user_id);
        // En attributes del elemento 1 del carrito, se encuentran los ids de los vuelos
        $vuelos_solicitados = Cart::get(1)->attributes();
        // Sera una coleccion de colecciones con los asientos disponibles por cada vuelo
        $availableSeats = Collection::make();
        foreach ($vuelos_solicitados as $id_vuelo){
            $seats = $fc->availableSeats();
            $availableSeats->push($seats);
        }
        $agrupados_por_nombre = Cart::getContent()->groupBy('name');
        $nombres = Collection::make();
        foreach($agrupados_por_nombre as $grupo){
            $nombres->push($grupo->first['name']);
        }
        return view('selectSeats', compact('availableSeats', 'vuelos_solicitados', 'nombres'));
    }
}
