<?php

namespace App\Http\Controllers;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::all();
    }

    public function createOrEdit()
    {
        return view('tickets');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxTicket = Ticket::find($request->id);
        if($auxTicket == null){
            $ticket = new Ticket();
            $ticket->updateOrCreate([
                'seat_number' => $request->seat_number,
                'seat_letter' => $request->seat_letter,
                'passenger_id' => $request->passenger_id,
                'package_id' => $request->package_id,
                'seat_id' => $request->seat_id
                'reservation_id' => $request->reservation_id,
                'flight_id' => $request->flight_id
            ]);
        }
        else{
            $ticket = new Ticket();
            $ticket->updateOrCreate([
                'id' => $request->id,
            ], 
                ['seat_number' => $request->seat_number,
                'seat_letter' => $request->seat_letter,
                'passenger_id' => $request->passenger_id,
                'package_id' => $request->package_id,
                'seat_id' => $request->seat_id
                'reservation_id' => $request->reservation_id,
                'flight_id' => $request->flight_id
            ]);   
        }
        $ticket = Ticket::all();
        return $ticket;
    }

    public function show($id)
    {
        return Ticket::find($id);
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete(); 
        return Tickets::all();
    }
}
