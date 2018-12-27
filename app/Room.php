<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function hotel(){
      return $this->belongsTo(Hotel::class);
    }

    public function reservations(){
      return $this->belongsToMany(Reservation::class)->withPivot('reservation_room_lease',
      'reservation_room_return');
    }

    public function packages(){
      return $this->belongsToMany(Package::class);
    }
}
