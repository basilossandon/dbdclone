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
    public function index()
    {
        return Package::all();
    }

    public function createOrEdit()
    {
        return view('packages');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxpackage = Package::find($request->id);
        if($auxpackage == null){
            $package = new Package();
            $package->updateOrCreate([
                'package_name' => $request->package_name,
                'package_price' => $request->package_price,
                'package_stock' => $request->package_stock,
                'package_type' => $request->package_type,
                'vehicle_id' => $request->vehicle_id
            ]);
        }
        else{
            $package = new Package();
            $package->updateOrCreate([
                'id' => $request->id,
            ],
                ['package_name' => $request->package_name,
                'package_price' => $request->package_price,
                'package_stock' => $request->package_stock,
                'package_type' => $request->package_type,
                'vehicle_id' => $request->vehicle_id
            ]);
        }
        return Package::all();
    }

    public function show($id)
    {
        return Package::find($id);
    }

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
        $tickets = $package->tickets()->where('passenger_id', null)->get();
        $flightsInfo = Collection::make();
        foreach($tickets as $ticket){
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
