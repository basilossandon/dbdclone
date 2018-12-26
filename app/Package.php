<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function tickets(){
      return $this->hasMany(Ticket::class);
    }

    public function vehicle(){
      return $this->belongsTo(Vehicle::class);
    }

    public function receipts(){
      return $this->belongsToMany(Receipt::class);
    }

    public function rooms(){
      return $this->belongsToMany(Room::class);
    }
}
