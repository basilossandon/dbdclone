<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
	protected $primaryKey = 'id';
    public function flights(){
      return $this->belongsToMany(App\Airport::class, 'airport');
    }
}
