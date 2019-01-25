<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\City;
use App\Room;
use \Illuminate\Support\Collection;
use Carbon\Carbon;
class HotelController extends Controller
{

    public function searchRoomTypes(){
        $rooms = Room::all();
        $roomTypes = Collection::make();
        foreach ($rooms as $room){
            if (!$roomTypes->contains($room->room_type))
            {
                $roomTypes->push($room->room_type);
            }
        }
        return $roomTypes;
    }


        public function searchHotels()
    {
        $cities = City::all();
        $hotels = Hotel::all();
        $rooms = Room::all();
        $roomTypes = $this->searchRoomTypes();
        return view('reserveHotel', compact('cities','hotels','roomTypes'));
    }

        public function chooseHotelRoom(Request $request){
        
        if (Auth::check()) {

        $city = $request->input('city');
        $stars = $request->input('stars');
        $room_type = $request->input('roomtypeselection');

        $reservation_room_lease = Carbon::parse($request->input('reservation_room_lease'));
        $reservation_room_return = Carbon::parse($request->input('reservation_room_return'));
        $user_id = Auth::user()->id;; // Id del usuario que esta logeado
        
        Cart::session($user_id);
        
        Cart::clear();
        // En el elemento 0 del carrito guardaremos cuantos pasajeros
        // ingreso el usuario (en al atributo quantity).
        $hotelController = new HotelController;
        $hotelController->hotelsFound = Collection::make();

        $city = $request->input('city');
        $city_id = City::all()->where('city_name', $city)->first()->id;


        $available_vehicles = $vehicles->filter(function ($vehicle) use($city_id) {
            return ($vehicle->city_id == $city_id);
        });
    }

        $hotelController->hotelsFound = Hotel::all()->filter(function ($city) use($city{
            return ($city_id == $city->id)
        })




        Hotel::all()->each(function ($flight) use($origen, $destino, $flightController, $fecha_ida, $fecha_vuelta){
            $departure_date = Carbon::parse($flight->flight_departure);
            if ($flightController->originCity($flight->id) == $origen &&
                $departure_date->isSameDay($fecha_ida)){

                $flightController->findFlights(collect([$flight]), $destino);
            }
        });

        $foundFlights = $flightController->flightsFound;

        $routesFound = Collection::make();
        $foundFlights->each(function ($routes) use ($routesFound){
            $route = Collection::make();
            foreach($routes as $flight){
                $origen = FlightController::originCity($flight->id);
                $destino = FlightController::destinyCity($flight->id);
                $fecha_salida = $flight->flight_departure;
                $fecha_llegada = $flight->flight_arrival;
                $id = $flight->id;
                $route->push(new class($origen, $destino, $fecha_salida, $fecha_llegada, $id){
                    public $id;
                    public $origen;
                    public $destino;
                    public $fecha_salida;
                    public $fecha_llegada;
                    public function __construct($origen, $destino, $fecha_salida, $fecha_llegada, $id){
                        $this->id = $id;
                        $this->origen = $origen;
                        $this->destino = $destino;
                        $this->fecha_salida = $fecha_salida;
                        $this->fecha_llegada = $fecha_llegada;
                    }
                });
            }
            $roomsFound->push($room);
        });
        return view('chooseRoom', compact('roomsFound'));
        }
        return redirect('/login');    
    }


    public function index()
    {
        return Hotel::all();
    }

    public function createOrEdit()
    {
        return view('hotels');
    }

    public function storeOrUpdate(Request $request)
    {
        $auxhotel = Hotel::find($request->id);
        if($auxhotel == null){
            $hotel = new Hotel();
            $hotel->updateOrCreate([
                'hotel_name' => $request->hotel_name,
                'hotel_address' => $request->hotel_address,
                'hotel_stars' => $request->hotel_stars,
                'city_id' => $request->city_id
            ]);
        }
        else{
            $hotel = new Hotel();
            $hotel->updateOrCreate([
                'id' => $request->id,
            ],
                ['hotel_name' => $request->hotel_name,
                'hotel_address' => $request->hotel_address,
                'hotel_stars' => $request->hotel_stars,
                'city_id' => $request->city_id
            ]);
        }
        return Hotel::all();
    }

    public function show($id)
    {
        return Hotel::find($id);
    }

    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        $hotel->delete();
        return Hotel::all();
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
    * Display all the available rooms of a given hotel at a given date range
    *
    * @param int $hotel_id
    * @param string $date
    */
    public function showAvailableRooms($hotel_id, $start_date, $end_date){
        $startAskedDate = Carbon::parse($start_date);
        $endAskedDate = Carbon::parse($end_date);
        $rooms = Hotel::find($hotel_id)->rooms;
        // Filters all available rooms
        $availableRooms = $rooms->filter(function ($room) use ($startAskedDate){
          // If none of the reserves contains $startAskedDate, $thereArentReservations = false
          $thereArentReservations = $room->reservations->every(function ($reservation) use ($startAskedDate, $endAskedDate){
              $reservation_lease = Carbon::parse($reservation->pivot->reservation_room_lease);
              $reservation_return = Carbon::parse($reservation->pivot->reservation_room_return);
              return (!($startAskedDate->between($reservation_lease, $reservation_return)) &&
                      !($endAskedDate->between($reservation_lease, $reservation_return)) &&
                      !($reservation_lease->between($startAskedDate, $endAskedDate)) &&
                      !($reservation_return->between($startAskedDate, $endAskedDate)));
            });
          // Filters if the room doesn't have any reserves or if none of it's reserves
          // uses $startAskedDate
          return ($room->reservations->count() == 0 || $thereArentReservations);
        });
        return $availableRooms;
    }
}
