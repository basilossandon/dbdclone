<?php

namespace App\Http\Controllers;
use App\Reservation;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Receipt;
use \Illuminate\Support\Collection;


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

    public function showDetail(){
      $user_id = Auth::id();
      $user = User::find($user_id);
      $vuelosPorReserva = Collection::make();
      $receipts = $user->receipts;
      foreach ($receipts as $receipt){
        $reservation = $receipt->reservation;
        $tickets = $reservation->tickets;
        $vuelosPorReserva->push($tickets);
      }
      return view('/checkin', compact('vuelosPorReserva'));
    }

}
