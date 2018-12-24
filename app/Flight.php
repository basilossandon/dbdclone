<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
	protected $primaryKey = 'id';

		public function arrival_airport(){
      return $this->belongsTo(App\Airport::class, 'arrival_airport_id');
    }

		public function departure_airport(){
			return $this->belongsTo(App\Airport::class, 'departure_airport_id');
		}

		public function seats(){
			return $this->belongsToMany(App\Seat::class);
		}
}
