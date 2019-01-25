<?php
namespace App\Http\Controllers;
use App\Vehicle;
use Illuminate\Http\Request;
class VehicleController extends Controller
{
    
    public function index()
    {
        return Vehicle::all();
    }

    public function searchVehicles()
    {
        $vehicles = Vehicle::all();
        return view('vehicle', compact('vehicles'));
    }



    public function createOrEdit()
    {
        return view('vehicles');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxVehicle = Vehicle::find($request->id);
        if($auxVehicle == null){
            $vehicle = new Vehicle();
            $vehicle->updateOrCreate([
                'vehicle_price' => $request->vehicle_price,
                'vehicle_type' => $request->vehicle_type,
                'vehicle_licence_plate' => $request->vehicle_licence_plate
            ]);
        }
        else{
            $vehicle = new Vehicle();
            $vehicle->updateOrCreate([
                'id' => $request->id,
            ], 
                ['vehicle_price' => $request->vehicle_price,
                'vehicle_type' => $request->vehicle_type,
                'vehicle_licence_plate' => $request->vehicle_licence_plate
            ]);   
        }
        return Vehicle::all();
    }

    public function show($id)
    {
        return Vehicle::find($id);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();      
        return Vehicle::all();
    }

    public function reserveVehicle(Request $request){
        // por implementar
    }

}

