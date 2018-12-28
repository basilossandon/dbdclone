<?php

namespace App\Http\Controllers;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::all();
    }

    public function createOrEdit()
    {
        return view('reservations');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxReservation = Reservation::find($request->id);
        if($auxReservation == null){
            $reservation = new Reservation();
            $reservation->updateOrCreate([
                'reservation_date' => $request->reservation_date,
                'reservation_ip' => $request->reservation_ip
            ]);
        }
        else{
            $reservation = new Reservation();
            $reservation->updateOrCreate([
                'id' => $request->id,
            ], 
                ['reservation_date' => $request->reservation_date,
                'reservation_ip' => $request->reservation_ip
            ]);   
        }
        return Reservation::all();
    }

    public function show($id)
    {
        return Reservation::find($id);
    }


    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return Reservation::all();
    }

    public function showDetail($reservation_id){
      $reservation = Reservation::find($reservation_id);
      $rooms = $reservation->rooms()->get();
      $tickets = $reservation->tickets()->get();
      $vehicles = $reservation->vehicles()->get();
      return collect([$rooms, $tickets, $vehicles]);
    }
}
