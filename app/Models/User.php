<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // The attributes that are mass assignable.
    protected $fillable = ['full_name', 'email', 'password'];
    // The attributes that should be hidden for serialization.
    protected $hidden = ['password', 'remember_token'];
    // The attributes that should be cast.
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];
}
