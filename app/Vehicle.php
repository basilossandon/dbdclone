<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function packages(){
      return $this->hasMany(App\Package::class);
    }
}
