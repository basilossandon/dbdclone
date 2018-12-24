<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function tickets(){
      return $this->hasMany(App\Ticket::class);
    }

    public function flights(){
      return $this->belongsToMany(App\Flight::class);
    }
}
