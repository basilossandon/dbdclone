<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function packages(){
      return $this->hasMany(Package::class);
    }

    public function reservations(){
      return $this->belongsToMany(Reservation::class)->withPivot('reservation_vehicle',
      'reservation_id', 'vehicle_id', 'vehicle_reservation_lease', 'vehicle_reservation_return');
    }
}
