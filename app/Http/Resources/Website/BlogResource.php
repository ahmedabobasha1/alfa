<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'date' => $this->date,
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
            'category_id' => $this->category_id,
            'author_id' => $this->author_id,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'faqs' => FaqResource::collection($this->whenLoaded('faqs')),
        ];
    }
}
