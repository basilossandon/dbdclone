<?php

namespace App\Http\Controllers;
use App\Flight;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
    // aun no esta implementada en su totalidad
    public function reserveTicket($flight_id, $passenger_id,$seat_id){
        $flightToReserve = Flight::find($id);
        $ticket = null; 
        if(Auth::user())
        {
            $ticket = new Ticket([  'passenger_id' => $passenger_id,
                                    'seat_id' => $seat_id,
                                    'reservation_id' => $request->reservation_id,
                                    'flight_id' => $flight_id]);
            $ticket->save();
            }   
            return $ticket;
        }
    }


