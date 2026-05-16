<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Cache-related imports removed since cache is disabled

class Phone extends Model
{
    /** @use HasFactory<\Database\Factories\PhoneFactory> */
    use HasFactory, HasLanguage;

    protected $table = 'phones';

    protected $fillable = [
        'name_ar',
        'name_en',
        'phone',
        'email',
        'description_ar',
        'description_en',
        'code',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    // No cache clearing needed - cache is completely disabled

    public function getNameAttribute()
    {
        return $this->{'name_'.$this->lang};
    }
}
