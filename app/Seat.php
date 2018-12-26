<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function tickets(){
      return $this->hasMany(Ticket::class);
    }

    public function flights(){
      return $this->belongsToMany(Flight::class)->withPivot('flight_seat',
		  'seat_id', 'flight_id', 'seat_type_capacity');
    }
}
