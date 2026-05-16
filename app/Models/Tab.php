<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    use HasFactory, HasLanguage;

    protected $fillable = [
        'tabbable_id',
        'tabbable_type',
        'name_en',
        'name_ar',
        'short_desc_en',
        'short_desc_ar',
        'long_desc_en',
        'long_desc_ar',
        'icon',
        'alt_icon',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the parent tabbable model (Service, Project, etc.).
     */
    public function tabbable()
    {
        return $this->morphTo();
    }

    /**
     * Get the name attribute based on current language.
     */
    public function getNameAttribute()
    {
        return $this->{'name_'.$this->lang};
    }

    /**
     * Get the short description attribute based on current language.
     */
    public function getShortDescAttribute()
    {
        return $this->{'short_desc_'.$this->lang};
    }

    /**
     * Get the long description attribute based on current language.
     */
    public function getLongDescAttribute()
    {
        return $this->{'long_desc_'.$this->lang};
    }

    /**
     * Get the icon path attribute.
     */
    public function getIconPathAttribute()
    {
        if (! $this->icon) {
            return asset('assets/dashboard/images/noIcon.png');
        }

        // Get the model name from tabbable_type
        // Example: App\Models\Service -> services
        $modelName = strtolower(class_basename($this->tabbable_type));

        // Pluralize the model name
        $pluralName = str_ends_with($modelName, 's') ? $modelName : $modelName.'s';

        // Build the path: storage/services/tabs/filename.jpg or storage/projects/tabs/filename.jpg
        return asset("storage/{$pluralName}/tabs/{$this->icon}");
    }

    /**
     * Scope a query to only include active tabs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to order tabs by order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
