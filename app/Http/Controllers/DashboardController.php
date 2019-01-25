<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;
use App\Hotel;
use App\Vehicle;
use App\Package;


class DashboardController extends Controller
{
    
    public function index()
    {
        $flights = Flight::all();
        $hotels = Hotel::all();
        $vehicles = Vehicle::all();
        $packages = Package::all();
        return view('dashboard', compact('flights', 'hotels','vehicles', 'packages'));
    }

}
