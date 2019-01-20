<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function register()
    {
        return $this->hasMany(Register::class);
    }
}
