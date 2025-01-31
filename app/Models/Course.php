<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = ['image', 'name', 'ordering', 'track_id'];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
