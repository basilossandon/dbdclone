<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $primarykey = 'id';
    protected $fillable = [
      'modified_table_name',
      'modification',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
