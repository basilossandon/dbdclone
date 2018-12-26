<?php

namespace App\Http\Controllers;
use App\Flight;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Flight::all();
    }

    //public function filterByUser

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
        Flight::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Flight::find($id);
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
        $flight = Flight::find($id);
        $flight->flight_code = $request->input('flight_code');
        $flight->flight_capacity = $request->input('flight_capacity');
        $flight->flight_distance = $request->input('flight_distance');
        $flight->flight_assigned_plane = $request->input('flight_assigned_plane');
        $flight->flight_departure = $request->input('flight_departure');
        $flight->flight_arrival = $request->input('flight_arrival');
        $flight->departure_airport_id = $request->input('departure_airport_id');
        $flight->arrival_airport_id = $request->input('arrival_airport_id');
        $flight->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = Flight::find($id);
        $flight->delete();
    }
}
