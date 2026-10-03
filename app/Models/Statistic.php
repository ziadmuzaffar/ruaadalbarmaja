<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'value',
        'label',
        'icon',
        'order',
        'is_active',
        'type',
        'source_model',
        'calculation_method',
        'suffix',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the calculated value for auto statistics
     */
    public function getCalculatedValueAttribute(): string
    {
        if ($this->type === 'manual') {
            return $this->value;
        }

        if (!$this->source_model || !class_exists($this->source_model)) {
            return '0';
        }

        $model = $this->source_model;
        $value = 0;

        switch ($this->calculation_method) {
            case 'count':
                $value = $model::count();
                break;
            case 'sum':
                // For future use with specific column
                $value = $model::count();
                break;
            case 'avg':
                // For future use with specific column
                $value = $model::count();
                break;
            default:
                $value = $model::count();
        }

        return $value . ($this->suffix ?? '');
    }

    /**
     * Get display value (auto or manual)
     */
    public function getDisplayValueAttribute(): string
    {
        return $this->type === 'auto' ? $this->calculated_value : $this->value;
    }
}
