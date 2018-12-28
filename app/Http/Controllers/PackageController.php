<?php

namespace App\Http\Controllers;
use App\Package;
use App\Ticket;
use App\FlightUserInfo;
use App\Airport;
use Illuminate\Http\Request;
use \Illuminate\Support\Collection;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Package::all();
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
        return Package::find($id);
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
        $package = Package::find($id);
        $package->delete();
    }

    /**
    * Get all the services asociated to a package
    * @param int $packageId
    *
    */
    public function showDetail($packageId){
        $package = Package::find($packageId);
        $tickets = $package->tickets()->get();
        $flightsInfo = Collection::make();
        foreach($tickets as $ticket){
            $flightInfo = new FlightUserInfo;
            $departureAirportId = $ticket->flight->departure_airport_id;
            $arrivalAirportId = $ticket->flight->arrival_airport_id;

            $departureAirport = Airport::find($departureAirportId);
            $arrivalAirport = Airport::find($arrivalAirportId);

            $origin = $departureAirport->city->city_name;
            $destiny = $arrivalAirport->city->city_name;
            $seat_type = $ticket->seat->seat_type;
            $flightsInfo->push(new class($origin, $destiny, $seat_type){
                public $origin;
                public $destiny;
                public $seat_type;
                public function __construct($origin, $destiny, $seat_type){
                  $this->origin = $origin;
                  $this->destiny = $destiny;
                  $this->seat_type = $seat_type;
                }
            });
        }
        $rooms = $package->rooms()->get();
        // Un paquete tiene un solo vehiculo
        $vehicle = $package->vehicle()->first();
        return collect([$flightsInfo, $rooms, $vehicle]);
    }
}
