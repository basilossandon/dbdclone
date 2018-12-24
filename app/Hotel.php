<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public function rooms(){
      return $this->hasMany(App\Room::class);
    }

    public function city(){
      return $this->belongsTo(App\City::class);
    }
}
