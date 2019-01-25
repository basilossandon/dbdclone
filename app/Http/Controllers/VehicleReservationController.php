<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Http\Controllers\VehicleController;
use Carbon\Carbon;
use App\Vehicle;
use Cart;
use App\Receipt;
use Auth;
use App\Reservation;
use App\PaymentMethod;

class VehicleReservationController extends Controller
{
    public function searchVehicles(){
        $user_id = Auth::id();
        Cart::session($user_id);
        Cart::clear();
        $cities = City::all();
        $vehicle_types = VehicleController::getVehicleTypes();
        return view('reserveVehicle', compact('cities', 'vehicle_types'));
    }

    public function showAvailableVehicles(Request $request){
        $user_id = Auth::id();
        Cart::session($user_id);

        $city = $request->input('city');
        $city_id = City::all()->where('city_name', $city)->first()->id;
        $vehicle_type = $request->input('vehicle_type');
        $pickup_date = Carbon::parse($request->input('pickup_date'));
        $dropoff_date = Carbon::parse($request->input('dropoff_date'));

        Cart::add(array(
          'id' => 0,
          'name' => 'aux',
          'price' => 0,
          'quantity' => 1,
          'attributes' => array(['pickup_date' => $pickup_date, 'dropoff_date' => $dropoff_date])
        ));

        $vehicles = Vehicle::all();
        $available_vehicles = $vehicles->filter(function ($vehicles) use($city_id, $pickup_date,$dropoff_date, $vehicle_type) {

          $thereArentReservations = $vehicles->reservations->every(function ($reservation) use ($pickup_date, $dropoff_date){
              $reservation_lease = Carbon::parse($reservation->pivot->vehicle_reservation_lease);
              $reservation_return = Carbon::parse($reservation->pivot->vehicle_reservation_lease);
              return (!($pickup_date->between($reservation_lease, $reservation_return)) && !($dropoff_date->between($reservation_lease, $reservation_return)) &&
                      !($reservation_lease->between($pickup_date, $dropoff_date)) &&
                      !($reservation_return->between($pickup_date, $dropoff_date)));
              });
          return ($vehicles->city_id == $city_id && $thereArentReservations && $vehicles->vehicle_type == $vehicle_type);
        });
        return view('chooseVehicles', compact('available_vehicles'));
    }

    public function storeVehicleReservation($id){
      $user_id = Auth::id();
      Cart::session($user_id);

      $pickup_date = Cart::get(0)->attributes[0]['pickup_date'];
      $dropoff_date = Cart::get(0)->attributes[0]['dropoff_date'];

      $vehicle_id = $id;

      // Create reservation
      $reservation = new Reservation;
      $reservation->reservation_ip = "test";
      $reservation->reservation_date = date('Y-m-d H:i:s');
      $reservation->save();
      // Create a receipt and link it to the logged user
      $receipt = new Receipt;
      $receipt->receipt_date = date('Y-m-d H:i:s');
      $receipt->receipt_type = "boleta";
      $receipt->receipt_ammount = Vehicle::find($vehicle_id)->vehicle_price;
      $receipt->user_id = $user_id;
      $receipt->reservation_id = $reservation->id;
      $receipt->save();

      $reservation->vehicles()->attach($vehicle_id, ['vehicle_reservation_lease' => $pickup_date,
                                                     'vehicle_reservation_return' => $dropoff_date]);

       Cart:: update(0, array(
           'price' => Vehicle::find($vehicle_id)->vehicle_price,
           'id' => $receipt->id
         ));

      return redirect('/reserve/vehicles/pay');
    }

    public function pay(){
        $user_id = Auth::user()->id;; // Logged user
        Cart::session($user_id);
        $total = Cart::getContent()->first()->price;
        return view('payVehicle', compact('total'));
    }

    public function storePayment(Request $request){
        $user_id = Auth::user()->id;; // Logged user
        Cart::session($user_id);
        $payment_method = new PaymentMethod();
        $payment_method->card_owner = $request['cc_owner'];
        $payment_method->card_number = $request['cc_number'];
        $payment_method->card_expiration_date = $request['cc_exp_mo'].'-'.$request['cc_exp_yr'];
        $payment_method->card_security_code = $request['cc_security_code'];
        $payment_method->save();
        $receipt = Receipt::find(Cart::getContent()->first()->id);
        $receipt->payment_method_id = $payment_method->id;
        $receipt->save();

        return view('/thanks', compact('user'));
    }
}
