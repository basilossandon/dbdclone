<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    public function tickets(){
      return $this->hasMany(App\Ticket::class);
    }

    public function insurances(){
      return $this->belongsToMany(App\Insurance::class);
    }
}
