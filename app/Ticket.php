<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function passenger(){
      return $this->belongsTo(App\Passenger::class);
    }

    public function package(){
      return $this->belongsTo(App\Package::class);
    }

    public function seat(){
      return $this->belongsTo(App\Seat::class);
    }

    public function reservation(){
      return $this->belongsTo(App\Reservation::class);
    }
}
