<?php

namespace App\Http\Controllers;
use App\Flight;
use App\Ticket;
use App\Reservation;
use App\Receipt;
use App\Airport;
use App\City;
use App\Seat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Illuminate\Support\Collection;
use Carbon\Carbon;

class FlightController extends Controller
{
    public $flightsFound;

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

    // Verifies if a seat in a flght is available
    public function available($flight_id, $seat_number){
        $flight = Flight::find($flight_id);
        if ($seat_number < 0 || $seat_number > $flight->flight_capacity){
            return false;
        }
        // The flight is available if none of it's tickets has their seat_number
        // taken
        return $flight->tickets->every(function ($ticket) use ($seat_number){
            return ($ticket->seat_number != $seat_number);
        });
    }

    // Gets available seats from a flight
    public function availableSeats($flight_id){
        $flight = Flight::find($flight_id);
        // Creates a colletion with this form {1, 2, ... , $flight->flight_capacity}
        $seatsList = Collection::times($flight->flight_capacity, function($number){
            return $number;
        });
        $availableSeats = $seatsList->filter(function ($seat) use ($flight_id){
            return $this->available($flight_id, $seat);
        });
        return $availableSeats;
    }

    // Verifies if a flight has at least one seat taken
    public function flightAvailable($flight){
        return ($flight->tickets->count() < $flight->flight_capacity);
    }
    // Reserves a flight
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
            // Links an unpaid receipt
            $receipt = new Receipt([
                'reservation_id' => $reservation->id,
                //'user_id' => Auth::user()->id,
                'user_id' => 22,
                'receipt_date' => Carbon::now(),
                'receipt_type' => 'por definir',
                'receipt_ammount' => 0,
            ]);
            $receipt->save();
            // Assumes that the seat $seat_number is available
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

    public static function calculateFlightPrice($seat_type_id, $flight_id){
        $price_modifier = Seat::find($seat_type_id)->price_modifier;
        $flight_distance = Flight::find($flight_id)->flight_distance;
        return $price_modifier * $flight_distance;
    }

    /**
    * Stores in $flightsFound all collections of flights (scales) available that
    * can be used to get from one place to another
    *
    * @param \Illuminate\Support\Collection $rama
    * @param string $destino
    * Initially rama must be a collection that contains a flight with it's origin
    */
    public function findFlights(\Illuminate\Support\Collection $rama, $destino){
        // If the last flight's destiny in rama is the target destiny
        if ($this->destinyCity($rama->last()->id) == $destino){
            // Add to $flightsFound the flight collection in rama
            $this->flightsFound->push($rama->all());
        }else if ($rama->count() < 2){
            // Flight candidates are the ones that have their origin in the last destiny in rama
            // and satisfy the conditions imposed in filter
            $candidatos = Flight::where('departure_airport_id', $rama->last()->arrival_airport_id)->get()
            ->filter(function ($flight) use ($rama){
                $fecha_salida = Carbon::parse($flight->flight_departure);
                $fecha_llegada = Carbon::parse($rama->last()->flight_arrival);
                // The destiny is not an origin city in ramas's flights
                $no_se_devuelve = $rama->every(function ($vuelo_rama) use ($flight){
                    return ($this->originCity($vuelo_rama->id) != $this->destinyCity($flight->id));
                });
                return (
                    // Flight not in rama
                    (!($rama->contains($flight))) &&
                    // Flight has at least one available seat
                    ($this->flightAvailable($flight)) &&
                    $no_se_devuelve &&
                    // The departure date in $flight is the same or after
                    // the last flight's arrival date in rama
                    ($fecha_salida->greaterThanOrEqualTo($fecha_llegada))
                );
            });
            foreach($candidatos as $candidato){
                $rama_copia = Collection::make();
                foreach($rama as $elem){
                    $rama_copia->push($elem);
                }
                $rama_copia->push($candidato);
                $this->findFlights($rama_copia, $destino);
            }
        }
    }

    public function showFoundFlights($origen, $destino){
        $this->flightsFound = Collection::make();
        Flight::all()->each(function ($flight) use($origen, $destino){
            if ($this->originCity($flight->id) == $origen){
                $this->findFlights(collect([$flight]), $destino);
            }
        });
        return $this->flightsFound;
    }

    /**
     *  Based on the id of flight and it's seat number, returns asociated seat type
     *
     */
    public function asociatedSeatType(Request $request){
        $flight = Flight::find($request['flight_id']);
        $seat_number = $request['seat_number'];
        $flight_capacity = $flight->flight_capacity;
        $sections = $flight_capacity / Seat::all()->count();

        $seat_type = intdiv($seat_number, $sections) + 1;
        if ($seat_type > Seat::all()->count()){
            $seat_type -= 1;
        }
        if ($request->ajax()){
            return Seat::find($seat_type)->toJson();
        } else {
            return Seat::find($seat_type);
        }

    }
}
