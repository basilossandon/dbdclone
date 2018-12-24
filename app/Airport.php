<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
	protected $primaryKey = 'id';
    public function flights(){
      return $this->belongsToMany(App\Flight::class);
    }
}
