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
use App\Reservation;
use App\Receipt;
use App\Insurance;
use App\PaymentMethod;

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
        // En el elemento 0 del carrito guardaremos cuantos pasajeros
        // ingreso el usuario (en al atributo quantity).
        Cart::add(array(
            'id' => 0,
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
        // Guardar los ids de los vuelos seleccionados en 'attributes' del elemento 0 del carro
        Cart::update(0, array('attributes' => $flights_ids));
        return redirect('/reserve/retrievePassengersInfo');
    }
    /**
     * Muestra la vista para que el usuario ingrese la informacion de los pasajeros del vuelo
     */
    public function retrievePassengersInfo(PassengerController $pc){
        $user_id = 1; // Usuario loggeado
        Cart::session($user_id);
        $cartData = Cart::get(0);
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
        // Elemento 0 del carro
        $aux = Cart::get(0);
        $ids_vuelos = $aux->attributes;
        // Crear la reserva
        $reservation = new Reservation;
        $reservation->reservation_ip = "test";
        $reservation->reservation_date = date('Y-m-d H:i:s');
        $reservation->save();
        // Crear un recibo y asociarlo al usuario loggeado
        $receipt = new Receipt;
        $receipt->receipt_date = date('Y-m-d H:i:s');
        $receipt->receipt_type = "boleta";
        $receipt->receipt_ammount = 0; // se calcula despues
        $receipt->user_id = $user_id;
        $receipt->reservation_id = $reservation->id;
        $receipt->save();
        // en aux price guardamos el id del recibo
        Cart::update(0, ['price' => $receipt->id]);
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
                $ticket->reservation_id = $reservation->id;
                $ticket->flight_id = $id_vuelo;
                // Guardar el ticket en la DB
                $ticket->save();
                // Añadir al carrito este ticket
                Cart::add(array(
                    'id' => $ticket->id,
                    'name' => $passenger->id,
                    'price' => 0, // se calcula a la hora de escoger asiento (proximo paso)
                    'quantity' => 1,
                    'attributes' => array(
                        // 'id_pasajero' => $passenger->id,
                        // 'id_seguro' => $datos_pasajero[4],
                    )
                ));
            }
        }
        // return Cart::getContent();
        return redirect('/reserve/selectSeats');
    }

    /**
     * Retorna la vista para seleccionar asiento
     */
    public function selectSeats(FlightController $fc){
        $user_id = 1; // Usuario loggeado
        Cart::session($user_id);
        // En attributes del elemento aux del carrito, se encuentran los ids de los vuelos
        $vuelos_solicitados = Collection::make();
        foreach (Cart::get(0)->attributes as $id){
            $vuelos_solicitados->push($id);
        }
        // Sera una coleccion de colecciones con los asientos disponibles por cada vuelo
        $availableSeats = Collection::make();
        foreach ($vuelos_solicitados as $id_vuelo){
            $seats = $fc->availableSeats($id_vuelo);
            $availableSeats->push($seats);
        }
        $agrupados_por_nombre = Cart::getContent()->groupBy('name');
        $nombres = Collection::make();
        // Los ids de los pasajeros, en el mismo orden que sus $nombres
        $ids_pasajeros = Collection::make();
        foreach($agrupados_por_nombre as $grupo){
            if ($grupo->first()->name != "aux"){
                // name es el id de passenger
                $passenger_id = $grupo->first()->name;
                $ids_pasajeros->push($passenger_id);
                $name = Passenger::find($passenger_id)->passenger_name;
                $nombres->push($name);
            }
        }

        $seguros = Insurance::all();
        // Vuelos_solicitados y available_seats son colecciones del mismo tamaño.
        // Para ver los asientos disponibles del vuelo i acceder a availableSeats[i]
        return view('selectSeats', compact('availableSeats', 'vuelos_solicitados', 'nombres', 'ids_pasajeros',
                    'seguros', 'user_id'));
    }

    /**
     * Guarda los asientos seleccionados por cada uno de los pasajeros
     * Se espera que $request sea una lista de strings de la forma:
     *  "idPasajero:asientoSeleccionado:idSeeguro_idPasajero:asientoSeleccionado:idSeguro"
     * Cada string representa contiene los asientos seleccionados por vuelo solicitado.
     */
    public function storeChosenSeats(Request $request){
        $user_id = 1; // id del usuario Loggeado
        Cart::session($user_id); // Carrito del usuario
        // Las reservas de cada pasajero
        $tickets = Cart::getContent();
        // Asignar el asiento seleccionado por cada ticket
        // Por cada ticket ...
        foreach ($tickets as $ticket){
            if ($ticket->id != 0){
                $id_ticket = $ticket->id;
                $id_pasajero = $ticket->name;
                // Acceder al ticket en la DB
                $ticket_db = Ticket::find($id_ticket);
                $id_vuelo_ticket = $ticket_db->flight_id;
                $datos_vuelo = $request[$id_vuelo_ticket];
                $datos_vuelo_separados = explode("_", $datos_vuelo);
                // Buscamos el numero de asiento seleccionado
                $asiento_escogido;
                $seguro_escogido;
                for ($aux = 0 ; $aux < count($datos_vuelo_separados) ; $aux++){
                    $datos_pasajero = $datos_vuelo_separados[$aux];
                    $datos_pasajero_separados = explode(":", $datos_pasajero);
                    if ($datos_pasajero_separados[0] == $id_pasajero){
                        $asiento_escogido = (int)$datos_pasajero_separados[1];
                        $seguro_escogido = (int)$datos_pasajero_separados[2];
                    }
                }
                // Obtener el tipo de asiento;
                $secciones = Flight::find($id_vuelo_ticket)->flight_capacity / Seat::all()->count();
                $tipo_asiento = intdiv($asiento_escogido, $secciones) + 1;
                if ($tipo_asiento > Seat::all()->count()){
                    $tipo_asiento -= 1;
                }
                // Asociar el seguro al vuelo y al pasajero
                if ($seguro_escogido != -1){
                    Insurance::find($seguro_escogido)->passengers()->attach($id_pasajero,
                    ['flight_id' => $id_vuelo_ticket]);
                }
                        
                // Guardar el numero de asiento en Ticket
                $ticket_db->seat_number = $asiento_escogido;
                // Guardar el tipo de asiento en Ticket
                $ticket_db->seat_id = $tipo_asiento;
                $ticket_db->save();

                // Guardar el precio total en el carrito
                $precio_sin_seguro = FlightController::calculateFlightPrice($tipo_asiento, $id_vuelo_ticket);
                $precio_con_seguro;
                if ($seguro_escogido != -1){
                    $precio_con_seguro = $precio_sin_seguro + Insurance::find($seguro_escogido)->insurance_price;
                } else {
                    $precio_con_seguro = $precio_sin_seguro;
                }
                Cart::update($id_ticket, array('price' => $precio_con_seguro));
            }
        }
        return redirect('/reserve/summary');
    }

    /**
     * Retorna la vista que muestra el sumario de la compra al usuario
     */
    public function showSummary(){
        $user_id = 1; // Usuario loggeado
        Cart::session($user_id);
        $aux = Cart::getContent()->firstWhere('name', 'aux');
        $receipt = Receipt::find($aux->price);
        $reservation = $receipt->reservation;
        // Vuelos
        $vuelos = $reservation->tickets;
        // datos de cada vuelo
        $datos_por_vuelo = Collection::make();
        foreach($vuelos as $vuelo){
            // vuelo es un Ticket
            $flight_id = $vuelo->flight_id;
            $ciudad_origen = FlightController::originCity($flight_id);
            $ciudad_destino = FlightController::destinyCity($flight_id);
            $precio_vuelo = FlightController::calculateFlightPrice($vuelo->seat_id, $flight_id);
            // Buscar el seguro asociado en la tabla insurance_passenger
            $seguro = Passenger::find($vuelo->passenger_id)->insurances->filter(function ($value) use ($flight_id){
                return $value->pivot->flight_id == $flight_id;
            });
            // Verificamos si existe tal seguro asociado
            if ($seguro->count() > 0){
                $seguro = $seguro->first();
            } else {
                $seguro = null;
            }
            $num_asiento = $vuelo->seat_number;
            $tipo_asiento = Seat::find($vuelo->seat_id)->seat_type;
            $pasajero = Passenger::find($vuelo->passenger_id)->passenger_name;
            $datos_por_vuelo->push(new class($seguro, $ciudad_origen, $ciudad_destino, $precio_vuelo, $num_asiento, $tipo_asiento, $pasajero){
                public $ciudad_origen;
                public $ciudad_destino;
                public $precio_vuelo;
                public $tipo_seguro;
                public $precio_seguro;
                public $num_asiento;
                public $tipo_asiento;
                public $pasajero;
                public function __construct($seguro, $ciudad_origen, $ciudad_destino, $precio, $num_asiento, $tipo_asiento, $pasajero){
                    $this->ciudad_origen = $ciudad_origen;
                    $this->ciudad_destino = $ciudad_destino;
                    $this->precio_vuelo = $precio;
                    if ($seguro != null){
                        $this->tipo_seguro = $seguro->insurance_type;
                        $this->precio_seguro = $seguro->insurance_price;
                    } else {
                        $this->tipo_seguro = 'Sin seguro asociado';
                        $this->precio_seguro = 0;
                    }
                    $this->num_asiento = $num_asiento;
                    $this->tipo_asiento = $tipo_asiento;
                    $this->pasajero = $pasajero;
                }
            });
        }
        return $datos_por_vuelo;
    }

    /**
     * Retorna la vista para pagar
     */
    public function pay(){
        $user_id = 1; // El usuario loggeado
        Cart::session($user_id);
        $total = 0;
        foreach (Cart::getContent() as $ticket){
            if ($ticket->id != 0){
                $total += $ticket->price;
            }
        }
        // Asignar el total al recibo de esta compra
        // $recibo = Receipt::find(Cart::get(0)->price);
        // $recibo->receipt_ammount = $total;
        // $recibo->save();
        return view('pay', compact('total'));
    }
    
    /**
     * Guarda el pago realizado
     */
    public function storePayment(Request $request){
        $user_id = 1; // El usuario loggeado
        Cart::session($user_id);
        $payment_method = new PaymentMethod();
        $payment_method->card_owner = $request['cc_owner'];
        $payment_method->card_number = $request['cc_number'];
        $payment_method->card_expiration_date = $request['cc_exp_mo'].'-'.$request['cc_exp_yr'];
        $payment_method->card_security_code = $request['cc_security_code'];
        $payment_method->save();

        // Asociar el medio de pago a la reserva
        $recibo = Receipt::find(Cart::get(0)->price);
        $recibo->payment_method_id = $payment_method->id;
        $recibo->save();
        return redirect('/');
    }

    /**
     * Retorna la lista de vuelos de la reserva
     */
    public function flightsOfCurrentReserve(Request $request){
        (int)$id_usuario = $request['id_usuario'];
        Cart::session($id_usuario);
        return response()->json(Cart::get(0)->attributes);        
    }

    /**
     * Retorna la lista de ids de pasajeros de la reserva
     */
    public function passengersOfCurrentReserve(Request $request){
        (int)$id_usuario = $request['id_usuario'];
        Cart::session($id_usuario);
        $agrupados_por_nombre = Cart::getContent()->groupBy('name');
        $ids_pasajeros = [];
        foreach($agrupados_por_nombre as $grupo){
            if ($grupo->first()->name != "aux"){
                // name es el id de passenger
                $passenger_id = $grupo->first()->name;
                array_push($ids_pasajeros, $passenger_id);
            }
        }
        return response()->json($ids_pasajeros);
    }
}
