<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
		protected $primaryKey = 'id';
		protected $fillable = [
			'flight_code',
			'flight_capacity',
			'flight_distance',
			'flight_assigned_plane',
			'flight_departure',
			'flight_arrival',
			'departure_airport_id',
			'arrival_airport_id',
		];

		public function arrival_airport(){
      return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

		public function departure_airport(){
			return $this->belongsTo(Airport::class, 'departure_airport_id');
		}

		public function seats(){
			return $this->belongsToMany(Seat::class)->withPivot('flight_seat',
			'seat_type_capacity');
		}

		public function tickets(){
			return $this->hasMany(Ticket::class);
		}
}
