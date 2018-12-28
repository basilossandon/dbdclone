<?php

namespace App\Http\Controllers;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrEdit()
    {
        return view('tickets');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ticket::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete(); 
        return Tickets::all();
    }
}
