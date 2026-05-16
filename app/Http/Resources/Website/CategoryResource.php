<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->{'name_'.app()->getLocale()},
            'order' => $this->order,
            'short_desc' => $this->{'short_desc_'.app()->getLocale()},
            'long_desc' => $this->{'long_desc_'.app()->getLocale()},
            'image' => $this->image_path,
            'alt_image' => $this->alt_image,
            'icon' => $this->icon_path,
            'alt_icon' => $this->alt_icon,
            'slug' => $this->{'slug_'.app()->getLocale()},
            'slugs' => [
                'en' => $this->slug_en,
                'ar' => $this->slug_ar,
            ],
            'meta_title' => $this->{'meta_title_'.app()->getLocale()},
            'meta_description' => $this->{'meta_desc_'.app()->getLocale()},
            'index' => $this->index,
            'projects' => ProjectResource::collection($this->whenLoaded('projects')),
        ];
    }
}
