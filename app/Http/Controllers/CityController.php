<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use \Illuminate\Support\Collection;
use App\Flight;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Display all the available flights in a certain city
    * @param int $city_id
    *
    */
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
