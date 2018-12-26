<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    public function passengers(){
      return $this->belongsToMany(Passenger::class);
    }
}
