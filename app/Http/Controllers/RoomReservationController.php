<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HotelController;
use \Illuminate\Support\Collection;
use App\City;
use App\Hotel;
use App\Room;

class RoomReservationController extends Controller
{
    public function searchRooms() {
        $cities = City::all();
        $hotels = Hotel::all();
        $rooms = Room::all();
        $roomTypes = RoomController::searchRoomTypes();
        return view('reserveHotel', compact('cities','hotels','roomTypes'));
    }

    public function chooseHotelRoom(Request $request){
        // return collect($request);
        $city_name = $request->input('city');
        $city_id = City::all()->where('city_name', $city_name)->first()->id;
        $stars = $request->input('stars');
        $room_type = $request->input('room_type');
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');

        $city_hotels = Hotel::all()->where('city_id', $city_id);
        //return $city_hotels;
        $city_hotels = $city_hotels->where('hotel_stars', $stars);
        // return $city_hotels;

        $availableRooms = Collection::make();
        foreach ($city_hotels as $hotel){
            $hotel_available_rooms = HotelController::showAvailableRooms($hotel->id, $check_in, $check_out);
            foreach ($hotel_available_rooms as $room){
                $availableRooms->push($room);
            }
        }
        return $availableRooms;
        return view('chooseRoom', compact('availableRooms'));
    }
}
