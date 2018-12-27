<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	public $timestamps = true;
    public function cities(){
      return $this->hasMany(City::class);
    }
}
