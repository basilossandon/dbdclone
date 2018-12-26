<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $primarykey = 'id';
    protected $fillable = [
      'receipt_ammount',
      'receipt_date',
      'receipt_type',
    ];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function paymentMethod(){
      return $this->hasOne(PaymentMethod::class);
    }

    public function reservation(){
      return $this->hasOne(Reservation::class);
    }
}
