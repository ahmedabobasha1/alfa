<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BenefitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->{'title_'.app()->getLocale()},
            'order' => $this->order,
            'short_desc' => $this->{'short_description_'.app()->getLocale()},
            'long_desc' => $this->{'long_description_'.app()->getLocale()},
            'image' => $this->image_path,
            'alt_image' => $this->alt_image,
            'icon' => $this->icon_path,
            'alt_icon' => $this->alt_icon,
        ];
    }
}
