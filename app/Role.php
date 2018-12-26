<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $primaryKey   = 'id';
	protected $fillable = ['role_name','role_description'];

		public function user()
	  {
			return $this->hasMany(User::class);
	  }
		// Un rol pertenece a muchos permisos
		public function permissions()
		{
			return $this->belongsToMany(Permission::class);
		}
}
