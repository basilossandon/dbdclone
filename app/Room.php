<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function hotel(){
      return $this->belongsTo(Hotel::class);
    }

    public function reservations(){
      return $this->belongsToMany(Reservation::class);
    }

    public function packages(){
      return $this->belongsToMany(Package::class);
    }
}
