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


    public function createOrEdit()
    {
        return view('vehicles');
    }


    public function store(Request $request)
    {
        Vehicle::create([
            'vehicle_price' => $request->vehicle_price,
            'vehicle_type' => $request->vehicle_type,
            'vehicle_licence_plate' => $request->vehicle_licence_plate,

        ]);
        return Vehicle::all();
    }


    public function show($id)
    {
        return Vehicle::find($id);
    }

    public function update(Request $request, $id)
    {
        Vehicle::find($id)->update([
            'vehicle_price' => $request->vehicle_price,
            'vehicle_type' => $request->vehicle_type,
            'vehicle_licence_plate' => $request->vehicle_licence_plate,

        ]);
        return Vehicle::all();
    }



    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();      
        return Vehicle::all();
    }
    public function searchVehicle(Request $request) {
        // por implementar
    }

    public function reserveVehicle(Request $request){
        // por implementar
    }

}

