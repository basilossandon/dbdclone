<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public function rooms(){
      return $this->hasMany(Room::class);
    }

    public function city(){
      return $this->belongsTo(City::class);
    }
}
