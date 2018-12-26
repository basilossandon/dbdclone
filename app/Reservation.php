<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primarykey = 'id';

    public function receipt(){
      return $this->belongsTo(Receipt::class);
    }

    public function tickets(){
      return $this->hasMany(Ticket::class);
    }

    public function packages(){
      return $this->belongsToMany(Package::class);
    }

    public function vehicles(){
      return $this->belongsToMany(Vehicle::class)->withPivot('reservation_vehicle',
      'reservation_id', 'vehicle_id', 'vehicle_reservation_lease', 'vehicle_reservation_return');
    }

    public function rooms(){
      return $this->belongsToMany(Room::class)->withPivot('reservation_room',
      'reservation_id', 'room_id', 'reservation_room_lease', 'reservation_room_return');
    }
}
