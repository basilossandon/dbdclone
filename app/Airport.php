<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
		protected $primaryKey = 'id';

		public function flightsDeparture(){
      return $this->HasMany(Flight::class, 'departure_airport_id');
    }

		public function flightsArrival(){
      return $this->HasMany(Flight::class, 'arrival_airport_id');
    }

		public function city(){
			return $this->belongsTo(City::class);
		}

}
