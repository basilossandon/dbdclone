<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function hotel(){
      return $this->belongsTo(App\Hotel::class);
    }

    public function reservations(){
      return $this->belongsToMany(App\Reservation::class);
    }

    public function packages(){
      return $this->belongsToMany(App\Package::class);
    }
}
