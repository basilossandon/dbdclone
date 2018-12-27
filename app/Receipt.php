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
      return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function reservation(){
      return $this->belongsTo(Reservation::class);
    }
}
