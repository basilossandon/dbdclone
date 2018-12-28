<?php

namespace App\Http\Controllers;
use App\Airport;

use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        return Airport::all();
    }

    public function createOrEdit()
    {
        return view('airports');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxairport = Airport::find($request->id);
        if($auxairport == null){
            $airport = new Airport();
            $airport->updateOrCreate([
                'airport_name' => $request->airport_name,
                'airport_code' => $request->airport_code,
                'airport_address' => $request->airport_address,
                'city_id' => $request->city_id
            ]);
        }
        else{
            $airport = new Airport();
            $airport->updateOrCreate([
                'id' => $request->id,
            ], 
                ['airport_name' => $request->airport_name,
                'airport_code' => $request->airport_code,
                'airport_address' => $request->airport_address,
                'city_id' => $request->city_id
            ]);   
        }
        return Airport::all();
    }

    public function show($id)
    {
        return Airport::find($id);
    }

    public function destroy($id)
    {
        $airport = Airport::find($id);
        $airport->delete();
        return Airport::all();
    }
}

