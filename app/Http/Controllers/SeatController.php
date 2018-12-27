<?php

namespace App\Http\Controllers;
use App\Seat;
use Illuminate\Http\Request;
class SeatController extends Controller
{

    public function index()
    {
        return Seat::all();
    }

    public function createOrEdit()
    {
        return view('seats');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxSeat = Ticket::find($request->id);
        if($auxSeat == null){
            $seat = new Seat();
            $seat->updateOrCreate([
                'seat_type' => $request->seat_type,
                'price_modifier' => $request->price_modifier
            ],[]);
        }
        else{
            $seat = new ticket();
            $seat->updateOrCreate([
                'id' => $request->id,
            ], 
                ['seat_type' => $request->seat_type,
                'price_modifier' => $request->price_modifier
            ]);   
        }
        $seat = Ticket::all();
        return $seat;
    }

    public function show($id)
    {
        return Seat::find($id);
    }

    public function destroy($id)
    {
        $seat = Seat::find($id);
        $seat->delete();    
        $seat = Seat::all();
        return $seat;   
    }
}
