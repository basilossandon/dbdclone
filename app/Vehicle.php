<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function packages(){
      return $this->hasMany(Package::class);
    }

    public function reservations(){
      return $this->belongsToMany(Reservation::class)->withPivot('vehicle_reservation_lease',
       'vehicle_reservation_return');
    }
    public function City()
    {
        return $this->belongsTo(City::class);
    }
}
