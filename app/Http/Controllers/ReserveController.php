<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Collection;
use App\City;

class ReserveController extends Controller{

    public function searchFlights()
    {
        $cities = City::all();
        return view('reserve', compact('cities'));
    }
}
