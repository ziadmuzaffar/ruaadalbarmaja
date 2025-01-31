<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = ['icon', 'name'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
