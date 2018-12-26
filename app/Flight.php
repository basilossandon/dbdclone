<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
	protected $primaryKey = 'id';

		public function arrival_airport(){
      return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

		public function departure_airport(){
			return $this->belongsTo(Airport::class, 'departure_airport_id');
		}

		public function seats(){
			return $this->belongsToMany(Seat::class)->withPivot('flight_seat',
		'seat_id', 'flight_id', 'seat_type_capacity');
		}
}
