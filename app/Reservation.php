<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primarykey = 'id';

    public function receipt(){
      return $this->belongsTo(App\Receipt::class);
    }

    public function tickets(){
      return $this->hasMany(App\Ticket::class);
    }

    public function packages(){
      return $this->belongsToMany(App\Package::class);
    }

    public function vehicles(){
      return $this->belongsToMany(App\Vehicle::class);
    }

    public function rooms(){
      return $this->belongsToMany(App\Room::class);
    }
}
