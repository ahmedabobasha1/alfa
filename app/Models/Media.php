<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'file_name',
        'file_type',
        'order',
    ];

    public function mediable()
    {
        return $this->morphTo();
    }

    public function image_path($folder = 'uploads', $model = null)
    {
        return asset('storage/'.$folder.$model.'/images/'.$this->file_name);
    }

    public function getImagePathAttribute()
    {
        if (! $this->mediable_type || ! $this->mediable_id) {
            return asset('assets/dashboard/images/noimage.png');
        }

        // Extract the model name from the full class path
        // Example: App\Models\Service -> services
        $modelName = strtolower(class_basename($this->mediable_type));

        // Pluralize the model name
        $pluralName = str_ends_with($modelName, 's') ? $modelName : $modelName.'s';

        // Construct the path: {model_plural}/{id}/images/{file_name}
        $path = $pluralName.'/'.$this->mediable_id.'/images/'.$this->file_name;

        return asset('storage/'.$path);
    }
}
