<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
	protected $primaryKey = 'id';
    public function flightsDeparture(){
      return $this->belongsTo(App\Flight::class, 'departure_airport_id');
    }
    public function flightsArrival(){
      return $this->belongsTo(App\Flight::class, 'arrival_airport_id');
    }
}
