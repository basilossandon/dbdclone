<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use \Illuminate\Support\Collection;
use App\Flight;
class CityController extends Controller
{
    public function index()
    {
        return City::all();
    }

    public function createOrEdit()
    {
        return view('cities');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxCity = City::find($request->id);
        if($auxCity == null){
            $city = new City();
            $city->updateOrCreate([
                'city_name' => $request->city_name,
                'country_code' => $request->country_code,
                'country_id' => $request->country_id
            ]);
        }
        else{
            $city = new Airport();
            $city->updateOrCreate([
                'id' => $request->id,
            ], 
                ['city_name' => $request->city_name,
                'country_code' => $request->country_code,
                'country_id' => $request->country_id
            ]);   
        }
        return City::all();
    }

    public function show($id)
    {
        return City::find($id);
    }

    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return City::all();
    }
    public function showAvailableFlights($city_id){
      $city = City::find($city_id);
      $airports = $city->airports()->get();
      $availableFlights = Collection::make();
      foreach($airports as $airport){
        $flights = Flight::where('departure_airport_id', $airport->id)->get();
        $filteredFlights = $flights->filter(function ($flight) {
          $boughtTickets = $flight->tickets->count();
          return ($flight->flight_capacity - $boughtTickets > 0);
        });
        $availableFlights = $availableFlights->concat($filteredFlights);
      }
      return $availableFlights;
    }
}
