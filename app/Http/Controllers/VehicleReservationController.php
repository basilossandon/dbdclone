<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Http\Controllers\VehicleController;

class VehicleReservationController extends Controller
{
    public function searchVehicles(){
        $cities = City::all();
        $vehicle_types = VehicleController::getVehicleTypes();
        return view('reserveVehicle', compact('cities', 'vehicle_types'));
    }
}
