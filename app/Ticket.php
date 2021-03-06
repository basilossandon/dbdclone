<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];
    public function passenger(){
      return $this->belongsTo(Passenger::class);
    }

    public function package(){
      return $this->belongsTo(Package::class);
    }

    public function seat(){
      return $this->belongsTo(Seat::class);
    }

    public function reservation(){
      return $this->belongsTo(Reservation::class);
    }

    public function flight(){
      return $this->belongsTo(Flight::class);
    }
}
