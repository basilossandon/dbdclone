<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function airports(){
      return $this->belongsToMany(App\Airport::class);
    }
}
