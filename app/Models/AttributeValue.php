<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attribute_values';

    protected $fillable = ['attribute_id', 'value_ar', 'value_en', 'price', 'status'];

    public function getValueAttribute()
    {
        $lang = app()->getLocale();

        return $this->{'value_'.$lang };
    }
}
