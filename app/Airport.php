<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
	protected $primaryKey = 'id';
    public function flightsDeparture(){
      return $this->HasMany(App\Flight::class, 'departure_airport_id');
    }
    public function flightsArrival(){
      return $this->HasMany(App\Flight::class, 'arrival_airport_id');
    }
		public function seats(){
			return $this->belongsToMany(App\Seat::class);
		}
}
