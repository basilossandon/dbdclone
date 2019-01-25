<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Http\Controllers\VehicleController;
use Carbon\Carbon;
use App\Vehicle;

class VehicleReservationController extends Controller
{
    public function searchVehicles(){
        $cities = City::all();
        $vehicle_types = VehicleController::getVehicleTypes();
        return view('reserveVehicle', compact('cities', 'vehicle_types'));
    }

    public function showAvailableVehicles(Request $request){
        $city = $request->input('city');
        $city_id = City::all()->where('city_name', $city)->first()->id;
        $vehicle_type = $request->input('vehicle_type');
        $pickup_date = Carbon::parse($request->input('pickup_date'));
        $dropoff_date = Carbon::parse($request->input('dropoff_date'));

        $vehicles = Vehicle::all();
        $available_vehicles = $vehicles->filter(function ($vehicles) use($city_id, $pickup_date,$dropoff_date) {

          $thereArentReservations = $vehicles->reservations->every(function ($reservation) use ($pickup_date, $dropoff_date){
              $reservation_lease = Carbon::parse($reservation->pivot->vehicle_reservation_lease);
              $reservation_return = Carbon::parse($reservation->pivot->vehicle_reservation_lease);
              return (!($pickup_date->between($reservation_lease, $reservation_return)) && !($dropoff_date->between($reservation_lease, $reservation_return)) &&
                      !($reservation_lease->between($pickup_date, $dropoff_date)) &&
                      !($reservation_return->between($pickup_date, $dropoff_date)));
              });
          return ($vehicles->city_id == $city_id && $thereArentReservations);
        });
        return view('chooseVehicles', compact('available_vehicles'));
    }
}
