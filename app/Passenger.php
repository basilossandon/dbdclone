<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    public function tickets(){
      return $this->hasMany(Ticket::class);
    }

    public function insurances(){
      return $this->belongsToMany(Insurance::class)->withPivot('insurance_passenger',
      'insurance_id', 'passenger_id', 'flight_id', 'insurance_start', 'insurance_finnish');
    }
}
