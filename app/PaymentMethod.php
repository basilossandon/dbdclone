<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    protected $primarykey = 'id';

    public function receipt(){
      return $this->belongsTo(Receipt::class);
    }
}
