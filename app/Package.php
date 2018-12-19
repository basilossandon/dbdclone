<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function tickets(){
      return $this->hasMany(App\Ticket::class);
    }

    public function vehicle(){
      return $this->belongsTo(App\Vehicle::class);
    }
}
