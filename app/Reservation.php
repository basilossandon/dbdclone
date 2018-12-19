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
}
