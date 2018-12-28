<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    public function country(){
      return $this->belongsTo(Country::class);
    }

    public function hotels(){
      return $this->hasMany(Hotel::class);
    }

    public function airports(){
      return $this->hasMany(Airport::class);
    }
}
