<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    protected $primarykey = 'id';
    protected $fillable = [
      'card_owner',
      'card_number',
      'card_expiration_date',
      'card_security_code',
    ];

    public function receipt(){
      return $this->hasOne(Receipt::class, 'payment_method_id');
    }
}
