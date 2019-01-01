<?php

namespace App\Http\Controllers;
use App\Flight;
use App\Ticket;
use App\Reservation;
use App\Receipt;
use App\Airport;
use App\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Illuminate\Support\Collection;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function index()
    {
        return Flight::all();
    }

    public function createOrEdit()
    {
        return view('flights');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxflight = Flight::find($request->id);
        if($auxflight == null){
            $flight = new Flight();
            $flight->updateOrCreate([
                'flight_departure' => $request->flight_departure,
                'flight_arrival' => $request->flight_arrival,
                'flight_assigned_plane' => $request->flight_assigned_plane,
                'flight_distance' => $request->flight_distance,
                'flight_capacity' => $request->flight_capacity,
                'flight_code' => $request->flight_code,
                'departure_airport_id' => $request->departure_airport_id,
                'arrival_airport_id' => $request->arrival_airport_id
            ]);
        }
        else{
            $flight = new Flight();
            $flight->updateOrCreate([
                'id' => $request->id,
            ],
                ['flight_departure' => $request->flight_departure,
                'flight_arrival' => $request->flight_arrival,
                'flight_assigned_plane' => $request->flight_assigned_plane,
                'flight_distance' => $request->flight_distance,
                'flight_capacity' => $request->flight_capacity,
                'flight_code' => $request->flight_code,
                'departure_airport_id' => $request->departure_airport_id,
                'arrival_airport_id' => $request->arrival_airport_id
            ]);
        }
        return Flight::all();
    }

    public function show($id)
    {
        return Flight::find($id);
    }

    public function destroy($id)
    {
        $flight = Flight::find($id);
        $flight->delete();
        return Flight::all();
    }

    // Determina si un asiento de un vuelo esta disponible
    public function available($flight_id, $seat_number){
        $flight = Flight::find($flight_id);
        if ($seat_number < 0 || $seat_number > $flight->flight_capacity){
            return false;
        }
        // El vuelo esta disponible si ninguno de sus tickets posee el seat_number
        // solicitado
        return $flight->tickets->every(function ($ticket) use ($seat_number){
            return ($ticket->seat_number != $seat_number);
        });
    }

    // Determina todos los asientos disponibles de un vuelo
    public function availableSeats($flight_id){
        $flight = Flight::find($flight_id);
        // Crea una coleccion de la forma {1, 2, ... , $flight->flight_capacity}
        $seatsList = Collection::times($flight->flight_capacity, function($number){
            return $number;
        });
        $availableSeats = $seatsList->filter(function ($seat) use ($flight_id){
            return $this->available($flight_id, $seat);
        });
        return $availableSeats->all();
    }

    // Reserva un vuelo
    public function reserveTicket($flight_id, $passenger_id, $seat_id, $seat_number){
        $flightToReserve = Flight::find($flight_id);
        $ticket = null;
        $reservation = null;
        $receipt = null;
        //if(Auth::check())
        //{
            $reservation = new Reservation([
                'reservation_date' => Carbon::now(),
                'reservation_ip' => 'test',
            ]);
            $reservation->save();
            // Se asocia un recibo que aun no es pagado
            $receipt = new Receipt([
                'reservation_id' => $reservation->id,
                //'user_id' => Auth::user()->id,
                'user_id' => 22,
                'receipt_date' => Carbon::now(),
                'receipt_type' => 'por definir',
                'receipt_ammount' => 0,
            ]);
            $receipt->save();
            // Se asume que el asiento $seat_number esta disponible
            $ticket = new Ticket([  'passenger_id' => $passenger_id,
                                    'seat_id' => $seat_id,
                                    'seat_number' => $seat_number,
                                    'reservation_id' => $reservation->id,
                                    'flight_id' => $flight_id]);
            $ticket->save();
            //}
            //return $ticket;
        //}
    }
    public function reserve(Request $request){
        $this->reserveTicket(
          $request->input('flight_id'),
          $request->input('passenger_id'),
          $request->input('seat_id'),
          $request->input('seat_number')
        );
    }

    public static function originCity($id){
        $flight = Flight::find($id);
        $airport_id = $flight->departure_airport_id;
        $airport = Airport::find($airport_id);
        $city_id = $airport->city_id;
        $city = City::find($city_id);
        return $city->city_name;
    }

    public static function destinyCity($id){
        $flight = Flight::find($id);
        $airport_id = $flight->arrival_airport_id;
        $airport = Airport::find($airport_id);
        $city_id = $airport->city_id;
        $city = City::find($city_id);
        return $city->city_name;
    }
}
