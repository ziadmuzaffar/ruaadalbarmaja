<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = ['ordering', 'name', 'course_id', 'url'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
