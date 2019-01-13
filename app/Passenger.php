<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $fillable = [
      'id',
      'passenger_name',
      'doc_number',
      'doc_type',
      'doc_country_emission'
    ];
    public function tickets(){
      return $this->hasMany(Ticket::class);
    }

    public function insurances(){
      return $this->belongsToMany(Insurance::class)->withPivot('flight_id');
    }
}
