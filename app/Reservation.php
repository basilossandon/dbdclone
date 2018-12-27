<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primarykey = 'id';

    public function receipt(){
      return $this->hasOne(Receipt::class);
    }

    public function tickets(){
      return $this->hasMany(Ticket::class);
    }

    public function packages(){
      return $this->belongsTo(Package::class);
    }

    public function vehicles(){
      return $this->belongsToMany(Vehicle::class)->withPivot('vehicle_reservation_lease',
      'vehicle_reservation_return');
    }

    public function rooms(){
      return $this->belongsToMany(Room::class)->withPivot('reservation_room_lease',
      'reservation_room_return');
    }
}
