<?php

namespace App\Models;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory, HasLanguage;

    protected $table = 'benefits';

    protected $fillable = [
        'benefitable_id',
        'benefitable_type',
        'title_en',
        'title_ar',
        'short_description_en',
        'short_description_ar',
        'long_description_en',
        'long_description_ar',
        'image',
        'icon',
        'status',
        'order',
        'alt_image',
        'alt_icon',
    ];

    public function benefitable()
    {
        return $this->morphTo();
    }

    public function getImagePathAttribute()
    {
        if (! $this->image) {
            return asset('assets/dashboard/images/noimage.png');
        }

        // Get the folder path based on the benefitable model
        $folder = $this->getBenefitFolder();

        return asset('storage/'.$folder.'/'.$this->image);
    }

    public function getIconPathAttribute()
    {
        if (! $this->icon) {
            return asset('assets/dashboard/images/noimage.png');
        }

        // Get the folder path based on the benefitable model
        $folder = $this->getBenefitFolder();

        return asset('storage/'.$folder.'/'.$this->icon);
    }

    /**
     * Get the folder path for benefits based on the benefitable model type.
     */
    private function getBenefitFolder(): string
    {
        if (! $this->benefitable_type) {
            return 'benefits'; // Fallback for general benefits
        }

        // Extract the model name from the full class path
        // Example: App\Models\Service -> services/benefits
        $modelName = strtolower(class_basename($this->benefitable_type));

        // Pluralize the model name
        $pluralName = str_ends_with($modelName, 's') ? $modelName : $modelName.'s';

        return "{$pluralName}/benefits";
    }

    public function getTitleAttribute()
    {
        return $this->{'title_'.$this->lang};
    }

    public function getShortDescAttribute()
    {
        return $this->{'short_description_'.$this->lang};
    }

    public function getLongDescAttribute()
    {
        return $this->{'long_description_'.$this->lang};
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeGeneral($query)
    {
        return $query->where('benefitable_type', null);
    }
}
