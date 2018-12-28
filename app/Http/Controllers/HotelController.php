<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use \Illuminate\Support\Collection;
use Carbon\Carbon;
class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showRooms($hotel_id){
        $hotel = Hotel::find($hotel_id);
        $rooms = $hotel->rooms;
        if ($rooms->count() == 0){
          echo 'ESTE HOTEL NO TIENE HABITACIONES';
          return null;
        }
        return $rooms;
    }

    /**
    * Display all the reservated rooms in a hotel at any date
    * @param int $hotel_id
    *
    */
    public function showReservatedRooms($hotel_id){
        $hotel = Hotel::find($hotel_id);
        $rooms = $hotel->rooms;
        if ($rooms->count() == 0){
          echo 'ESTE HOTEL NO TIENE HABITACIONES';
          return null;
        }
        $reservatedRooms = $rooms->filter(function ($room) {
            return ($room->reservations->count() > 0);
        });
        return $reservatedRooms;
    }

    /**
    * Display all the available rooms of a given hotel at a given date
    *
    * @param int $hotel_id
    * @param string $date
    */
    public function showAvailableRooms($hotel_id, $date){
        $askedDate = Carbon::parse($date);
        $rooms = Hotel::find($hotel_id)->rooms;
        // filtrar las habitaciones que esten disponibles
        $availableRooms = $rooms->filter(function ($room) use ($askedDate){
          // Si ninguna de las reservas contiene $askedDate, $thereArentReservations = false
          $thereArentReservations = $room->reservations->every(function ($reservation) use ($askedDate){
              $reservation_lease = Carbon::parse($reservation->pivot->reservation_room_lease);
              $reservation_return = Carbon::parse($reservation->pivot->reservation_room_return);
              return (!($askedDate->between($reservation_lease, $reservation_return)));
            });
          // Se filtra si la haabitacion no tiene reservas o ninguna de sus reservas
          // ocupa $askedDate
          return ($room->reservations->count() == 0 || $thereArentReservations);
        });
        return $availableRooms;
    }
}
