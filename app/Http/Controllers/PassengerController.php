<?php

namespace App\Http\Controllers;
use App\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {
        return Passenger::all();
    }

    public function createOrEdit()
    {
        return view('passengers');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxpassenger = Passenger::find($request->id);
        if($auxpassenger == null){
            $passenger = new Passenger();
            $passenger->updateOrCreate([
                'doc_country_emission' => $request->doc_country_emission,
                'doc_number' => $request->doc_number,
                'doc_type' => $request->doc_type,
                'passenger_name' => $request->passenger_name
            ],[]);
        }
        else{
            $passenger = new Passenger();
            $passenger->updateOrCreate([
                'id' => $request->id,
            ], 
                ['doc_country_emission' => $request->doc_country_emission,
                'doc_number' => $request->doc_number,
                'doc_type' => $request->doc_type,
                'passenger_name' => $request->passenger_name
            ]);   
        }
        return Passenger::all();
    }

    public function show($id)
    {
        return Passenger::find($id);
    }

    public function destroy($id)
    {
        $passenger = Passenger::find($id);
        $passenger->delete();
        return Passenger::all();
    }
}
