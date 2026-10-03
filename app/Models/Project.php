<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'image',
        'client_name',
        'completion_date',
        'location',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
        'completion_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
