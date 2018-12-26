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
      return $this->belongsToMany(Vehicle::class);
    }

    public function rooms(){
      return $this->belongsToMany(Room::class);
    }
}
