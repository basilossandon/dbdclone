<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    publlic function hotel(){
      return $this->belongsTo(App\Hotel::class);
    }
}
