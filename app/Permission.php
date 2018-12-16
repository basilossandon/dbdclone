<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  protected $primaryKey   = 'id';
  protected $fillable = ['permission_name','permission_type'];

    // Un permiso pertenece a muchos roles
    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }
}
